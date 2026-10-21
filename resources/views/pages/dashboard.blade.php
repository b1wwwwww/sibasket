@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Dashboard</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Selamat datang kembali, {{ Auth::user()->name }}! 👋</p>
        </div>
        <div class="mt-4 sm:mt-0 text-sm text-gray-600 dark:text-gray-400 flex items-center gap-2">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm0-2a6 6 0 100-12 6 6 0 000 12zm0-1a1 1 0 100-2 1 1 0 000 2z"/></svg>
            Last updated: <span id="last-updated">sekarang</span>
        </div>
    </div>

    <!-- 4 Metric Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Anggota -->
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Anggota</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $metrics['total_anggota'] ?? 245 }}</p>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">+12% vs bulan lalu</p>
                </div>
                <div class="flex items-center gap-2">
                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-orange-100 dark:bg-orange-900/30">
                        <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10.5 1.5H5.75A2.75 2.75 0 003 4.25v11.5A2.75 2.75 0 005.75 18.5h8.5a2.75 2.75 0 002.75-2.75V6.5m-11-4v3m6-3v3m-8 2h12"/></svg>
                    </div>
                    <span class="text-sm font-semibold text-green-600 dark:text-green-400">▲ +12%</span>
                </div>
            </div>
        </div>

        <!-- Kegiatan Aktif -->
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Kegiatan Aktif</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $metrics['kegiatan_aktif'] ?? 12 }}</p>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">+2% vs minggu lalu</p>
                </div>
                <div class="flex items-center gap-2">
                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/30">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20"><path d="M6 6a2 2 0 11-4 0 2 2 0 014 0zM12 6a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 11-4 0 2 2 0 014 0zM5.15 8.15a2 2 0 11-2.83 2.83 2 2 0 012.83-2.83zM14.85 8.15a2 2 0 11-2.83 2.83 2 2 0 012.83-2.83zM10 14a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <span class="text-sm font-semibold text-green-600 dark:text-green-400">▲ +2%</span>
                </div>
            </div>
        </div>

        <!-- Tingkat Kehadiran -->
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Tingkat Kehadiran</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $metrics['tingkat_kehadiran'] ?? 87 }}%</p>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">+5% vs bulan lalu</p>
                </div>
                <div class="flex items-center gap-2">
                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/30">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 1 1 0 000 2h8a1 1 0 000-2 2 2 0 00-2 2v10a2 2 0 002 2 1 1 0 100 2h-2a1 1 0 100 2h2a4 4 0 004-4V5a4 4 0 00-4-4H8a4 4 0 00-4 4v10a2 2 0 002 2 1 1 0 100-2 1 1 0 00-1-1V5z"/></svg>
                    </div>
                    <span class="text-sm font-semibold text-green-600 dark:text-green-400">▲ +5%</span>
                </div>
            </div>
        </div>

        <!-- Saldo Kas -->
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Saldo Kas</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($metrics['saldo_kas'] ?? 5200000, 0, ',', '.') }}</p>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">+18% vs bulan lalu</p>
                </div>
                <div class="flex items-center gap-2">
                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-purple-100 dark:bg-purple-900/30">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20"><path d="M8.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753 1 4.5 4.5 0 1-3.764 2.684A4.048 4.048 0 018.5 13z"/></svg>
                    </div>
                    <span class="text-sm font-semibold text-green-600 dark:text-green-400">▲ +18%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Grid: Recent Activity + Quick Stats + Top Members -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Activity (2 columns) -->
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Aktivitas Terbaru</h2>
                <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300">Lihat semua ▶</a>
            </div>
            
            <div class="space-y-4">
                <!-- Activity Item 1 -->
                <div class="flex gap-4 pb-4 border-b border-gray-200 dark:border-gray-700 last:border-b-0">
                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center">
                        <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Nabil mendaftar ke kegiatan</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Latihan Rutin Basket</p>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 flex-shrink-0">2 jam lalu</p>
                </div>

                <!-- Activity Item 2 -->
                <div class="flex gap-4 pb-4 border-b border-gray-200 dark:border-gray-700 last:border-b-0">
                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20"><path d="M2 10.5a1.5 1.5 0 113 0v-1a1.5 1.5 0 01-3 0v1zm14-1a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM2 13.5a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM14 13a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Admin membuat pengumuman baru</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Event Turnamen Basketball</p>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 flex-shrink-0">5 jam lalu</p>
                </div>

                <!-- Activity Item 3 -->
                <div class="flex gap-4 pb-4 border-b border-gray-200 dark:border-gray-700 last:border-b-0">
                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Transaksi kas baru tercatat</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Pemasukan Rp 500.000 (Iuran)</p>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 flex-shrink-0">1 hari lalu</p>
                </div>

                <!-- Activity Item 4 -->
                <div class="flex gap-4 pb-4 border-b border-gray-200 dark:border-gray-700 last:border-b-0">
                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753 1A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Pembina mengupdate kegiatan</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Friendly Match - Tgl 20 Okt</p>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 flex-shrink-0">2 hari lalu</p>
                </div>

                <!-- Activity Item 5 -->
                <div class="flex gap-4">
                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H7a1 1 0 01-1-1v-6z"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">System: Backup database selesai</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Backup otomatis berhasil dilakukan</p>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 flex-shrink-0">3 hari lalu</p>
                </div>
            </div>
        </div>

        <!-- Right Column: Quick Stats + Top Members -->
        <div class="space-y-6">
            <!-- Quick Stats -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-6">Statistik Cepat</h2>
                
                <div class="space-y-6">
                    <!-- Stat 1: Tingkat Pendaftaran -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Tingkat Pendaftaran</p>
                            <p class="text-sm font-bold text-gray-900 dark:text-white">3.2%</p>
                        </div>
                        <div class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full w-[3.2%] bg-blue-500 dark:bg-blue-400 rounded-full"></div>
                        </div>
                    </div>

                    <!-- Stat 2: Absensi Hadir -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Absensi Hadir</p>
                            <p class="text-sm font-bold text-gray-900 dark:text-white">87%</p>
                        </div>
                        <div class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full w-[87%] bg-green-500 dark:bg-green-400 rounded-full"></div>
                        </div>
                    </div>

                    <!-- Stat 3: Kegiatan Aktif -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Kegiatan Aktif</p>
                            <p class="text-sm font-bold text-gray-900 dark:text-white">68%</p>
                        </div>
                        <div class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full w-[68%] bg-amber-500 dark:bg-amber-400 rounded-full"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Members -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Anggota Aktif</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Kehadiran terbaik bulan ini</p>
                
                <div class="space-y-4">
                    <!-- Member 1 -->
                    <div class="flex items-center gap-3">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-orange-600 flex items-center justify-center text-white font-bold text-sm">
                            NB
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Nabil</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Member</p>
                        </div>
                        <p class="text-sm font-bold text-green-600 dark:text-green-400">95%</p>
                    </div>

                    <!-- Member 2 -->
                    <div class="flex items-center gap-3">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold text-sm">
                            AH
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Ahmad</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Member</p>
                        </div>
                        <p class="text-sm font-bold text-green-600 dark:text-green-400">92%</p>
                    </div>

                    <!-- Member 3 -->
                    <div class="flex items-center gap-3">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-pink-600 flex items-center justify-center text-white font-bold text-sm">
                            ST
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Siti</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Member</p>
                        </div>
                        <p class="text-sm font-bold text-green-600 dark:text-green-400">88%</p>
                    </div>

                    <!-- Member 4 -->
                    <div class="flex items-center gap-3">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-purple-600 flex items-center justify-center text-white font-bold text-sm">
                            BD
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Budi</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Pembina</p>
                        </div>
                        <p class="text-sm font-bold text-green-600 dark:text-green-400">85%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Update "Last Updated" time
function updateLastUpdated() {
    const now = new Date();
    document.getElementById('last-updated').textContent = now.toLocaleTimeString('id-ID', { 
        hour: '2-digit', 
        minute: '2-digit' 
    });
}

updateLastUpdated();
setInterval(updateLastUpdated, 60000);

// Theme Toggle (stored in localStorage)
document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi theme dari localStorage atau system preference
    const theme = localStorage.getItem('theme') || 
        (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
    
    if (theme === 'dark') {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
});

// Listen untuk theme toggle dari navbar (akan ditangani di component Livewire)
window.addEventListener('themeToggled', (e) => {
    if (e.detail.theme === 'dark') {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
});
</script>
@endsection
