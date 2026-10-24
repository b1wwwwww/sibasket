<?php

namespace Database\Seeders;

use App\Models\PengeluaranOperasional;
use Illuminate\Database\Seeder;

class PengeluaranOperasionalSeeder extends Seeder
{
    public function run(): void
    {
        $pengeluaran = [
            [
                'tanggal' => now()->subDays(15),
                'kategori' => 'booking_lapang',
                'nominal' => 800000,
                'keterangan' => 'Booking lapang untuk latihan 4 pertemuan',
                'note' => 'Arena utama Sabtu-Minggu',
            ],
            [
                'tanggal' => now()->subDays(12),
                'kategori' => 'beli_barang',
                'nominal' => 300000,
                'keterangan' => 'Beli bola basket 3 pcs merk Mikasa',
                'note' => 'Untuk latihan intensif',
            ],
            [
                'tanggal' => now()->subDays(10),
                'kategori' => 'bantu_teman',
                'nominal' => 50000,
                'keterangan' => 'Bantu bayar lapang untuk Andi (kasir emergency)',
                'note' => 'Menalangi kas Andi yang belum bayar',
            ],
            [
                'tanggal' => now()->subDays(8),
                'kategori' => 'lainnya',
                'nominal' => 150000,
                'keterangan' => 'Bensin perjalanan ke lokasi pertandingan',
                'note' => 'Untuk pembelian solar',
            ],
            [
                'tanggal' => now()->subDays(5),
                'kategori' => 'beli_barang',
                'nominal' => 250000,
                'keterangan' => 'Beli cone, pylon, dan matras latihan',
                'note' => 'Equipment latihan baru',
            ],
            [
                'tanggal' => now()->subDays(3),
                'kategori' => 'booking_lapang',
                'nominal' => 600000,
                'keterangan' => 'Booking lapang untuk pertandingan internal',
                'note' => 'Persiapan tournament minggu depan',
            ],
            [
                'tanggal' => now()->subDays(1),
                'kategori' => 'lainnya',
                'nominal' => 200000,
                'keterangan' => 'Snack untuk peserta latihan intensif',
                'note' => 'Kopi & roti hangat minggu lalu',
            ],
        ];

        foreach ($pengeluaran as $item) {
            // Cek apakah sudah ada pengeluaran dengan kategori dan tanggal yang sama
            $exists = PengeluaranOperasional::where('tanggal', $item['tanggal']->format('Y-m-d'))
                ->where('kategori', $item['kategori'])
                ->where('nominal', $item['nominal'])
                ->exists();

            if (!$exists) {
                PengeluaranOperasional::create($item);
            }
        }
    }
}
