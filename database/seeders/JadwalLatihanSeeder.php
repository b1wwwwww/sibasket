<?php

namespace Database\Seeders;

use App\Models\JadwalLatihan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalLatihanSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JadwalLatihan::truncate();

        $jadwalLatihan = [
            [
                'hari' => 'selasa',
                'jam_mulai' => '15:00',
                'jam_selesai' => '17:00',
                'lokasi' => 'Lapangan Sekolah',
                'tipe_lokasi' => 'outdoor',
                'aktif' => true,
            ],
            [
                'hari' => 'jumat',
                'jam_mulai' => '15:00',
                'jam_selesai' => '17:00',
                'lokasi' => 'Lapangan Sekolah',
                'tipe_lokasi' => 'outdoor',
                'aktif' => true,
            ],
            [
                'hari' => 'sabtu',
                'jam_mulai' => '07:00',
                'jam_selesai' => '10:30',
                'lokasi' => 'GOR',
                'tipe_lokasi' => 'indoor',
                'aktif' => true,
            ],
        ];

        foreach ($jadwalLatihan as $jadwal) {
            JadwalLatihan::create($jadwal);
        }
    }
}
