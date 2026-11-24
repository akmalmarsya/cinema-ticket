<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pemesanan extends Model
{
    protected $table = 'pemesanans';

    protected $fillable = [
        'jadwal_id',
        'user_id',
        'kode_booking',
        'nama_pemesan',
        'no_hp',
        'total_harga',
        'status',
    ];

    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function detailKursis(): HasMany
    {
        return $this->hasMany(DetailKursi::class);
    }

    public function pembayaran(): HasOne
    {
        return $this->hasOne(Pembayaran::class);
    }
}