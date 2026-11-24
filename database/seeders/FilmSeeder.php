<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Film;

class FilmSeeder extends Seeder
{
    public function run(): void
    {
        $films = [
            [
                'judul' => 'Petualangan Nusantara',
                'genre' => 'Adventure',
                'durasi_menit' => 120,
                'rating_usia' => 'SU',
                'sinopsis' => 'Petualangan seru menjelajahi keindahan Nusantara.',
                'status' => 'tayang',
            ],
            [
                'judul' => 'Misteri Malam',
                'genre' => 'Horror',
                'durasi_menit' => 110,
                'rating_usia' => '17+',
                'sinopsis' => 'Kisah misteri yang terjadi pada malam hari.',
                'status' => 'tayang',
            ],
            [
                'judul' => 'Cinta di Ujung Senja',
                'genre' => 'Romance',
                'durasi_menit' => 135,
                'rating_usia' => '13+',
                'sinopsis' => 'Kisah perjalanan cinta dan kehidupan.',
                'status' => 'tayang',
            ],
        ];

        foreach ($films as $film) {
            Film::updateOrCreate(
                ['judul' => $film['judul']],
                $film
            );
        }
    }
}