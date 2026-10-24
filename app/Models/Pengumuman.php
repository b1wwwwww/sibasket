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
        'status',
        'kategori',
        'foto',
        'is_pinned',
        'scheduled_at',
    ];

    protected $casts = [
        'tanggal_publish' => 'datetime',
        'is_pinned' => 'boolean',
        'scheduled_at' => 'datetime',
    ];
}