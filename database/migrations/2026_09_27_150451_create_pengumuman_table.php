<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration untuk tabel `pengumuman`.
 *
 * Tabel paling sederhana -- cuma untuk info/pengumuman yang tampil di
 * halaman publik. Tidak ada foreign key sama sekali, jadi bisa dibuat
 * kapan saja tanpa bergantung tabel lain.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('isi');
            $table->date('tanggal_publish');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumuman');
    }
};