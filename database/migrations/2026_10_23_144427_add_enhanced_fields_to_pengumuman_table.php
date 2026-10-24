<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengumuman', function (Blueprint $table) {
            $table->string('status')->default('published')->after('isi'); // draft, published
            $table->string('kategori')->nullable()->after('status'); // Penting, Info, Prestasi, Lainnya
            $table->string('foto')->nullable()->after('kategori');
            $table->boolean('is_pinned')->default(false)->after('foto'); // Pin to top
            $table->dateTime('tanggal_publish')->change(); // Upgrade date to datetime
        });
    }

    public function down(): void
    {
        Schema::table('pengumuman', function (Blueprint $table) {
            $table->dropColumn(['status', 'kategori', 'foto', 'is_pinned']);
            $table->date('tanggal_publish')->change();
        });
    }
};
