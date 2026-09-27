<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model Anggota — merepresentasikan satu baris di tabel `anggota`.
 *
 * Model = "penerjemah" antara tabel database dan kode PHP kamu.
 * Dengan model ini, kamu bisa nulis `Anggota::all()` atau `$anggota->nama`
 * daripada nulis SQL manual.
 */
class Anggota extends Model
{
    use HasFactory; // trait ini kasih kemampuan bikin data dummy/testing otomatis

    // Wajib disebutkan kalau nama tabelnya nggak sama persis dengan konvensi Laravel
    // (konvensi default Laravel nebak nama tabel dari nama model + 's', jadi kalau
    // model "Anggota" tanpa ini, Laravel akan cari tabel "anggotas" -- salah)
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