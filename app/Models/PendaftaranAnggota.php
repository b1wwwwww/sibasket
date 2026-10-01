<?php

namespace App\Models;

use App\Enums\Jurusan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PendaftaranAnggota extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_anggota';

    protected $fillable = [
        'nama',
        'nama_panggilan',
        'jurusan',
        'jenis_kelamin',
        'kontak_siswa',
        'kontak_orang_tua',
        'pengalaman_basket',
        'alasan_gabung',
        'setuju_peraturan',
        'orang_tua_mengetahui',
        'nis',              // diisi Admin saat verifikasi, bukan oleh calon anggota
        'kelas',            // diisi Admin saat verifikasi, bukan oleh calon anggota
        'status',
        'alasan_ditolak',
        'anggota_id',
    ];

    protected $casts = [
        'jurusan' => Jurusan::class,
        'setuju_peraturan' => 'boolean',
    ];

    public function anggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class);
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Helper: cek apakah data ini SIAP di-approve.
     * Sesuai keputusan bisnis -- NIS & Kelas wajib diisi Admin dulu
     * (lewat verifikasi WA/langsung) sebelum tombol Approve boleh aktif.
     * Dipakai nanti di Filament Resource untuk disable tombol Approve
     * kalau method ini return false.
     */
    public function siapDiapprove(): bool
    {
        return ! empty($this->nis) && ! empty($this->kelas);
    }
}