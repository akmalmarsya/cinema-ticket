<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();

            $table->string('judul', 150);
            $table->string('genre', 100);
            $table->unsignedSmallInteger('durasi_menit');
            $table->string('rating_usia', 10)->default('SU');
            $table->text('sinopsis')->nullable();
            $table->string('poster')->nullable();

            $table->enum('status', [
                'tayang',
                'tidak_tayang'
            ])->default('tayang');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};