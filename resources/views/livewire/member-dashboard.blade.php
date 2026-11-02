<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-800 dark:text-slate-200">Dashboard Anggota</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Selamat datang, {{ $anggota->nama }}! 👋</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $statusAnggota === 'aktif' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-400' }}">
                {{ ucfirst($statusAnggota) }}
            </span>
        </div>
    </div>

    <!-- Alert Notifications -->
    @if (session('error'))
        <div class="bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-100 dark:bg-green-900/30 border border-green-400 dark:border-green-800 text-green-700 dark:text-green-400 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Status Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Terdaftar Minggu Ini -->
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Terdaftar Minggu Ini</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $terdaftarCount }}/{{ $totalJadwal }}</p>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Jadwal latihan</p>
                </div>
                <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-orange-100 dark:bg-orange-900/30">
                    <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/></svg>
                </div>
            </div>
        </div>

        <!-- Tingkat Kehadiran -->
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Tingkat Kehadiran</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $persentaseKehadiran }}%</p>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Dari total kegiatan</p>
                </div>
                <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/30">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                </div>
            </div>
        </div>

        <!-- Cicilan Kas -->
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Cicilan Kas Bulan Ini</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $cicilanKas }}/{{ $totalCicilan }}</p>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Sudah dibayar</p>
                </div>
                <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-purple-100 dark:bg-purple-900/30">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"/></svg>
                </div>
            </div>
        </div>

        <!-- Status Anggota -->
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">NIS</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $anggota->nis ?? '-' }}</p>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ $anggota->kelas ?? '-' }}</p>
                </div>
                <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/30">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Jadwal Minggu Ini -->
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">📅 Jadwal Minggu Ini</h2>
            <span class="text-sm text-gray-600 dark:text-gray-400">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM YYYY') }}</span>
        </div>

        @if (count($jadwalMingguIni) > 0)
            <div class="space-y-4">
                @foreach ($jadwalMingguIni as $item)
                    @php
                        $jadwal = $item['jadwal'];
                        $kegiatan = $item['kegiatan'];
                        $sudahDaftar = $item['sudah_daftar'];
                        $dibatalkan = $item['dibatalkan'];
                        $kuotaPenuh = $item['kuota_penuh'];
                        $bisaDaftar = $item['bisa_daftar'];
                    @endphp

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg {{ $dibatalkan ? 'bg-gray-50 dark:bg-gray-900/50 opacity-60' : 'hover:shadow-md transition-shadow' }}">
                        <!-- Info Jadwal -->
                        <div class="flex-1">
                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $kegiatan->judul }}
                                        @if ($dibatalkan)
                                            <span class="ml-2 text-sm text-red-600 dark:text-red-400">(Dibatalkan)</span>
                                        @endif
                                    </h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                        <span class="font-medium">{{ ucfirst($jadwal->hari) }}</span>, 
                                        {{ \Carbon\Carbon::parse($kegiatan->tanggal)->locale('id')->isoFormat('D MMMM YYYY') }}
                                        • {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                                    </p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                        📍 {{ $jadwal->lokasi }} 
                                        <span class="ml-2 px-2 py-0.5 rounded text-xs {{ $jadwal->tipe_lokasi === 'indoor' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' }}">
                                            {{ ucfirst($jadwal->tipe_lokasi) }}
                                        </span>
                                    </p>
                                    @if ($kegiatan->kuota)
                                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                            Kuota: {{ $kegiatan->pendaftaranKegiatan()->where('status', 'terdaftar')->count() }}/{{ $kegiatan->kuota }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-4 md:mt-0 md:ml-4 flex-shrink-0">
                            @if ($dibatalkan)
                                <button disabled class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-500 dark:text-gray-500 rounded-lg cursor-not-allowed text-sm font-medium">
                                    Dibatalkan
                                </button>
                            @elseif ($sudahDaftar)
                                <div class="flex items-center gap-2">
                                    <span class="px-4 py-2 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400 rounded-lg text-sm font-medium flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                        Sudah Daftar
                                    </span>
                                    <button 
                                        wire:click="batalkanPendaftaran({{ $kegiatan->id }})"
                                        wire:confirm="Yakin ingin membatalkan pendaftaran?"
                                        class="px-3 py-2 bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-400 rounded-lg text-sm font-medium hover:bg-red-200 dark:hover:bg-red-900/50 transition-colors"
                                    >
                                        Batal
                                    </button>
                                </div>
                            @elseif (!$bisaDaftar && $kuotaPenuh)
                                <button disabled class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-500 dark:text-gray-500 rounded-lg cursor-not-allowed text-sm font-medium">
                                    Kuota Penuh
                                </button>
                            @elseif (!$bisaDaftar && $statusAnggota !== 'aktif')
                                <button disabled class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-500 dark:text-gray-500 rounded-lg cursor-not-allowed text-sm font-medium">
                                    Status Tidak Aktif
                                </button>
                            @elseif ($bisaDaftar)
                                <button 
                                    wire:click="daftarKegiatan({{ $kegiatan->id }})"
                                    class="px-4 py-2 bg-orange-600 hover:bg-orange-700 dark:bg-orange-700 dark:hover:bg-orange-600 text-white rounded-lg text-sm font-medium transition-colors"
                                >
                                    Daftar Sekarang
                                </button>
                            @else
                                <button disabled class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-500 dark:text-gray-500 rounded-lg cursor-not-allowed text-sm font-medium">
                                    Tidak Tersedia
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto w-16 h-16 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="mt-4 text-gray-600 dark:text-gray-400">Belum ada jadwal latihan minggu ini.</p>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-500">Silakan hubungi admin untuk informasi lebih lanjut.</p>
            </div>
        @endif
    </div>

    <!-- Quick Links -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('member.kegiatan-saya') }}" class="block p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg hover:shadow-lg transition-shadow">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/></svg>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900 dark:text-white">Kegiatan Saya</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Lihat semua kegiatan</p>
                </div>
            </div>
        </a>

        <a href="{{ route('member.profile') }}" class="block p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg hover:shadow-lg transition-shadow">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900 dark:text-white">Profil Saya</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Lihat & edit profil</p>
                </div>
            </div>
        </a>

        <a href="{{ route('member.settings') }}" class="block p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg hover:shadow-lg transition-shadow">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                    <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/></svg>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900 dark:text-white">Pengaturan</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Ubah password</p>
                </div>
            </div>
        </a>
    </div>
</div>

<script>
// Livewire event listeners untuk notifikasi
window.addEventListener('success', event => {
    alert(event.detail || 'Berhasil!');
    window.location.reload();
});

window.addEventListener('error', event => {
    alert(event.detail || 'Terjadi kesalahan!');
});
</script>
