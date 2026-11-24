<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    protected $table = 'pembayarans';

    protected $fillable = [
        'pemesanan_id',
        'metode_pembayaran',
        'kode_referensi',
        'jumlah_bayar',
        'status',
        'waktu_bayar',
    ];

    public function pemesanan(): BelongsTo
    {
        return $this->belongsTo(Pemesanan::class);
    }
}