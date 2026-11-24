<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailKursi extends Model
{
    protected $table = 'detail_kursis';

    protected $fillable = [
        'pemesanan_id',
        'jadwal_id',
        'no_kursi',
        'harga',
        'kode_tiket',
    ];

    public function pemesanan(): BelongsTo
    {
        return $this->belongsTo(Pemesanan::class);
    }

    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class);
    }
}