<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration untuk tabel `pendaftaran_anggota`.
 *
 * Modul BARU (lihat 04-business-flow-dan-rules.md §4.3) — ini form pendaftaran
 * publik untuk CALON anggota yang belum punya akun sama sekali (guest).
 * Berdiri sendiri, belum terhubung ke User/Anggota, sampai di-approve Admin.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran_anggota', function (Blueprint $table) {
            $table->id();

            $table->string('nama');

            // unique: NIS yang sudah pernah daftar (pending/approved/rejected)
            // tidak boleh dipakai daftar ulang -- sesuai rule di §4.2
            $table->string('nis')->unique()->comment('Dicek supaya tidak dobel daftar');

            $table->string('kelas');
            $table->string('kontak')->comment('No. WA / email calon anggota');
            $table->text('alasan_gabung')->nullable();

            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('alasan_ditolak')->nullable();

            // foreignId nullable: kolom ini KOSONG di awal (saat status masih pending).
            // Baru TERISI otomatis oleh sistem saat Admin approve pendaftaran ini
            // (lihat method approve() di Model PendaftaranAnggota).
            // ->nullOnDelete(): kalau data Anggota-nya suatu saat dihapus, kolom ini
            // otomatis jadi NULL lagi (bukan ikut terhapus), supaya histori pendaftaran tetap ada.
            $table->foreignId('anggota_id')->nullable()
                ->constrained('anggota')->nullOnDelete()
                ->comment('Terisi otomatis setelah approve');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_anggota');
    }
};