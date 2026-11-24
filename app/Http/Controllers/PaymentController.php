<?php

namespace App\Http\Controllers;

use App\Models\DetailKursi;
use App\Models\Pemesanan;
use App\Models\Pembayaran;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\Builder;

class PaymentController extends Controller
{
    /*
    | QUERY PEMESANAN MILIK CUSTOMER YANG LOGIN
    */

    private function ownedBookingQuery(
        string $kode_booking
    ): Builder {

        return Pemesanan::query()
            ->where('user_id', auth()->id())
            ->where('kode_booking', $kode_booking);
    }


    /*
    | RINGKASAN PEMBAYARAN
    */

    public function summary(string $kode_booking): View
    {
        $pemesanan = $this->ownedBookingQuery($kode_booking)
            ->with([
                'jadwal.film',
                'jadwal.studio',
                'detailKursis',
                'pembayaran',
            ])
            ->firstOrFail();

        return view('booking.payment-summary', compact(
            'pemesanan'
        ));
    }


    /*
    | SB-59
    | MENAMPILKAN PILIHAN METODE PEMBAYARAN
    */

    public function methods(
        string $kode_booking
    ): View|RedirectResponse {

        $pemesanan = $this->ownedBookingQuery($kode_booking)
            ->with([
                'jadwal.film',
                'jadwal.studio',
                'detailKursis',
                'pembayaran',
            ])
            ->firstOrFail();

        if ($pemesanan->status !== 'booking') {

            return redirect()
                ->route('booking.payment.summary', $kode_booking)
                ->with('error', 'Pemesanan tidak dapat dibayar.');
        }

        if ($pemesanan->pembayaran?->status === 'berhasil') {

            return redirect()
                ->route('booking.payment.summary', $kode_booking);
        }

        return view('booking.payment-methods', compact(
            'pemesanan'
        ));
    }


    /*
    | SB-59
    | MENYIMPAN METODE PEMBAYARAN
    */

    public function storeMethod(
        Request $request,
        string $kode_booking
    ): RedirectResponse {

        $validated = $request->validate([
            'metode_pembayaran' => [
                'required',
                'in:transfer_bank,qris,e_wallet',
            ],
        ]);

        DB::transaction(function () use (
            $validated,
            $kode_booking
        ) {

            $pemesanan = $this->ownedBookingQuery($kode_booking)
                ->lockForUpdate()
                ->firstOrFail();

            if ($pemesanan->status !== 'booking') {

                throw ValidationException::withMessages([
                    'pembayaran' =>
                        'Pemesanan tidak dapat dibayar.',
                ]);
            }

            $pembayaran = Pembayaran::where(
                'pemesanan_id',
                $pemesanan->id
            )
                ->lockForUpdate()
                ->first();

            if ($pembayaran?->status === 'berhasil') {

                throw ValidationException::withMessages([
                    'pembayaran' =>
                        'Pembayaran sudah berhasil.',
                ]);
            }

            $data = [

                'metode_pembayaran' =>
                    $validated['metode_pembayaran'],

                'kode_referensi' => null,

                'jumlah_bayar' => $pemesanan->total_harga,

                'status' => 'menunggu',

                'waktu_bayar' => null,

            ];

            if ($pembayaran) {

                $pembayaran->update($data);

            } else {

                $pemesanan->pembayaran()->create($data);

            }

        });

        return redirect()
            ->route('booking.payment.process', $kode_booking)
            ->with(
                'success',
                'Metode pembayaran berhasil disimpan.'
            );
    }


    /*
    | SB-60
    | MENAMPILKAN HALAMAN SIMULASI PEMBAYARAN
    */

    public function showSimulation(
        string $kode_booking
    ): View|RedirectResponse {

        $pemesanan = $this->ownedBookingQuery($kode_booking)
            ->with([
                'jadwal.film',
                'jadwal.studio',
                'detailKursis',
                'pembayaran',
            ])
            ->firstOrFail();

        if ($pemesanan->status === 'lunas') {

            return redirect()
                ->route('booking.payment.summary', $kode_booking)
                ->with('success', 'Pembayaran sudah berhasil.');
        }

        if ($pemesanan->status !== 'booking') {

            return redirect()
                ->route('booking.payment.summary', $kode_booking)
                ->with('error', 'Pemesanan tidak dapat diproses.');
        }

        if (!$pemesanan->pembayaran) {

            return redirect()
                ->route('booking.payment.methods', $kode_booking)
                ->with('error', 'Pilih metode pembayaran dahulu.');
        }

        return view('booking.payment-process', compact(
            'pemesanan'
        ));
    }


    /*
    | SB-60 SAMPAI SB-64
    | MEMPROSES SIMULASI PEMBAYARAN DAN MENERBITKAN TIKET
    */

    public function simulate(
        Request $request,
        string $kode_booking
    ): RedirectResponse {

        $validated = $request->validate([
            'hasil' => [
                'required',
                'in:berhasil,gagal',
            ],
        ]);

        $hasil = DB::transaction(function () use (
            $validated,
            $kode_booking
        ) {

            // Pastikan booking milik customer yang login.
            $pemesanan = $this->ownedBookingQuery($kode_booking)
                ->lockForUpdate()
                ->firstOrFail();

            $pembayaran = Pembayaran::where(
                'pemesanan_id',
                $pemesanan->id
            )
                ->lockForUpdate()
                ->first();

            if (!$pembayaran) {

                throw ValidationException::withMessages([
                    'pembayaran' =>
                        'Data pembayaran tidak ditemukan.',
                ]);
            }

            // Jika sudah lunas, jangan proses pembayaran ulang.
            if ($pemesanan->status === 'lunas') {

                if ($pembayaran->status !== 'berhasil') {

                    throw ValidationException::withMessages([
                        'pembayaran' =>
                            'Status pembayaran tidak konsisten.',
                    ]);
                }

                $this->issueTicketCodes($pemesanan->id);

                return 'sudah_lunas';
            }

            if ($pemesanan->status !== 'booking') {

                throw ValidationException::withMessages([
                    'pembayaran' =>
                        'Pemesanan tidak dapat diproses.',
                ]);
            }

            // Memperbaiki kondisi jika pembayaran sudah berhasil
            // tetapi status booking belum berubah.
            if ($pembayaran->status === 'berhasil') {

                $pemesanan->update([
                    'status' => 'lunas',
                ]);

                $this->issueTicketCodes($pemesanan->id);

                return 'berhasil';
            }

            $statusPembayaran = $validated['hasil'];

            $pembayaran->update([

                'kode_referensi' =>
                    $this->generatePaymentReference(),

                'status' => $statusPembayaran,

                'waktu_bayar' =>
                    $statusPembayaran === 'berhasil'
                        ? now('Asia/Jakarta')
                        : null,

            ]);

            // Jika pembayaran berhasil.
            if ($statusPembayaran === 'berhasil') {

                $pemesanan->update([
                    'status' => 'lunas',
                ]);

                // Terbitkan kode tiket untuk setiap kursi.
                $this->issueTicketCodes($pemesanan->id);

            }

            return $statusPembayaran;

        });


        if (in_array($hasil, [
            'berhasil',
            'sudah_lunas'
        ])) {

            return redirect()
                ->route('booking.payment.summary', $kode_booking)
                ->with(
                    'success',
                    'Pembayaran berhasil! E-ticket kamu sudah tersedia.'
                );
        }

        return redirect()
            ->route('booking.payment.process', $kode_booking)
            ->with(
                'error',
                'Pembayaran gagal. Silakan coba kembali.'
            );
    }


    /*
    | SB-66
    | MENAMPILKAN SELURUH E-TICKET DALAM SATU BOOKING
    */

    public function tickets(
        string $kode_booking
    ): View {

        $pemesanan = $this->ownedBookingQuery($kode_booking)
            ->with('pembayaran')
            ->firstOrFail();

        abort_unless(
            $pemesanan->status === 'lunas'
            && $pemesanan->pembayaran?->status === 'berhasil',
            403,
            'E-ticket hanya tersedia setelah pembayaran berhasil.'
        );

        DB::transaction(function () use ($kode_booking) {

            // Periksa ulang kepemilikan sebelum menerbitkan tiket.
            $lockedPemesanan = $this->ownedBookingQuery($kode_booking)
                ->lockForUpdate()
                ->firstOrFail();

            $pembayaran = Pembayaran::where(
                'pemesanan_id',
                $lockedPemesanan->id
            )
                ->lockForUpdate()
                ->first();

            abort_unless(
                $lockedPemesanan->status === 'lunas'
                && $pembayaran?->status === 'berhasil',
                403,
                'Pembayaran belum berhasil.'
            );

            $this->issueTicketCodes($lockedPemesanan->id);

        });

        $pemesanan->load([
            'jadwal.film',
            'jadwal.studio',
            'detailKursis',
            'pembayaran',
        ]);

        return view('booking.tickets', compact(
            'pemesanan'
        ));
    }


    /*
    | SB-65 DAN SB-66
    | VERIFIKASI SATU TIKET MELALUI QR CODE
    |
    | Route ini tetap publik agar petugas bioskop
    | dapat melakukan pemindaian tanpa login.
    */

    public function ticketDetail(
        string $kode_tiket
    ): View {

        $detailKursi = DetailKursi::with([
            'pemesanan.jadwal.film',
            'pemesanan.jadwal.studio',
            'pemesanan.pembayaran',
        ])
            ->where('kode_tiket', $kode_tiket)
            ->firstOrFail();

        $pemesanan = $detailKursi->pemesanan;

        abort_unless(
            $pemesanan
            && $pemesanan->status === 'lunas'
            && $pemesanan->pembayaran?->status === 'berhasil',
            404,
            'Tiket tidak valid atau belum dibayar.'
        );

        return view('booking.ticket-detail', compact(
            'detailKursi'
        ));
    }


    /*
    | SB-64
    | MEMBUAT KODE UNIK UNTUK SETIAP DETAIL KURSI
    */

    private function issueTicketCodes(int $pemesananId): void
    {
        $details = DetailKursi::where(
            'pemesanan_id',
            $pemesananId
        )
            ->whereNull('kode_tiket')
            ->lockForUpdate()
            ->get();

        foreach ($details as $detail) {

            $detail->update([
                'kode_tiket' => $this->generateTicketCode(),
            ]);

        }
    }


    /*
    | MEMBUAT KODE TIKET YANG TIDAK DUPLIKAT
    */

    private function generateTicketCode(): string
    {
        do {

            $kode = 'CTK-'
                . now('Asia/Jakarta')->format('ymd')
                . '-'
                . Str::upper(Str::random(8));

        } while (
            DetailKursi::where('kode_tiket', $kode)->exists()
        );

        return $kode;
    }


    /*
    | MEMBUAT KODE REFERENSI PEMBAYARAN UNIK
    */

    private function generatePaymentReference(): string
    {
        do {

            $kode = 'CTPAY-'
                . now('Asia/Jakarta')->format('ymdHis')
                . '-'
                . Str::upper(Str::random(5));

        } while (
            Pembayaran::where('kode_referensi', $kode)->exists()
        );

        return $kode;
    }
}