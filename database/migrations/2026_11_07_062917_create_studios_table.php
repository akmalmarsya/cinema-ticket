<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('studios', function (Blueprint $table) {
            $table->id();

            $table->string('nama', 100)->unique();
            $table->string('tipe', 50)->default('Reguler');

            $table->unsignedTinyInteger('jumlah_baris')->default(5);
            $table->unsignedTinyInteger('kursi_per_baris')->default(8);
            $table->unsignedSmallInteger('kapasitas');

            $table->enum('status', [
                'aktif',
                'nonaktif'
            ])->default('aktif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('studios');
    }
};