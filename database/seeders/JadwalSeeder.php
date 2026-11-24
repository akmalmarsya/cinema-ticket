<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Film;
use App\Models\Studio;
use App\Models\Jadwal;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        $film1 = Film::where(
            'judul',
            'Petualangan Nusantara'
        )->firstOrFail();

        $film2 = Film::where(
            'judul',
            'Misteri Malam'
        )->firstOrFail();

        $film3 = Film::where(
            'judul',
            'Cinta di Ujung Senja'
        )->firstOrFail();

        $studio1 = Studio::where(
            'nama',
            'Studio 1'
        )->firstOrFail();

        $studio2 = Studio::where(
            'nama',
            'Studio 2'
        )->firstOrFail();

        $besok = now()->addDay()->toDateString();
        $lusa = now()->addDays(2)->toDateString();

        $jadwals = [
            [
                'film_id' => $film1->id,
                'studio_id' => $studio1->id,
                'tanggal_tayang' => $besok,
                'jam_mulai' => '10:00:00',
                'jam_selesai' => '12:00:00',
                'harga' => 35000,
                'status' => 'aktif',
            ],
            [
                'film_id' => $film2->id,
                'studio_id' => $studio1->id,
                'tanggal_tayang' => $besok,
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '14:50:00',
                'harga' => 40000,
                'status' => 'aktif',
            ],
            [
                'film_id' => $film3->id,
                'studio_id' => $studio2->id,
                'tanggal_tayang' => $besok,
                'jam_mulai' => '10:00:00',
                'jam_selesai' => '12:15:00',
                'harga' => 35000,
                'status' => 'aktif',
            ],
            [
                'film_id' => $film1->id,
                'studio_id' => $studio2->id,
                'tanggal_tayang' => $lusa,
                'jam_mulai' => '16:00:00',
                'jam_selesai' => '18:00:00',
                'harga' => 40000,
                'status' => 'aktif',
            ],
        ];

        foreach ($jadwals as $jadwal) {
            Jadwal::updateOrCreate(
                [
                    'film_id' => $jadwal['film_id'],
                    'studio_id' => $jadwal['studio_id'],
                    'tanggal_tayang' => $jadwal['tanggal_tayang'],
                    'jam_mulai' => $jadwal['jam_mulai'],
                ],
                $jadwal
            );
        }
    }
}