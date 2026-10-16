@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Daftar Kegiatan Publik</h1>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="mb-6">
            <input 
                type="text" 
                id="search"
                placeholder="Cari kegiatan..."
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500"
            />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="kegiatan-list">
            <div class="col-span-full text-center text-gray-500">
                Memuat data kegiatan...
            </div>
        </div>
    </div>
</div>

<script>
    // Placeholder - dalam implementasi real, fetch dari API
    document.getElementById('kegiatan-list').innerHTML = `
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg shadow p-6 border border-blue-200">
            <h3 class="text-xl font-semibold text-blue-900 mb-2">Latihan Rutin Basket</h3>
            <p class="text-gray-700 mb-4">Latihan basket rutin setiap hari Rabu dan Sabtu</p>
            <p class="text-sm text-gray-600 mb-4">📅 2026-10-15 | 📍 Lapangan Indoor</p>
            <a href="#" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Lihat Detail</a>
        </div>
        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg shadow p-6 border border-green-200">
            <h3 class="text-xl font-semibold text-green-900 mb-2">Turnamen Mini</h3>
            <p class="text-gray-700 mb-4">Turnamen mini basket antar klub</p>
            <p class="text-sm text-gray-600 mb-4">📅 2026-10-22 | 📍 GOR Basket City</p>
            <a href="#" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Lihat Detail</a>
        </div>
    `;
</script>
@endsection
