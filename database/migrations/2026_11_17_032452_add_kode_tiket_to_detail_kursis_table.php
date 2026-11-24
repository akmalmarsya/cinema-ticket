<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('detail_kursis', function (Blueprint $table) {

            $table->string('kode_tiket', 40)
                ->nullable()
                ->unique()
                ->after('no_kursi');

        });
    }

    public function down(): void
    {
        Schema::table('detail_kursis', function (Blueprint $table) {

            $table->dropUnique(['kode_tiket']);

            $table->dropColumn('kode_tiket');

        });
    }
};