<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $userId = $request->user()->id;

        // Menggunakan waktu Indonesia (WIB).
        $now = now('Asia/Jakarta');

        $today = $now->toDateString();
        $currentTime = $now->format('H:i:s');

        // Query khusus transaksi milik customer yang login.
        $baseQuery = Pemesanan::query()
            ->where('user_id', $userId);

        /*
        | MENGHITUNG JUMLAH TRANSAKSI SETIAP KATEGORI
        */

        $filterCounts = [

            'all' => (clone $baseQuery)->count(),

            'upcoming' => $this->applyUpcomingFilter(
                (clone $baseQuery)->where('status', 'lunas'),
                $today,
                $currentTime
            )->count(),

            'completed' => $this->applyCompletedFilter(
                (clone $baseQuery)->where('status', 'lunas'),
                $today,
                $currentTime
            )->count(),

            'pending' => (clone $baseQuery)
                ->where('status', 'booking')
                ->count(),

            'cancelled' => (clone $baseQuery)
                ->whereIn('status', [
                    'dibatalkan',
                    'kedaluwarsa'
                ])
                ->count(),

        ];

        /*
        | VALIDASI FILTER
        */

        $allowedFilters = [
            'all',
            'upcoming',
            'completed',
            'pending',
            'cancelled'
        ];

        $filter = $request->query('filter', 'all');

        if (!in_array($filter, $allowedFilters, true)) {
            $filter = 'all';
        }

        /*
        | QUERY TRANSAKSI BERDASARKAN FILTER
        */

        $query = clone $baseQuery;

        switch ($filter) {

            case 'upcoming':

                $query->where('status', 'lunas');

                $this->applyUpcomingFilter(
                    $query,
                    $today,
                    $currentTime
                );

                break;


            case 'completed':

                $query->where('status', 'lunas');

                $this->applyCompletedFilter(
                    $query,
                    $today,
                    $currentTime
                );

                break;


            case 'pending':

                $query->where('status', 'booking');

                break;


            case 'cancelled':

                $query->whereIn('status', [
                    'dibatalkan',
                    'kedaluwarsa'
                ]);

                break;

        }

        /*
        | MENGAMBIL DATA TRANSAKSI
        */

        $pemesanans = $query
            ->with([
                'jadwal.film',
                'jadwal.studio',
                'detailKursis',
                'pembayaran',
            ])
            ->latest('created_at')
            ->paginate(8)
            ->withQueryString();

        return view('customer.dashboard', compact(
            'pemesanans',
            'filter',
            'filterCounts'
        ));
    }


    /*
    | FILTER TIKET YANG BELUM SELESAI
    */

    private function applyUpcomingFilter(
        Builder $query,
        string $today,
        string $currentTime
    ): Builder {

        return $query->whereHas('jadwal', function ($jadwalQuery) use (
            $today,
            $currentTime
        ) {

            $jadwalQuery->where(function ($dateQuery) use (
                $today,
                $currentTime
            ) {

                $dateQuery->whereDate(
                    'tanggal_tayang',
                    '>',
                    $today
                )

                ->orWhere(function ($todayQuery) use (
                    $today,
                    $currentTime
                ) {

                    $todayQuery->whereDate(
                        'tanggal_tayang',
                        '=',
                        $today
                    )

                    ->where(
                        'jam_selesai',
                        '>=',
                        $currentTime
                    );

                });

            });

        });
    }


    /*
    | FILTER TIKET YANG SUDAH SELESAI
    */

    private function applyCompletedFilter(
        Builder $query,
        string $today,
        string $currentTime
    ): Builder {

        return $query->whereHas('jadwal', function ($jadwalQuery) use (
            $today,
            $currentTime
        ) {

            $jadwalQuery->where(function ($dateQuery) use (
                $today,
                $currentTime
            ) {

                $dateQuery->whereDate(
                    'tanggal_tayang',
                    '<',
                    $today
                )

                ->orWhere(function ($todayQuery) use (
                    $today,
                    $currentTime
                ) {

                    $todayQuery->whereDate(
                        'tanggal_tayang',
                        '=',
                        $today
                    )

                    ->where(
                        'jam_selesai',
                        '<',
                        $currentTime
                    );

                });

            });

        });
    }
}