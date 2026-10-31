<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalLatihan extends Model
{
    use HasFactory;

    protected $table = 'jadwal_latihans';

    protected $fillable = [
        'hari',
        'jam_mulai',
        'jam_selesai',
        'lokasi',
        'tipe_lokasi',
        'aktif',
    ];

    protected $casts = [
        'jam_mulai' => 'datetime:H:i',
        'jam_selesai' => 'datetime:H:i',
        'aktif' => 'boolean',
    ];

    /**
     * Scope untuk ambil jadwal yang aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('aktif', true)->orderByRaw("FIELD(hari, 'selasa', 'jumat', 'sabtu')");
    }
}
