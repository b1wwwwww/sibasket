<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('anggota', function (Blueprint $table) {
            $table->string('nis')->nullable()->change();
            $table->string('kelas')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('anggota', function (Blueprint $table) {
            $table->string('nis')->nullable(false)->change();
            $table->string('kelas')->nullable(false)->change();
        });
    }
};
