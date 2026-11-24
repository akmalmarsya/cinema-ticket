<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Studio;

class StudioSeeder extends Seeder
{
    public function run(): void
    {
        $studios = [
            [
                'nama' => 'Studio 1',
                'tipe' => 'Reguler',
                'jumlah_baris' => 5,
                'kursi_per_baris' => 8,
                'kapasitas' => 40,
                'status' => 'aktif',
            ],
            [
                'nama' => 'Studio 2',
                'tipe' => 'Premium',
                'jumlah_baris' => 6,
                'kursi_per_baris' => 10,
                'kapasitas' => 60,
                'status' => 'aktif',
            ],
        ];

        foreach ($studios as $studio) {
            Studio::updateOrCreate(
                ['nama' => $studio['nama']],
                $studio
            );
        }
    }
}