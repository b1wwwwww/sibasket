<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $fillable = [
        'pendaftaran_id',
        'status_kehadiran',
        'catatan',
    ];

    /**
     * Relationship: absensi ini milik 1 baris PendaftaranKegiatan
     * (bukan langsung ke Anggota atau Kegiatan -- lihat penjelasan
     * di komentar migration absensi kenapa desainnya begini).
     */
    public function pendaftaranKegiatan(): BelongsTo
    {
        return $this->belongsTo(PendaftaranKegiatan::class, 'pendaftaran_id');
    }
}