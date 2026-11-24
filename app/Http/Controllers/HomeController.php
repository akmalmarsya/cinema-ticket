<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // Mengambil film yang sedang tayang
        $films = Film::query()
            ->where('status', 'tayang')
            ->latest()
            ->get();

        // Menghitung jumlah film yang sedang tayang
        $totalFilms = $films->count();

        return view('home', compact(
            'films',
            'totalFilms'
        ));
    }
}