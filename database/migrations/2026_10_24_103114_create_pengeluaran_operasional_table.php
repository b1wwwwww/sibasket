<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengeluaran_operasional', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->enum('kategori', ['booking_lapang', 'beli_barang', 'bantu_teman', 'lainnya'])->default('lainnya');
            $table->integer('nominal');
            $table->text('keterangan')->nullable();
            $table->text('note')->nullable(); // Note untuk tracking/bantuan ke anggota
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengeluaran_operasional');
    }
};
