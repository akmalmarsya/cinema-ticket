<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jadwal extends Model
{
    protected $table = 'jadwals';

    protected $fillable = [
        'film_id',
        'studio_id',
        'tanggal_tayang',
        'jam_mulai',
        'jam_selesai',
        'harga',
        'status',
    ];

    public function film(): BelongsTo
    {
        return $this->belongsTo(Film::class);
    }

    public function studio(): BelongsTo
    {
        return $this->belongsTo(Studio::class);
    }

    public function pemesanans(): HasMany
    {
        return $this->hasMany(Pemesanan::class);
    }

    public function detailKursis(): HasMany
    {
        return $this->hasMany(DetailKursi::class);
    }
}