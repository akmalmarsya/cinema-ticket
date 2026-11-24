<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Studio;
use App\Models\Jadwal;
use App\Models\Pemesanan;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'films' => Film::count(),
            'studios' => Studio::count(),
            'schedules' => Jadwal::count(),
            'orders' => Pemesanan::count(),

            'booking' => Pemesanan::where(
                'status',
                'booking'
            )->count(),

            'paid' => Pemesanan::where(
                'status',
                'lunas'
            )->count(),
        ];

        $latestOrders = Pemesanan::with([
            'jadwal.film',
            'jadwal.studio'
        ])
        ->latest()
        ->take(5)
        ->get();

        return view('admin.dashboard', compact(
            'stats',
            'latestOrders'
        ));
    }
}
