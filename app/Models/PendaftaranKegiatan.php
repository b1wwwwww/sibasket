<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Model PendaftaranKegiatan -- tabel pivot antara Anggota <-> Kegiatan.
 */
class PendaftaranKegiatan extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_kegiatan';

    protected $fillable = [
        'anggota_id',
        'kegiatan_id',
        'status',
    ];

    /**
     * Relationship: pendaftaran ini milik 1 Anggota
     */
    public function anggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class);
    }

    /**
     * Relationship: pendaftaran ini untuk 1 Kegiatan
     */
    public function kegiatan(): BelongsTo
    {
        return $this->belongsTo(Kegiatan::class);
    }

    /**
     * Relationship: HasOne (bukan HasMany) karena satu pendaftaran cuma
     * boleh punya SATU data absensi (sesuai unique constraint di migration absensi).
     *
     * 'pendaftaran_id' di sini ngasih tau Laravel: "cari di tabel absensi,
     * kolom mana yang nunjuk balik ke sini" -- karena nama kolomnya bukan
     * 'pendaftaran_kegiatan_id' (default tebakan Laravel), tapi 'pendaftaran_id'.
     */
    public function absensi(): HasOne
    {
        return $this->hasOne(Absensi::class, 'pendaftaran_id');
    }
}
