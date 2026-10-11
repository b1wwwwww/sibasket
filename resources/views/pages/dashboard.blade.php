@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold mb-8">
        @if($dashboard_type === 'admin')
            Dashboard Admin
        @elseif($dashboard_type === 'pembina')
            Dashboard Pembina
        @else
            Dashboard Saya
        @endif
    </h1>

    <!-- Metrics Cards Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Total Anggota -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-gray-600 font-semibold mb-2">Total Anggota</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $metrics['total_anggota'] }}</p>
        </div>

        <!-- Kegiatan Aktif -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-gray-600 font-semibold mb-2">Kegiatan Aktif</h3>
            <p class="text-3xl font-bold text-green-600">{{ $metrics['kegiatan_aktif'] }}</p>
        </div>

        <!-- Tingkat Kehadiran -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-gray-600 font-semibold mb-2">Tingkat Kehadiran</h3>
            <p class="text-3xl font-bold text-purple-600">{{ $metrics['tingkat_kehadiran'] }}%</p>
        </div>

        <!-- Saldo Kas -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-gray-600 font-semibold mb-2">Saldo Kas</h3>
            <p class="text-3xl font-bold text-orange-600">Rp {{ number_format($metrics['saldo_kas'], 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Admin Section -->
    @if($dashboard_type === 'admin')
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Kegiatan Terbaru -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-bold mb-4">Kegiatan Terbaru</h2>
                @if($metrics['kegiatan_list']->count() > 0)
                    <div class="space-y-3">
                        @foreach($metrics['kegiatan_list'] as $kegiatan)
                            <div class="border-l-4 border-blue-500 pl-4 py-2">
                                <h4 class="font-semibold">{{ $kegiatan->judul }}</h4>
                                <p class="text-sm text-gray-600">{{ $kegiatan->tanggal->format('d-m-Y H:i') }}</p>
                                <span class="inline-block text-xs px-2 py-1 bg-green-100 text-green-800 rounded mt-2">
                                    {{ $kegiatan->status }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">Belum ada kegiatan</p>
                @endif
            </div>

            <!-- Pendaftaran Terbaru -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-bold mb-4">Pendaftaran Terbaru</h2>
                @if($metrics['pendaftaran_terbaru']->count() > 0)
                    <div class="space-y-3 max-h-64 overflow-y-auto">
                        @foreach($metrics['pendaftaran_terbaru'] as $pendaftaran)
                            <div class="border-l-4 border-green-500 pl-4 py-2">
                                <p class="font-semibold text-sm">{{ $pendaftaran->anggota->nama }}</p>
                                <p class="text-xs text-gray-600">{{ $pendaftaran->kegiatan->judul }}</p>
                                <span class="inline-block text-xs px-2 py-1 bg-yellow-100 text-yellow-800 rounded mt-1">
                                    {{ $pendaftaran->status }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">Belum ada pendaftaran</p>
                @endif
            </div>
        </div>
    @endif

    <!-- Member Section -->
    @if($dashboard_type === 'member')
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Kegiatan Saya -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-bold mb-4">Kegiatan Saya</h2>
                @if($metrics['my_kegiatan']->count() > 0)
                    <div class="space-y-3">
                        @foreach($metrics['my_kegiatan'] as $item)
                            <div class="border-l-4 border-blue-500 pl-4 py-2">
                                <h4 class="font-semibold">{{ $item->kegiatan->judul }}</h4>
                                <p class="text-sm text-gray-600">{{ $item->kegiatan->tanggal->format('d-m-Y H:i') }}</p>
                                <span class="inline-block text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded mt-2">
                                    {{ $item->status }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">Anda belum mendaftar kegiatan apapun</p>
                @endif
            </div>

            <!-- Statistik Kehadiran -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-bold mb-4">Statistik Kehadiran</h2>
                <div class="space-y-4">
                    <div>
                        <p class="text-gray-600 mb-2">Total Kehadiran: <span class="font-bold text-lg">{{ $metrics['my_absensi_count'] }}</span></p>
                    </div>
                    <a href="{{ route('riwayat-absensi.index') }}" class="inline-block text-blue-600 hover:underline">
                        Lihat Riwayat Lengkap →
                    </a>
                </div>
            </div>
        </div>
    @endif

    <!-- Pengumuman Terbaru (Untuk semua) -->
    <div class="bg-white p-6 rounded-lg shadow mt-8">
        <h2 class="text-xl font-bold mb-4">Pengumuman Terbaru</h2>
        @if($metrics['pengumuman_terbaru']->count() > 0)
            <div class="space-y-4">
                @foreach($metrics['pengumuman_terbaru'] as $pengumuman)
                    <div class="border-b pb-4 last:border-b-0">
                        <h3 class="font-semibold text-lg">{{ $pengumuman->judul }}</h3>
                        <p class="text-gray-600 text-sm mt-1">{{ $pengumuman->tanggal_publish->format('d-m-Y') }}</p>
                        <p class="text-gray-700 mt-2 line-clamp-2">{{ Str::limit($pengumuman->isi, 150) }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">Belum ada pengumuman</p>
        @endif
    </div>
</div>
@endsection
