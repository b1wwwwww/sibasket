<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration untuk tabel `kegiatan`.
 *
 * Menyimpan data latihan/pertandingan/seleksi yang dibuat Admin.
 * Sesuai skema di 06-database.md §6.3 dan alur di 04-business-flow-dan-rules.md §4.1
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();

            $table->string('judul');
            $table->text('deskripsi')->nullable(); // text = boleh panjang, beda dari string (varchar, max 255)

            // dateTime = simpan tanggal + jam sekaligus (misal "2026-10-01 15:00:00")
            $table->dateTime('tanggal');
            $table->string('lokasi');

            // integer nullable: kalau NULL artinya kegiatan ini TIDAK dibatasi kuota
            // (logic ceknya ada di method isKuotaPenuh() pada Model Kegiatan)
            $table->integer('kuota')->nullable()->comment('null = tanpa batas kuota');

            // 5 status ini urutannya sesuai alur bisnis:
            // draft -> published -> ongoing -> completed (atau cancelled kapan saja)
            $table->enum('status', ['draft', 'published', 'ongoing', 'completed', 'cancelled'])
                ->default('draft');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};