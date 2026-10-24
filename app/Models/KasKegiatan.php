<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KasKegiatan extends Model
{
    use HasFactory;

    protected $table = 'kas_kegiatan';

    protected $fillable = [
        'kegiatan_id',
        'nominal_kas',
        'target_total',
    ];

    protected $casts = [
        'nominal_kas' => 'integer',
        'target_total' => 'integer',
    ];

    /**
     * Relationship: KasKegiatan milik satu Kegiatan
     */
    public function kegiatan(): BelongsTo
    {
        return $this->belongsTo(Kegiatan::class);
    }

    /**
     * Relationship: KasKegiatan punya banyak KasAnggota (tracking siapa bayar/belum)
     */
    public function kasAnggota(): HasMany
    {
        return $this->hasMany(KasAnggota::class);
    }

    /**
     * Helper: Hitung total kas yang sudah terkumpul
     */
    public function totalTerkumpul(): int
    {
        return $this->kasAnggota()
            ->where('status_bayar', 'sudah_bayar')
            ->count() * $this->nominal_kas;
    }

    /**
     * Helper: Hitung total kas yang belum terkumpul
     */
    public function totalBelum(): int
    {
        return $this->kasAnggota()
            ->where('status_bayar', 'belum_bayar')
            ->count() * $this->nominal_kas;
    }

    /**
     * Helper: List anggota yang belum bayar
     */
    public function anggotaBelumBayar()
    {
        return $this->kasAnggota()
            ->where('status_bayar', 'belum_bayar')
            ->with('anggota')
            ->get();
    }
}
