<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KasAnggota extends Model
{
    use HasFactory;

    protected $table = 'kas_anggota';

    protected $fillable = [
        'kas_kegiatan_id',
        'anggota_id',
        'status_bayar',
        'tanggal_bayar',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_bayar' => 'datetime',
    ];

    /**
     * Relationship: KasAnggota milik satu KasKegiatan
     */
    public function kasKegiatan(): BelongsTo
    {
        return $this->belongsTo(KasKegiatan::class);
    }

    /**
     * Relationship: KasAnggota milik satu Anggota
     */
    public function anggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class);
    }
}
