<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            // tanggal_selesai diletakkan setelah kolom tanggal
            $table->dateTime('tanggal_selesai')->nullable()->after('tanggal');
            
            // kategori diletakkan setelah deskripsi
            $table->string('kategori')->nullable()->after('deskripsi')->comment('latihan, pertandingan, seleksi, gathering, dll');
            
            // foto (opsional) diletakkan setelah kategori
            $table->string('foto')->nullable()->after('kategori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            $table->dropColumn(['tanggal_selesai', 'kategori', 'foto']);
        });
    }
};
