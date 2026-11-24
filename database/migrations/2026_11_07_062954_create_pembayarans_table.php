<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pemesanan_id')
                ->unique()
                ->constrained('pemesanans')
                ->cascadeOnDelete();

            $table->string('metode_pembayaran', 50);

            $table->string('kode_referensi', 100)
                ->nullable()
                ->unique();

            $table->decimal('jumlah_bayar', 12, 2);

            $table->enum('status', [
                'menunggu',
                'berhasil',
                'gagal'
            ])->default('menunggu');

            $table->timestamp('waktu_bayar')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};