<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiBasket - Sistem Manajemen Klub Basket</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="font-bold text-2xl text-blue-600">SiBasket</div>
                <div class="flex gap-4">
                    <a href="/" class="text-gray-700 hover:text-blue-600">Beranda</a>
                    <a href="/kegiatan-publik" class="text-gray-700 hover:text-blue-600">Kegiatan</a>
                    <a href="/pengumuman-publik" class="text-gray-700 hover:text-blue-600">Pengumuman</a>
                    @auth
                        <a href="/dashboard" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Dashboard</a>
                    @else
                        <a href="/login" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl font-bold mb-4">Sistem Manajemen Klub Basket</h1>
            <p class="text-xl mb-8 opacity-90">Platform terintegrasi untuk mengelola anggota, kegiatan, keuangan, dan absensi klub basket Anda</p>
            <div class="flex gap-4 justify-center">
                @auth
                    <a href="/dashboard" class="px-6 py-3 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100">Ke Dashboard</a>
                @else
                    <a href="/login" class="px-6 py-3 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100">Login Sekarang</a>
                    <a href="/kegiatan-publik" class="px-6 py-3 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-blue-600">Lihat Kegiatan</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-12 text-center">Fitur Utama</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Fitur 1 -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                <div class="text-blue-600 text-4xl mb-4">👥</div>
                <h3 class="text-xl font-semibold mb-2">Manajemen Anggota</h3>
                <p class="text-gray-600">Kelola data anggota, profil, dan kontak dengan mudah</p>
            </div>

            <!-- Fitur 2 -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                <div class="text-blue-600 text-4xl mb-4">🏀</div>
                <h3 class="text-xl font-semibold mb-2">Kegiatan & Pendaftaran</h3>
                <p class="text-gray-600">Buat dan kelola kegiatan, latihan, dan turnamen</p>
            </div>

            <!-- Fitur 3 -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                <div class="text-blue-600 text-4xl mb-4">📊</div>
                <h3 class="text-xl font-semibold mb-2">Manajemen Keuangan</h3>
                <p class="text-gray-600">Catat pemasukan, pengeluaran, dan laporan keuangan</p>
            </div>

            <!-- Fitur 4 -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                <div class="text-blue-600 text-4xl mb-4">✅</div>
                <h3 class="text-xl font-semibold mb-2">Rekap Absensi</h3>
                <p class="text-gray-600">Catat kehadiran dan analisis tingkat kehadiran</p>
            </div>

            <!-- Fitur 5 -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                <div class="text-blue-600 text-4xl mb-4">📢</div>
                <h3 class="text-xl font-semibold mb-2">Pengumuman</h3>
                <p class="text-gray-600">Bagikan berita dan informasi penting kepada anggota</p>
            </div>

            <!-- Fitur 6 -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                <div class="text-blue-600 text-4xl mb-4">🔒</div>
                <h3 class="text-xl font-semibold mb-2">Kontrol Akses</h3>
                <p class="text-gray-600">Kelola peran dan izin pengguna dengan sistem yang aman</p>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-blue-600 text-white py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Siap Mulai?</h2>
            <p class="text-lg mb-8 opacity-90">Bergabunglah dengan kami dan kelola klub basket Anda dengan lebih efisien</p>
            @auth
                <a href="/dashboard" class="px-8 py-3 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 inline-block">Buka Dashboard</a>
            @else
                <a href="/login" class="px-8 py-3 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 inline-block">Login / Daftar</a>
            @endauth
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; 2026 SiBasket. Sistem Manajemen Klub Basket Indonesia.</p>
        </div>
    </footer>
</body>
</html>
