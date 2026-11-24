<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Studio;
use App\Models\Pemesanan;
use App\Models\DetailKursi;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;

class BookingController extends Controller
{
    /*
    | MEMILIH JADWAL
    */

    public function selectSchedule(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'jadwal_id' => [
                'required',
                'integer',
                'exists:jadwals,id'
            ],
        ]);

        $jadwal = $this->bookableScheduleQuery()
            ->whereKey($validated['jadwal_id'])
            ->first();

        abort_unless($jadwal, 404, 'Jadwal tidak tersedia.');

        // Jika belum login, simpan jadwal sementara.
        if (!$request->user()) {

            $request->session()->put(
                'booking.pending_jadwal_id',
                $jadwal->id
            );

            $request->session()->forget([
                'booking.jadwal_id',
                'booking.selected_seats'
            ]);

            return redirect()
                ->route('customer.login')
                ->with(
                    'info',
                    'Silakan login terlebih dahulu untuk melanjutkan pemesanan.'
                );
        }

        // Admin tidak diperbolehkan melakukan transaksi customer.
        if ($request->user()->role !== 'customer') {

            return redirect()
                ->route('admin.dashboard')
                ->with(
                    'error',
                    'Silakan gunakan akun customer untuk memesan tiket.'
                );
        }

        // Simpan jadwal untuk customer yang sudah login.
        $request->session()->put([
            'booking.jadwal_id' => $jadwal->id,
            'booking.selected_seats' => [],
        ]);

        $request->session()->forget(
            'booking.pending_jadwal_id'
        );

        return redirect()->route('booking.seats');
    }


    /*
    | MENAMPILKAN DENAH KURSI
    */

    public function showSeats(Request $request): View|RedirectResponse
    {
        $jadwal = $this->getCurrentSchedule($request);

        if (!$jadwal) {

            $request->session()->forget([
                'booking.jadwal_id',
                'booking.selected_seats'
            ]);

            return redirect()
                ->route('home')
                ->with('error', 'Silakan pilih jadwal terlebih dahulu.');
        }

        $occupiedSeats = DetailKursi::where(
            'jadwal_id',
            $jadwal->id
        )
            ->pluck('no_kursi')
            ->map(fn ($seat) => strtoupper($seat))
            ->all();

        $seatMap = $this->buildSeatMap(
            $jadwal->studio,
            $occupiedSeats
        );

        $selectedSeats = $request->session()->get(
            'booking.selected_seats',
            []
        );

        $configuredCapacity =
            (int) $jadwal->studio->jumlah_baris *
            (int) $jadwal->studio->kursi_per_baris;

        $capacityMismatch =
            $configuredCapacity !== (int) $jadwal->studio->kapasitas;

        return view('booking.seats', compact(
            'jadwal',
            'seatMap',
            'selectedSeats',
            'capacityMismatch',
            'configuredCapacity'
        ));
    }


    /*
    | MEMVALIDASI DAN MENYIMPAN PILIHAN KURSI SEMENTARA
    */

    public function storeSeats(Request $request): RedirectResponse
    {
        $jadwal = $this->getCurrentSchedule($request);

        if (!$jadwal) {

            $request->session()->forget([
                'booking.jadwal_id',
                'booking.selected_seats'
            ]);

            return redirect()->route('home')
                ->with('error', 'Jadwal sudah tidak tersedia.');
        }

        $validated = $request->validate([
            'seats' => [
                'required',
                'array',
                'min:1',
            ],

            'seats.*' => [
                'required',
                'string',
                'max:10',
            ],
        ]);

        $selectedSeats = array_map(
            fn ($seat) => strtoupper(trim($seat)),
            $validated['seats']
        );

        $uniqueSeats = array_values(
            array_unique($selectedSeats)
        );

        if (count($uniqueSeats) !== count($selectedSeats)) {

            return back()->withErrors([
                'seats' => 'Terdapat kursi yang dipilih lebih dari satu kali.'
            ]);
        }

        // Validasi nomor kursi berdasarkan konfigurasi studio.
        $validSeats = $this->seatNumbers($jadwal->studio);

        $invalidSeats = array_diff(
            $uniqueSeats,
            $validSeats
        );

        if (!empty($invalidSeats)) {

            return back()->withErrors([
                'seats' => 'Nomor kursi yang dipilih tidak valid.'
            ]);
        }

        // Periksa kursi yang sudah dipesan.
        $occupiedSeats = DetailKursi::where(
            'jadwal_id',
            $jadwal->id
        )
            ->pluck('no_kursi')
            ->map(fn ($seat) => strtoupper($seat))
            ->all();

        $conflictingSeats = array_intersect(
            $uniqueSeats,
            $occupiedSeats
        );

        if (!empty($conflictingSeats)) {

            $availableSelection = array_values(
                array_diff($uniqueSeats, $conflictingSeats)
            );

            $request->session()->put(
                'booking.selected_seats',
                $availableSelection
            );

            return redirect()
                ->route('booking.seats')
                ->withErrors([
                    'seats' => 'Kursi berikut sudah dipesan: ' .
                        implode(', ', $conflictingSeats)
                ]);
        }

        // Simpan pilihan sementara ke session.
        $request->session()->put(
            'booking.selected_seats',
            $uniqueSeats
        );

        return redirect()->route('booking.customer');
    }


    /*
    | FORM IDENTITAS PEMESAN
    */

    public function showCustomer(Request $request): View|RedirectResponse
    {
        $jadwal = $this->getCurrentSchedule($request);

        if (!$jadwal) {

            $request->session()->forget([
                'booking.jadwal_id',
                'booking.selected_seats'
            ]);

            return redirect()->route('home')
                ->with('error', 'Jadwal tidak tersedia.');
        }

        $selectedSeats = $request->session()->get(
            'booking.selected_seats',
            []
        );

        if (empty($selectedSeats)) {

            return redirect()
                ->route('booking.seats')
                ->withErrors([
                    'seats' => 'Silakan pilih minimal satu kursi.'
                ]);
        }

        // Validasi ulang nomor kursi.
        $invalidSeats = array_diff(
            $selectedSeats,
            $this->seatNumbers($jadwal->studio)
        );

        if (!empty($invalidSeats)) {

            $request->session()->forget('booking.selected_seats');

            return redirect()
                ->route('booking.seats')
                ->withErrors([
                    'seats' => 'Pilihan kursi tidak valid. Silakan pilih kembali.'
                ]);
        }

        // Periksa apakah kursi sudah dipesan pengunjung lain.
        $occupiedSeats = DetailKursi::where(
            'jadwal_id',
            $jadwal->id
        )
            ->pluck('no_kursi')
            ->map(fn ($seat) => strtoupper($seat))
            ->all();

        $conflictingSeats = array_intersect(
            $selectedSeats,
            $occupiedSeats
        );

        if (!empty($conflictingSeats)) {

            $request->session()->put(
                'booking.selected_seats',
                array_values(array_diff(
                    $selectedSeats,
                    $conflictingSeats
                ))
            );

            return redirect()
                ->route('booking.seats')
                ->withErrors([
                    'seats' => 'Kursi berikut sudah dipesan: ' .
                        implode(', ', $conflictingSeats)
                ]);
        }

        $seatCount = count($selectedSeats);

        $totalPrice = (float) $jadwal->harga * $seatCount;

        return view('booking.customer', compact(
            'jadwal',
            'selectedSeats',
            'seatCount',
            'totalPrice'
        ));
    }


    /*
    | MENYIMPAN TRANSAKSI PEMESANAN
    */

    public function storeBooking(Request $request): RedirectResponse
    {
        // Pastikan transaksi berasal dari akun customer.
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'customer',
            403,
            'Hanya customer yang dapat melakukan pemesanan.'
        );

        // Identitas nama otomatis diambil dari akun.
        $namaPemesan = trim($user->name);

        if ($namaPemesan === '' || mb_strlen($namaPemesan) > 100) {

            return back()->withErrors([
                'nama_pemesan' =>
                    'Nama akun tidak valid atau melebihi 100 karakter.'
            ]);
        }

        // Nomor HP tetap dimasukkan saat pemesanan.
        $validated = $request->validate([

            'no_hp' => [
                'required',
                'string',
                'max:20',
                'regex:/^[0-9+() -]{8,20}$/',
            ],

        ], [

            'no_hp.required' =>
                'Nomor HP wajib diisi.',

            'no_hp.max' =>
                'Nomor HP maksimal 20 karakter.',

            'no_hp.regex' =>
                'Format nomor HP tidak valid.',

        ]);

        $jadwalId = $request->session()->get(
            'booking.jadwal_id'
        );

        $selectedSeats = $request->session()->get(
            'booking.selected_seats',
            []
        );

        if (!$jadwalId || empty($selectedSeats)) {

            return redirect()
                ->route('home')
                ->with('error', 'Data pemesanan tidak lengkap.');
        }

        $selectedSeats = array_values(
            array_unique(
                array_map(
                    fn ($seat) => strtoupper(trim($seat)),
                    $selectedSeats
                )
            )
        );

        // Ambil identitas customer sebelum transaksi database.
        $userId = $user->id;

        try {

            $pemesanan = DB::transaction(function () use (
                $jadwalId,
                $selectedSeats,
                $validated,
                $userId,
                $namaPemesan
            ) {

                // Ambil ulang jadwal yang masih aktif.
                $jadwal = $this->bookableScheduleQuery()
                    ->whereKey($jadwalId)
                    ->lockForUpdate()
                    ->first();

                if (!$jadwal) {

                    throw ValidationException::withMessages([
                        'jadwal' => 'Jadwal sudah tidak tersedia.'
                    ]);
                }

                // Validasi nomor kursi.
                $validSeats = $this->seatNumbers($jadwal->studio);

                $invalidSeats = array_diff(
                    $selectedSeats,
                    $validSeats
                );

                if (!empty($invalidSeats)) {

                    throw ValidationException::withMessages([
                        'seats' => 'Terdapat nomor kursi yang tidak valid.'
                    ]);
                }

                // Pemeriksaan terakhir sebelum penyimpanan.
                $occupiedSeats = DetailKursi::where(
                    'jadwal_id',
                    $jadwal->id
                )
                    ->whereIn('no_kursi', $selectedSeats)
                    ->lockForUpdate()
                    ->pluck('no_kursi')
                    ->map(fn ($seat) => strtoupper($seat))
                    ->all();

                if (!empty($occupiedSeats)) {

                    throw ValidationException::withMessages([
                        'seats' => 'Kursi berikut baru saja dipesan: ' .
                            implode(', ', $occupiedSeats)
                    ]);
                }

                // Hitung total harga.
                $jumlahKursi = count($selectedSeats);

                $totalHarga =
                    (float) $jadwal->harga * $jumlahKursi;

                // Buat kode booking unik.
                $kodeBooking = $this->generateBookingCode();

                // Buat transaksi yang terhubung dengan customer.
                $pemesanan = Pemesanan::create([

                    'jadwal_id' => $jadwal->id,

                    'user_id' => $userId,

                    'kode_booking' => $kodeBooking,

                    'nama_pemesan' => $namaPemesan,

                    'no_hp' => trim($validated['no_hp']),

                    'total_harga' => $totalHarga,

                    'status' => 'booking',

                ]);

                // Buat detail kursi.
                $detailKursi = [];

                foreach ($selectedSeats as $seat) {

                    $detailKursi[] = [

                        'jadwal_id' => $jadwal->id,

                        'no_kursi' => $seat,

                        'harga' => $jadwal->harga,

                    ];

                }

                $pemesanan->detailKursis()->createMany(
                    $detailKursi
                );

                return $pemesanan;

            });

        } catch (ValidationException $exception) {

            // Jika jadwal tidak lagi tersedia.
            if (isset($exception->errors()['jadwal'])) {

                $request->session()->forget([
                    'booking.jadwal_id',
                    'booking.selected_seats'
                ]);

                return redirect()
                    ->route('home')
                    ->withErrors($exception->errors());
            }

            // Jika kursi sudah dipesan customer lain.
            $request->session()->forget(
                'booking.selected_seats'
            );

            return redirect()
                ->route('booking.seats')
                ->withErrors($exception->errors());

        } catch (QueryException $exception) {

            // Perlindungan tambahan dari unique constraint.
            if ($this->isSeatUniqueViolation($exception)) {

                $request->session()->forget(
                    'booking.selected_seats'
                );

                return redirect()
                    ->route('booking.seats')
                    ->withErrors([
                        'seats' =>
                            'Salah satu kursi baru saja dipesan customer lain. Silakan pilih kembali.'
                    ]);
            }

            throw $exception;
        }

        // Hapus data booking sementara setelah berhasil.
        $request->session()->forget([
            'booking.jadwal_id',
            'booking.selected_seats',
            'booking.pending_jadwal_id'
        ]);

        // Arahkan ke halaman konfirmasi booking.
        return redirect()->route('booking.success', [
            'kode_booking' => $pemesanan->kode_booking
        ]);
    }


    /*
    | HALAMAN BOOKING BERHASIL
    | HANYA PEMILIK TRANSAKSI YANG DAPAT MENGAKSES
    */

    public function showSuccess(
        Request $request,
        string $kode_booking
    ): View {

        $pemesanan = Pemesanan::with([
            'jadwal.film',
            'jadwal.studio',
            'detailKursis'
        ])
            ->where('user_id', $request->user()->id)
            ->where('kode_booking', $kode_booking)
            ->firstOrFail();

        return view('booking.success', compact(
            'pemesanan'
        ));
    }


    /*
    | MENGAMBIL JADWAL DARI SESSION
    */

    private function getCurrentSchedule(
        Request $request
    ): ?Jadwal {

        $jadwalId = $request->session()->get(
            'booking.jadwal_id'
        );

        if (!$jadwalId) {
            return null;
        }

        return $this->bookableScheduleQuery()
            ->whereKey($jadwalId)
            ->first();
    }


    /*
    | QUERY JADWAL YANG MASIH BISA DIPESAN
    */

    private function bookableScheduleQuery()
    {
        $now = now('Asia/Jakarta');

        $today = $now->toDateString();

        $currentTime = $now->format('H:i:s');

        return Jadwal::with([
            'film',
            'studio'
        ])

            ->where('status', 'aktif')

            ->whereHas('film', function ($query) {
                $query->where('status', 'tayang');
            })

            ->whereHas('studio', function ($query) {
                $query->where('status', 'aktif');
            })

            ->where(function ($query) use (
                $today,
                $currentTime
            ) {

                $query->whereDate(
                    'tanggal_tayang',
                    '>',
                    $today
                )

                ->orWhere(function ($query) use (
                    $today,
                    $currentTime
                ) {

                    $query->whereDate(
                        'tanggal_tayang',
                        '=',
                        $today
                    )

                    ->where(
                        'jam_mulai',
                        '>=',
                        $currentTime
                    );

                });

            });
    }


    /*
    | MEMBUAT NOMOR KURSI SESUAI KONFIGURASI STUDIO
    */

    private function seatNumbers(Studio $studio): array
    {
        $numbers = [];

        $totalRows = (int) $studio->jumlah_baris;

        $seatsPerRow = (int) $studio->kursi_per_baris;

        for ($row = 1; $row <= $totalRows; $row++) {

            $rowLabel = $this->rowLabel($row);

            for (
                $column = 1;
                $column <= $seatsPerRow;
                $column++
            ) {

                $numbers[] = $rowLabel . $column;

            }

        }

        return $numbers;
    }


    /*
    | MEMBANGUN DENAH KURSI
    */

    private function buildSeatMap(
        Studio $studio,
        array $occupiedSeats
    ): array {

        $seatMap = [];

        $occupiedLookup = array_fill_keys(
            array_map('strtoupper', $occupiedSeats),
            true
        );

        $totalRows = (int) $studio->jumlah_baris;

        $seatsPerRow = (int) $studio->kursi_per_baris;

        for ($row = 1; $row <= $totalRows; $row++) {

            $rowLabel = $this->rowLabel($row);

            $seats = [];

            for (
                $column = 1;
                $column <= $seatsPerRow;
                $column++
            ) {

                $seatNumber = $rowLabel . $column;

                $seats[] = [

                    'number' => $seatNumber,

                    'occupied' => isset(
                        $occupiedLookup[$seatNumber]
                    ),

                ];

            }

            $seatMap[] = [

                'label' => $rowLabel,

                'seats' => $seats,

            ];

        }

        return $seatMap;
    }


    /*
    | MEMBUAT LABEL BARIS A, B, C, ... AA, AB
    */

    private function rowLabel(int $number): string
    {
        $label = '';

        while ($number > 0) {

            $number--;

            $label = chr(65 + ($number % 26)) . $label;

            $number = intdiv($number, 26);

        }

        return $label;
    }


    /*
    | GENERATE KODE BOOKING
    */

    private function generateBookingCode(): string
    {
        do {

            $code = 'CT-' .
                now('Asia/Jakarta')->format('ymdHis') .
                strtoupper(Str::random(5));

        } while (
            Pemesanan::where('kode_booking', $code)->exists()
        );

        return $code;
    }


    /*
    | MENDETEKSI UNIQUE CONSTRAINT KURSI
    */

    private function isSeatUniqueViolation(
        QueryException $exception
    ): bool {

        $message = strtolower(
            $exception->getMessage()
        );

        return str_contains(
            $message,
            'detail_kursis_jadwal_id_no_kursi_unique'
        ) || str_contains(
            $message,
            'detail_kursis.jadwal_id, detail_kursis.no_kursi'
        );
    }
}