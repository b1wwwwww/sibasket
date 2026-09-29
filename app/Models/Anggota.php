<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Enums\Jurusan;

/**
 * Model Anggota — merepresentasikan satu baris di tabel `anggota`.
 */
class Anggota extends Model
{
    use HasFactory; // trait ini kasih kemampuan bikin data dummy/testing otomatis

    protected $table = 'anggota';

    /**
     * $fillable = daftar kolom yang BOLEH diisi lewat mass-assignment,
     * contoh: Anggota::create(['nama' => 'Budi', 'nis' => '12345', ...])
     *
     * Ini fitur keamanan Laravel: kolom yang TIDAK ada di list ini akan
     * DITOLAK kalau ada yang coba nyuntik-in dari form/request luar,
     * mencegah orang iseng ngirim field yang seharusnya nggak boleh diubah.
     */
    protected $fillable = [
        'user_id',
        'nis',
        'nama',
        'kelas',
        'jurusan',
        'posisi',
        'status',
        'tanggal_bergabung',
    ];

    /**
     * $casts = otomatis "ubah tipe data" saat kolom ini diambil dari database.
     * Kolom tanggal_bergabung di database itu string ("2026-01-15"), tapi
     * dengan cast 'date', begitu diakses lewat $anggota->tanggal_bergabung
     * dia otomatis jadi object Carbon (bisa dipanggil ->format('d/m/Y') dst).
     */
    protected $casts = [
        'tanggal_bergabung' => 'date',
        'jurusan' => Jurusan::class,
    ];

    /**
     * Relationship: 1 Anggota dimiliki oleh 1 User (akun login).
     * Dipakai: $anggota->user->email
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: 1 Anggota bisa punya BANYAK riwayat pendaftaran kegiatan.
     * Dipakai: $anggota->pendaftaranKegiatan (mengembalikan collection/list)
     */
    public function pendaftaranKegiatan(): HasMany
    {
        return $this->hasMany(PendaftaranKegiatan::class);
    }

    /**
     * Relationship: kalau anggota ini asalnya dari approve pendaftaran anggota baru,
     * ini nunjuk balik ke data pendaftaran aslinya (untuk histori/audit).
     */
    public function pendaftaranAnggota(): HasMany
    {
        return $this->hasMany(PendaftaranAnggota::class);
    }

    /**
     * Helper method biasa (bukan relationship) -- ini contoh "cara Laravel yang rapi"
     * daripada nulis `if ($anggota->status === 'aktif')` berulang-ulang di banyak file,
     * cukup panggil `if ($anggota->isAktif())`.
     */
    public function isAktif(): bool
    {
        return $this->status === 'aktif';
    }
}