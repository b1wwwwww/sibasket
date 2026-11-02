<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration untuk menambahkan field jadwal_latihan_id ke tabel kegiatan.
 * 
 * Tujuan: Link kegiatan ke JadwalLatihan, agar kegiatan bisa di-auto-generate
 * dari template jadwal latihan rutin (Selasa, Jumat, Sabtu).
 * 
 * Field yang ditambahkan:
 * - jadwal_latihan_id: FK ke jadwal_latihans (nullable, untuk kegiatan khusus)
 * - is_recurring: Flag untuk tandai kegiatan recurring (auto-generated)
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            // Tambah jadwal_latihan_id (nullable FK)
            $table->unsignedBigInteger('jadwal_latihan_id')->nullable()->after('id');
            $table->foreign('jadwal_latihan_id')
                ->references('id')
                ->on('jadwal_latihans')
                ->onDelete('set null'); // Jika jadwal dihapus, kegiatan tidak ikut terhapus

            // Tambah is_recurring flag (untuk auto-generated kegiatan)
            $table->boolean('is_recurring')->default(false)->after('status');

            // Tambah tanggal_selesai kalau belum ada (untuk durasi kegiatan)
            if (!Schema::hasColumn('kegiatan', 'tanggal_selesai')) {
                $table->dateTime('tanggal_selesai')->nullable()->after('tanggal');
            }

            // Tambah kategori kalau belum ada
            if (!Schema::hasColumn('kegiatan', 'kategori')) {
                $table->string('kategori')->nullable()->after('lokasi')->comment('latihan, pertandingan, seleksi, dll');
            }

            // Tambah foto kalau belum ada
            if (!Schema::hasColumn('kegiatan', 'foto')) {
                $table->string('foto')->nullable()->after('kategori');
            }
        });
    }

    public function down(): void
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            $table->dropForeignIdFor('jadwal_latihans', 'jadwal_latihan_id');
            $table->dropColumn('jadwal_latihan_id');
            $table->dropColumn('is_recurring');
        });
    }
};
