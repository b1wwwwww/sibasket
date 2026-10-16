@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Pengumuman Terbaru</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Pengumuman Card -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 h-2"></div>
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Jadwal Latihan Bulan Oktober</h3>
                <p class="text-gray-600 mb-4">
                    Berikut adalah jadwal latihan resmi untuk bulan Oktober. Pastikan semua anggota aktif dapat hadir...
                </p>
                <div class="flex justify-between items-center text-sm text-gray-500">
                    <span>📅 2026-10-09</span>
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-semibold">Baca Selengkapnya →</a>
                </div>
            </div>
        </div>

        <!-- Pengumuman Card -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition overflow-hidden">
            <div class="bg-gradient-to-r from-green-600 to-green-800 h-2"></div>
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Informasi Iuran Bulanan</h3>
                <p class="text-gray-600 mb-4">
                    Pengingat pembayaran iuran bulanan untuk bulan Oktober. Silakan transfer ke rekening klub sebelum akhir bulan...
                </p>
                <div class="flex justify-between items-center text-sm text-gray-500">
                    <span>📅 2026-10-08</span>
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-semibold">Baca Selengkapnya →</a>
                </div>
            </div>
        </div>

        <!-- Pengumuman Card -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition overflow-hidden">
            <div class="bg-gradient-to-r from-purple-600 to-purple-800 h-2"></div>
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Turnamen Regional Basket</h3>
                <p class="text-gray-600 mb-4">
                    Klub kami akan mengikuti turnamen basket regional tahun ini. Daftar untuk bergabung dengan tim kami...
                </p>
                <div class="flex justify-between items-center text-sm text-gray-500">
                    <span>📅 2026-10-07</span>
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-semibold">Baca Selengkapnya →</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Load More Button -->
    <div class="text-center mt-12">
        <button class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700">
            Lihat Lebih Banyak
        </button>
    </div>
</div>
@endsection
