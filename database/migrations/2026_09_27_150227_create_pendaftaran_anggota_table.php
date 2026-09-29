<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `pendaftaran_anggota` = form pendaftaran publik, isinya PERSIS
 * mengikuti pertanyaan di Google Form "Pendaftaran Eskul Basket Komet".
 *
 * nis & kelas SENGAJA nullable -- keduanya TIDAK ditanyakan ke calon
 * anggota saat isi form (form aslinya memang tidak menanyakan ini).
 * Diisi belakangan oleh Admin, biasanya lewat WhatsApp follow-up yang
 * memang sudah jadi bagian dari alur (lihat 04-business-flow-dan-rules.md
 * §4.3 -- "Admin sampaikan info login ke calon anggota secara manual").
 *
 * Penanda unik pengganti NIS untuk cek pendaftaran ganda: nomor WA siswa.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran_anggota', function (Blueprint $table) {
            $table->id();

            $table->string('nama');
            $table->string('nama_panggilan');
            $table->string('jurusan', 20)->comment('Nilai dari App\Enums\Jurusan');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);

            $table->string('kontak_siswa')->unique()->comment('No. WA siswa, dicek supaya tidak dobel daftar');
            $table->string('kontak_orang_tua');

            $table->string('pengalaman_basket')->nullable()->comment('iya/tidak/jawaban bebas dari opsi "Yang lain"');
            $table->text('alasan_gabung')->comment('Motivasi bergabung');
            $table->boolean('setuju_peraturan')->default(false);
            $table->string('orang_tua_mengetahui')->nullable();

            // Diisi Admin belakangan, setelah verifikasi identitas via WA/langsung
            $table->string('nis')->nullable();
            $table->string('kelas')->nullable();

            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('alasan_ditolak')->nullable();
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