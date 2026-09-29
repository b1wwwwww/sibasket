<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `anggota` = member yang SUDAH diverifikasi & disetujui.
 * Karena verifikasi sudah selesai di titik ini, nis & kelas WAJIB terisi
 * (beda dengan `pendaftaran_anggota` yang keduanya masih nullable).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('nis')->unique()->comment('Nomor Induk Siswa, dipakai sebagai username login');
            $table->string('nama');
            $table->string('kelas');
            $table->string('jurusan', 20)->comment('Nilai dari App\Enums\Jurusan');
            $table->string('posisi')->nullable()->comment('Posisi di basket: PG/SG/C/dll');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->date('tanggal_bergabung');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};