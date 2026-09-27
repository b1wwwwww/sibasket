<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration untuk tabel `pendaftaran_kegiatan`.
 *
 * Ini tabel PIVOT (tabel penghubung) antara Anggota dan Kegiatan — mencatat
 * "anggota mana daftar ke kegiatan mana". BEDA dengan `pendaftaran_anggota`
 * yang isinya calon anggota daftar jadi member baru.
 *
 * WAJIB dibuat SETELAH tabel `anggota` dan `kegiatan` ada, karena tabel ini
 * punya foreign key ke keduanya.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran_kegiatan', function (Blueprint $table) {
            $table->id();

            // Dua foreign key ini yang bikin tabel ini jadi "pivot"/penghubung
            $table->foreignId('anggota_id')->constrained('anggota')->cascadeOnDelete();
            $table->foreignId('kegiatan_id')->constrained('kegiatan')->cascadeOnDelete();

            $table->enum('status', ['terdaftar', 'dibatalkan'])->default('terdaftar');

            // created_at di sini otomatis berfungsi sebagai "waktu daftar" (04-business-flow-dan-rules.md)
            $table->timestamps();

            // unique(['anggota_id', 'kegiatan_id']) = KOMBINASI dua kolom ini harus unik.
            // Artinya: 1 anggota TIDAK BISA daftar ke kegiatan yang SAMA lebih dari sekali.
            // Kalau ada kombinasi yang sama persis, database otomatis TOLAK insert-nya.
            // Ini yang implementasi rule di 04-business-flow-dan-rules.md §4.2:
            // "Satu anggota tidak dapat mendaftar kegiatan yang sama lebih dari satu kali"
            $table->unique(['anggota_id', 'kegiatan_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_kegiatan');
    }
};