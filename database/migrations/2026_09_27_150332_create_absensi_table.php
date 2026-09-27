<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration untuk tabel `absensi`.
 *
 * Mencatat kehadiran anggota di suatu kegiatan. PENTING: absensi terhubung
 * ke `pendaftaran_kegiatan`, BUKAN langsung ke anggota/kegiatan -- karena
 * cuma anggota yang SUDAH terdaftar di kegiatan itu yang boleh diabsen
 * (lihat 04-business-flow-dan-rules.md §4.2 bagian Absensi).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();

            // FK ke pendaftaran_kegiatan (bukan ke anggota_id + kegiatan_id terpisah).
            // Ini otomatis MEMAKSA aturan "hanya peserta terdaftar yang bisa diabsen",
            // karena data absensi ini nggak akan pernah bisa dibuat kalau baris
            // pendaftaran_kegiatan-nya belum ada.
            $table->foreignId('pendaftaran_id')->constrained('pendaftaran_kegiatan')->cascadeOnDelete();

            $table->enum('status_kehadiran', ['hadir', 'izin', 'sakit', 'alpa']);
            $table->text('catatan')->nullable();

            $table->timestamps();

            // unique('pendaftaran_id'): satu baris pendaftaran_kegiatan HANYA BOLEH
            // punya SATU data absensi. Ini mencegah anggota diabsen dobel di kegiatan
            // yang sama -- sesuai rule "Satu anggota hanya punya satu data kehadiran
            // per kegiatan (tidak boleh dobel input)"
            $table->unique('pendaftaran_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};