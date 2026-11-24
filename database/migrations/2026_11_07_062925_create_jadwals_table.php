<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('film_id')
                ->constrained('films')
                ->restrictOnDelete();

            $table->foreignId('studio_id')
                ->constrained('studios')
                ->restrictOnDelete();

            $table->date('tanggal_tayang');
            $table->time('jam_mulai');
            $table->time('jam_selesai');

            $table->decimal('harga', 10, 2);

            $table->enum('status', [
                'aktif',
                'dibatalkan'
            ])->default('aktif');

            $table->timestamps();

            $table->index(['studio_id', 'tanggal_tayang']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};