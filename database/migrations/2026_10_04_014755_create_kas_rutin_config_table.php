<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kas_rutin_config', function (Blueprint $table) {
            $table->id();
            $table->decimal('nominal_wajib', 12, 2);
            $table->string('frekuensi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kas_rutin_config');
    }
};
