<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\PendaftaranKegiatan;
use App\Models\User;
use Illuminate\Database\Seeder;

class DummyAbsensiDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Pastikan ada user untuk anggota
        $users = User::whereHas('roles', fn($q) => $q->where('name', 'Member'))->limit(5)->get();
        
        if ($users->isEmpty()) {
            // Buat user dummy jika tidak ada
            $users = User::factory(5)->create();
            foreach ($users as $user) {
                $user->assignRole('Member');
            }
        }

        // 2. Pastikan ada anggota
        $anggota = Anggota::all();
        
        if ($anggota->isEmpty()) {
            // Buat anggota dummy
            $names = ['Nabil', 'Ahmad', 'Siti', 'Budi', 'Rina', 'Doni', 'Tina', 'Roni'];
            $classes = ['10A', '10B', '11A', '11B', '12A', '12B'];
            $majors = ['IPA', 'IPS'];
            
            foreach ($users as $index => $user) {
                Anggota::create([
                    'user_id' => $user->id,
                    'nis' => '202400' . str_pad($index + 1, 2, '0', STR_PAD_LEFT),
                    'nama' => $names[$index] ?? 'Anggota ' . ($index + 1),
                    'kelas' => $classes[$index % count($classes)],
                    'jurusan' => $majors[$index % count($majors)],
                    'posisi' => ['Guard', 'Forward', 'Center'][$index % 3],
                    'status' => 'aktif',
                    'tanggal_bergabung' => now()->subMonths(rand(1, 6)),
                    'no_hp' => '0812' . rand(10000000, 99999999),
                    'alamat' => 'Jalan ' . $names[$index] . ' No. ' . rand(1, 100),
                ]);
            }
            $anggota = Anggota::all();
        }

        // 3. Pastikan ada kegiatan "Latihan"
        $kegiatan = Kegiatan::where('judul', 'like', '%latihan%')->first();
        
        if (!$kegiatan) {
            $kegiatan = Kegiatan::create([
                'judul' => 'Latihan Rutin',
                'deskripsi' => 'Latihan basket rutin minggu ini',
                'tanggal' => now()->addDay(),
                'lokasi' => 'Lapangan Basket Sekolah',
                'kuota' => 20,
                'status' => 'draft',
            ]);
        }

        // 4. Buat PendaftaranKegiatan untuk semua anggota ke kegiatan latihan
        foreach ($anggota as $member) {
            $exists = PendaftaranKegiatan::where('anggota_id', $member->id)
                ->where('kegiatan_id', $kegiatan->id)
                ->exists();
            
            if (!$exists) {
                PendaftaranKegiatan::create([
                    'anggota_id' => $member->id,
                    'kegiatan_id' => $kegiatan->id,
                    'status' => 'terdaftar',
                ]);
            }
        }

        $this->command->info('✅ Data dummy absensi berhasil dibuat: ' . $anggota->count() . ' anggota terdaftar ke kegiatan ' . $kegiatan->judul);
    }
}
