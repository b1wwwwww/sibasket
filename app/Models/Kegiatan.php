<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'tanggal_selesai',
        'lokasi',
        'kuota',
        'kategori',
        'foto',
        'status',
    ];

    protected $casts = [
        // 'datetime' beda dengan 'date': ini simpan tanggal SEKALIGUS jam
        'tanggal' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    /**
     * Relationship: 1 Kegiatan bisa punya BANYAK pendaftaran dari berbagai anggota.
     */
    public function pendaftaranKegiatan(): HasMany
    {
        return $this->hasMany(PendaftaranKegiatan::class);
    }

    /**
     * Relationship: akses langsung Absensi dari Kegiatan melalui PendaftaranKegiatan.
     * Digunakan di recap-absensi untuk query lebih mudah.
     */
    public function absensis(): HasManyThrough
    {
        return $this->hasManyThrough(Absensi::class, PendaftaranKegiatan::class, 'kegiatan_id', 'pendaftaran_id');
    }

    /**
     * Relationship: 1 Kegiatan punya 1 KasKegiatan (untuk tracking kas iuran)
     */
    public function kasKegiatan(): HasMany
    {
        return $this->hasMany(KasKegiatan::class);
    }

    /**
     * Cek apakah kegiatan ini masih boleh menerima pendaftaran baru.
     * Sesuai rule 04-business-flow-dan-rules.md §4.2:
     * "Kegiatan completed atau cancelled tidak dapat menerima pendaftaran baru"
     * "Hanya kegiatan published yang tampil di halaman publik"
     *
     * Jadi logic-nya: HANYA status 'published' yang boleh nerima pendaftaran
     * (draft belum dipublish ke publik, ongoing/completed/cancelled sudah lewat masanya).
     */
    public function isMenerimaPendaftaran(): bool
    {
        return $this->status === 'published';
    }

    /**
     * Cek apakah kuota kegiatan ini sudah penuh.
     * Dipakai sebelum proses pendaftaran diizinkan (lihat 04-business-flow-dan-rules.md §4.1
     * bagian "Pendaftaran Kegiatan" -> validasi kuota).
     */
    public function isKuotaPenuh(): bool
    {
        // Kalau kuota NULL, artinya "tanpa batas" -- jadi nggak pernah penuh
        if ($this->kuota === null) {
            return false;
        }

        // Hitung berapa banyak yang statusnya masih 'terdaftar' (bukan yang dibatalkan)
        $jumlahTerdaftar = $this->pendaftaranKegiatan()
            ->where('status', 'terdaftar')
            ->count();

        return $jumlahTerdaftar >= $this->kuota;
    }
}