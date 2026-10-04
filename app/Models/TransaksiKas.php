<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiKas extends Model
{
    use HasFactory;

    protected $table = 'transaksi_kas';

    protected $filable = [
        'anggota_id',
        'nominal',
        'jenis',
        'kategori',
        'status',
        'tanggal_bayar',
        'keterangan',
    ];

    protected $casts = [
        'nominal' => 'decimal:2',
        'tanggal_bayar' => 'date',
    ];

    public function anggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class);
    }

    public function isPemasukan(): bool
    {
        return $this->jenis === 'pemasukan';
    }

    public function isPenguluaran(): bool
    {
        return $this->jenis === 'pengeluaran';
    }

    public function scopePemasukan($query)
    {
        return $query->where('jenis', 'pemasukan')->where('status', 'lunas');
    }

    public function scopePengeluaran($query)
    {
        return $query->where('jenis', 'pengeluaran');
    }
    
}
