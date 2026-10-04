<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasRutinConfig extends Model
{
    use HasFactory;

    protected $table = 'kas_rutin_config';

    protected $fillable = [
        'nominal_wajib',
        'frekuensi',
    ];

    protected $casts = [
        'nominal_wajib' => 'decimal:2',
    ];
}