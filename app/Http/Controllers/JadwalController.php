<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Jadwal;
use App\Models\Studio;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class JadwalController extends Controller
{
    // Menampilkan daftar jadwal
    
    public function index(Request $request): View
    {
        $studioSort = $request->query('studio_sort');

        $query = Jadwal::query()
            ->join('studios', 'jadwals.studio_id', '=', 'studios.id')
            ->select('jadwals.*')
            ->with(['film', 'studio'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($q) use ($search) {
                    $q->whereHas('film', function ($film) use ($search) {
                        $film->where('judul', 'like', "%{$search}%");
                    })->orWhereHas('studio', function ($studio) use ($search) {
                        $studio->where('nama', 'like', "%{$search}%");
                    });
                });
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('jadwals.status', $request->status);
            });

        // Pengurutan berdasarkan studio jika kolom diklik
        if (in_array($studioSort, ['asc', 'desc'], true)) {

            $query->orderBy('studios.nama', $studioSort)
                ->orderBy('jadwals.tanggal_tayang', 'asc')
                ->orderBy('jadwals.jam_mulai', 'asc');

        } else {

            // Pengurutan default: tanggal, jam, lalu nama studio
            $query->orderBy('jadwals.tanggal_tayang', 'asc')
                ->orderBy('jadwals.jam_mulai', 'asc')
                ->orderBy('studios.nama', 'asc');

        }

        $jadwals = $query
            ->paginate(10)
            ->withQueryString();

        return view('admin.jadwals.index', compact('jadwals'));
    }

    // Form tambah jadwal
    public function create(): View
    {
        $films = Film::where('status', 'tayang')
            ->orderBy('judul')
            ->get();

        $studios = Studio::where('status', 'aktif')
            ->orderBy('nama')
            ->get();

        return view('admin.jadwals.create', compact(
            'films',
            'studios'
        ));
    }

    // Menyimpan jadwal baru
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'film_id' => [
                'required',
                'integer',
                Rule::exists('films', 'id')->where('status', 'tayang'),
            ],

            'studio_id' => [
                'required',
                'integer',
                Rule::exists('studios', 'id')->where('status', 'aktif'),
            ],

            'tanggal_tayang' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'harga' => 'required|numeric|min:0|max:99999999.99',

            'status' => 'required|in:aktif,dibatalkan',
        ]);

        $film = Film::findOrFail($data['film_id']);

        $start = Carbon::parse(
            $data['tanggal_tayang'] . ' ' . $data['jam_mulai']
        );

        $end = $start->copy()->addMinutes($film->durasi_menit);

        // Periksa bentrok hanya untuk jadwal aktif
        if (
            $data['status'] === 'aktif' &&
            $this->hasScheduleConflict(
                (int) $data['studio_id'],
                $start,
                $end
            )
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'jam_mulai' =>
                        'Jadwal bentrok dengan penayangan lain di studio ini. Silakan pilih jam berbeda.'
                ]);
        }

        // Jam selesai dihitung otomatis
        $data['jam_mulai'] = $start->format('H:i:s');
        $data['jam_selesai'] = $end->format('H:i:s');

        Jadwal::create($data);

        return redirect()
            ->route('admin.jadwals.index')
            ->with('success', 'Jadwal tayang berhasil ditambahkan.');
    }

    // Form edit jadwal
    public function edit(Jadwal $jadwal): View
    {
        // Film aktif dan film yang sedang digunakan jadwal ini
        $films = Film::where(function ($query) use ($jadwal) {
            $query->where('status', 'tayang')
                ->orWhere('id', $jadwal->film_id);
        })
        ->orderBy('judul')
        ->get();

        // Studio aktif dan studio yang sedang digunakan jadwal ini
        $studios = Studio::where(function ($query) use ($jadwal) {
            $query->where('status', 'aktif')
                ->orWhere('id', $jadwal->studio_id);
        })
        ->orderBy('nama')
        ->get();

        return view('admin.jadwals.edit', compact(
            'jadwal',
            'films',
            'studios'
        ));
    }

    // Memperbarui jadwal
    public function update(
        Request $request,
        Jadwal $jadwal
    ): RedirectResponse {

        $data = $request->validate([
            'film_id' => [
                'required',
                'integer',
                Rule::exists('films', 'id')->where(function ($query) use ($jadwal) {
                    $query->where('status', 'tayang')
                        ->orWhere('id', $jadwal->film_id);
                }),
            ],

            'studio_id' => [
                'required',
                'integer',
                Rule::exists('studios', 'id')->where(function ($query) use ($jadwal) {
                    $query->where('status', 'aktif')
                        ->orWhere('id', $jadwal->studio_id);
                }),
            ],

            'tanggal_tayang' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'harga' => 'required|numeric|min:0|max:99999999.99',

            'status' => 'required|in:aktif,dibatalkan',
        ]);

        $film = Film::findOrFail($data['film_id']);

        $start = Carbon::parse(
            $data['tanggal_tayang'] . ' ' . $data['jam_mulai']
        );

        $end = $start->copy()->addMinutes($film->durasi_menit);

        // Abaikan jadwal yang sedang diedit saat memeriksa bentrok
        if (
            $data['status'] === 'aktif' &&
            $this->hasScheduleConflict(
                (int) $data['studio_id'],
                $start,
                $end,
                $jadwal->id
            )
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'jam_mulai' =>
                        'Jadwal bentrok dengan penayangan lain di studio ini. Silakan pilih jam berbeda.'
                ]);
        }

        $data['jam_mulai'] = $start->format('H:i:s');
        $data['jam_selesai'] = $end->format('H:i:s');

        $jadwal->update($data);

        return redirect()
            ->route('admin.jadwals.index')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    // Menghapus jadwal
    public function destroy(Jadwal $jadwal): RedirectResponse
    {
        // Lindungi data transaksi dan kursi yang sudah terkait
        if (
            $jadwal->pemesanans()->exists() ||
            $jadwal->detailKursis()->exists()
        ) {
            return redirect()
                ->route('admin.jadwals.index')
                ->with(
                    'error',
                    'Jadwal tidak dapat dihapus karena sudah memiliki data pemesanan atau kursi.'
                );
        }

        $jadwal->delete();

        return redirect()
            ->route('admin.jadwals.index')
            ->with('success', 'Jadwal berhasil dihapus.');
    }

    /**
     * Memeriksa bentrok waktu pada studio yang sama.
     *
     * Menggunakan interval:
     * Waktu mulai jadwal baru < waktu selesai jadwal lama
     * DAN
     * Waktu selesai jadwal baru > waktu mulai jadwal lama
     *
     * Mendukung jadwal yang melewati tengah malam.
     */
    private function hasScheduleConflict(
        int $studioId,
        Carbon $candidateStart,
        Carbon $candidateEnd,
        ?int $ignoreId = null
    ): bool {

        $fromDate = $candidateStart->copy()
            ->subDay()
            ->toDateString();

        $toDate = $candidateEnd->copy()
            ->toDateString();

        $existingSchedules = Jadwal::where('studio_id', $studioId)
            ->where('status', 'aktif')
            ->whereBetween('tanggal_tayang', [$fromDate, $toDate])
            ->when($ignoreId, function ($query) use ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            })
            ->get();

        foreach ($existingSchedules as $existing) {

            $existingStart = Carbon::parse(
                $existing->tanggal_tayang . ' ' . $existing->jam_mulai
            );

            $existingEnd = Carbon::parse(
                $existing->tanggal_tayang . ' ' . $existing->jam_selesai
            );

            // Jika jam selesai lebih kecil atau sama dengan jam mulai,
            // penayangan dianggap berakhir pada hari berikutnya.
            if ($existingEnd->lessThanOrEqualTo($existingStart)) {
                $existingEnd->addDay();
            }

            $overlap =
                $candidateStart->lessThan($existingEnd) &&
                $candidateEnd->greaterThan($existingStart);

            if ($overlap) {
                return true;
            }
        }

        return false;
    }
}