<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model PendaftaranAnggota -- form pendaftaran calon anggota baru (guest).
 */
class PendaftaranAnggota extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_anggota';

    protected $fillable = [
        'nama',
        'nis',
        'kelas',
        'kontak',
        'alasan_gabung',
        'status',
        'alasan_ditolak',
        'anggota_id',
    ];

    /**
     * Relationship: kalau sudah di-approve, ini nunjuk ke Anggota yang
     * otomatis dibuat sistem. Sebelum approve, ini akan bernilai NULL.
     */
    public function anggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class);
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

}
