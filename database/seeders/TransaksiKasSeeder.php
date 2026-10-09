<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\TransaksiKas;
use Illuminate\Database\Seeder;

class TransaksiKasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $anggota = Anggota::all();

        if ($anggota->isEmpty()) {
            $this->command->warn('Pastikan AnggotaSeeder sudah dijalankan.');
            return;
        }

        $kategoriPemasukan = ['Iuran Bulanan', 'Donasi', 'Sponsorship', 'Pendaftaran Anggota'];
        $kategoriPengeluaran = ['Gaji Pelatih', 'Sewa Lapangan', 'Peralatan Basket', 'Konsumsi', 'Transportasi'];

        foreach ($anggota as $a) {
            // Berikan 2-4 transaksi per anggota
            $count = rand(2, 4);
            
            for ($i = 0; $i < $count; $i++) {
                $jenis = fake()->randomElement(['pemasukan', 'pengeluaran']);
                
                TransaksiKas::create([
                    'anggota_id' => $a->id,
                    'nominal' => $jenis === 'pemasukan' ? rand(50000, 200000) : rand(10000, 50000),
                    'jenis' => $jenis,
                    'kategori' => $jenis === 'pemasukan' ? fake()->randomElement($kategoriPemasukan) : fake()->randomElement($kategoriPengeluaran),
                    'status' => fake()->randomElement(['lunas', 'pending', 'nunggak']),
                    'tanggal_bayar' => now()->subDays(rand(1, 30)),
                    'keterangan' => fake()->sentence(),
                ]);
            }
        }

        $this->command->info('TransaksiKas seeded successfully.');
    }
}
