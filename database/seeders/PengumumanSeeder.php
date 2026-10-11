<?php

namespace Database\Seeders;

use App\Models\Pengumuman;
use Illuminate\Database\Seeder;

class PengumumanSeeder extends Seeder
{
    public function run(): void
    {
        Pengumuman::firstOrCreate(
            ['judul' => 'Jadwal Latihan Rutin Basket Pekan Ini'],
            [
                'isi' => 'Diberitahukan kepada seluruh anggota ekstrakurikuler basket bahwa latihan rutin akan dilaksanakan pada hari Rabu dan Jumat pukul 15.30 WIB di Lapangan Indoor SMAN 1. Harap hadir tepat waktu dan membawa perlengkapan lengkap.',
                'tanggal_publish' => now()->subDays(2),
            ]
        );

        Pengumuman::firstOrCreate(
            ['judul' => 'Seleksi Tim Inti Tournament Antar Sekolah'],
            [
                'isi' => 'Pendaftaran seleksi tim inti untuk kejuaraan basket antar sekolah sudah dibuka. Bagi anggota yang berminat, silakan mendaftarkan diri melalui menu Pendaftaran Kegiatan paling lambat hari Kamis.',
                'tanggal_publish' => now()->subDays(5),
            ]
        );

        Pengumuman::firstOrCreate(
            ['judul' => 'Iuran Kas Bulanan Bulan Oktober 2026'],
            [
                'isi' => 'Kepada seluruh anggota diingatkan untuk segera melunasi iuran kas bulanan paling lambat tanggal 25 Oktober 2026 kepada Bendahara. Terima kasih atas kerjasamanya.',
                'tanggal_publish' => now()->subDays(10),
            ]
        );

        echo "✓ Seeder pengumuman berhasil dijalankan.\n";
    }
}
