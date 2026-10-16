@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <a href="/kegiatan-publik" class="text-blue-600 hover:text-blue-800 mb-6 inline-block">← Kembali ke Daftar</a>
    
    <div class="bg-white rounded-lg shadow-md p-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Latihan Rutin Basket</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 pb-8 border-b">
            <div>
                <p class="text-gray-600 text-sm">📅 Tanggal</p>
                <p class="text-lg font-semibold">2026-10-15 19:00</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">📍 Lokasi</p>
                <p class="text-lg font-semibold">Lapangan Indoor Basket</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">👥 Kuota</p>
                <p class="text-lg font-semibold">15 / 20 Peserta</p>
            </div>
        </div>

        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">Deskripsi</h2>
            <p class="text-gray-700 leading-relaxed">
                Latihan basket rutin untuk semua level. Kami akan fokus pada teknik dasar, pertahanan, dan permainan tim. 
                Pastikan datang tepat waktu dan membawa perlengkapan basket yang lengkap.
            </p>
        </div>

        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">Persyaratan</h2>
            <ul class="list-disc list-inside text-gray-700 space-y-2">
                <li>Member aktif klub basket</li>
                <li>Membawa perlengkapan sendiri (sepatu basket, baju olahraga)</li>
                <li>Dalam kondisi kesehatan yang baik</li>
                <li>Tiba 15 menit sebelum kegiatan dimulai</li>
            </ul>
        </div>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
            @auth
                <a href="#" class="w-full px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 text-center block">
                    Daftar Sekarang
                </a>
            @else
                <p class="text-gray-700 mb-4">Silakan login untuk mendaftar kegiatan ini</p>
                <a href="/login" class="w-full px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 text-center block">
                    Login untuk Mendaftar
                </a>
            @endauth
        </div>
    </div>
</div>
@endsection
