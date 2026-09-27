<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration untuk tabel `anggota`.
 *
 * Tabel ini menyimpan data profil anggota eskul basket yang SUDAH resmi jadi
 * member (beda dengan `pendaftaran_anggota` yang isinya calon anggota).
 *
 * Sesuai skema di 06-database.md §6.3
 */
return new class extends Migration
{
    /**
     * Method up() = perintah yang dijalankan saat migration di-apply
     * (misalnya lewat `php artisan migrate`). Isinya "bikin apa".
     */
    public function up(): void
    {
        Schema::create('anggota', function (Blueprint $table) {
            // Primary key otomatis (auto-increment bigint), wajib ada di semua tabel
            $table->id();

            // Foreign key ke tabel `users`. Setiap anggota WAJIB punya akun login.
            // ->constrained('users') artinya kolom ini "mengunci" ke tabel users.id
            // ->cascadeOnDelete() artinya kalau User-nya dihapus, data Anggota ini ikut terhapus otomatis
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            // Nomor Induk Siswa. unique() = tidak boleh ada 2 anggota dengan NIS yang sama.
            // Ini penting karena NIS dipakai sebagai username login (lihat 04-business-flow-dan-rules.md §4.3)
            $table->string('nis')->unique()->comment('Nomor Induk Siswa');

            $table->string('nama');
            $table->string('kelas');

            // nullable() = boleh kosong. Nggak semua anggota langsung punya posisi ditentukan.
            $table->string('posisi')->nullable()->comment('Posisi di basket: PG/SG/C/dll');

            // enum = kolom yang isinya HANYA boleh salah satu dari pilihan ini.
            // default('aktif') = kalau tidak diisi saat create, otomatis jadi 'aktif'
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');

            $table->date('tanggal_bergabung');

            // Otomatis bikin 2 kolom: created_at dan updated_at (timestamp)
            $table->timestamps();
        });
    }

    /**
     * Method down() = perintah kebalikan dari up(), dipakai kalau kamu
     * mau "membatalkan" migration ini (php artisan migrate:rollback).
     * Isinya selalu "hapus apa yang tadi dibuat di up()".
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};