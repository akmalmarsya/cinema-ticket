<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FilmDetailController extends Controller
{
    public function show(Request $request, Film $film): View
    {
        // Hanya film yang sedang tayang dapat dilihat.
        abort_unless($film->status === 'tayang', 404);

        // Validasi filter tanggal.
        $validated = $request->validate([
            'tanggal' => ['nullable', 'date_format:Y-m-d'],
        ]);

        $selectedDate = $validated['tanggal'] ?? null;

        // Menggunakan waktu Indonesia (WIB).
        $now = now('Asia/Jakarta');

        $today = $now->toDateString();
        $currentTime = $now->format('H:i:s');

        // Mengambil jadwal berdasarkan film yang dipilih.
        $query = $film->jadwals()
            ->with('studio')
            ->where('status', 'aktif')

            // Hanya studio yang aktif.
            ->whereHas('studio', function ($query) {
                $query->where('status', 'aktif');
            })

            // Hanya jadwal yang belum lewat.
            ->where(function ($query) use ($today, $currentTime) {

                $query->whereDate(
                    'tanggal_tayang',
                    '>',
                    $today
                )

                ->orWhere(function ($query) use ($today, $currentTime) {

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

        // Filter berdasarkan tanggal yang dipilih.
        if ($selectedDate) {
            $query->whereDate(
                'tanggal_tayang',
                $selectedDate
            );
        }

        // Urutkan jadwal berdasarkan tanggal dan jam.
        $jadwals = $query
            ->orderBy('tanggal_tayang', 'asc')
            ->orderBy('jam_mulai', 'asc')
            ->get();

        return view('films.show', compact(
            'film',
            'jadwals',
            'selectedDate'
        ));
    }
}