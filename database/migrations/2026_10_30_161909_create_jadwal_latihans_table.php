<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_latihans', function (Blueprint $table) {
            $table->id();
            $table->string('hari'); // selasa, jumat, sabtu
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('lokasi'); // Lapangan Sekolah, GOR, dll
            $table->enum('tipe_lokasi', ['indoor', 'outdoor'])->default('outdoor');
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_latihans');
    }
};
