<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Pengumuman -- paling sederhana, tidak ada relasi ke tabel lain.
 */
class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';

    protected $fillable = [
        'judul',
        'isi',
        'tanggal_publish',
    ];

    protected $casts = [
        'tanggal_publish' => 'date',
    ];
}