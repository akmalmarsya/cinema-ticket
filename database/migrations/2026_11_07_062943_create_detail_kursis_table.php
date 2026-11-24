<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_kursis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pemesanan_id')
                ->constrained('pemesanans')
                ->cascadeOnDelete();

            $table->foreignId('jadwal_id')
                ->constrained('jadwals')
                ->restrictOnDelete();

            $table->string('no_kursi', 10);

            $table->decimal('harga', 10, 2);

            $table->timestamps();

            $table->unique(['jadwal_id', 'no_kursi']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_kursis');
    }
};