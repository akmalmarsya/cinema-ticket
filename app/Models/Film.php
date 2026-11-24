<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Film extends Model
{
    protected $fillable = [
        'judul',
        'genre',
        'durasi_menit',
        'rating_usia',
        'sinopsis',
        'poster',
        'status',
    ];

    public function jadwals(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }
}