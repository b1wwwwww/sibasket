<div class="space-y-6" wire:poll.30s="$refresh">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-800 dark:text-white">Riwayat Absensi</h1>
            <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Riwayat kehadiran Anda di setiap kegiatan</p>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-5 gap-4">
        <div class="rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-4">
            <div class="text-sm text-slate-600 dark:text-slate-400 font-medium">Total Absensi</div>
            <div class="text-2xl font-bold text-slate-900 dark:text-white mt-2">{{ $statistik['total'] }}</div>
        </div>
        <div class="rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-900/50 p-4">
            <div class="text-sm text-green-600 dark:text-green-400 font-medium">Hadir</div>
            <div class="text-2xl font-bold text-green-700 dark:text-green-300 mt-2">{{ $statistik['hadir'] }}</div>
        </div>
        <div class="rounded-lg bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-900/50 p-4">
            <div class="text-sm text-yellow-600 dark:text-yellow-400 font-medium">Sakit</div>
            <div class="text-2xl font-bold text-yellow-700 dark:text-yellow-300 mt-2">{{ $statistik['sakit'] }}</div>
        </div>
        <div class="rounded-lg bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-900/50 p-4">
            <div class="text-sm text-blue-600 dark:text-blue-400 font-medium">Izin</div>
            <div class="text-2xl font-bold text-blue-700 dark:text-blue-300 mt-2">{{ $statistik['izin'] }}</div>
        </div>
        <div class="rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-900/50 p-4">
            <div class="text-sm text-red-600 dark:text-red-400 font-medium">Alpha</div>
            <div class="text-2xl font-bold text-red-700 dark:text-red-300 mt-2">{{ $statistik['alpha'] }}</div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="flex gap-2 border-b border-slate-200 dark:border-slate-700 overflow-x-auto">
        <button 
            wire:click="$set('filter', 'all')" 
            class="px-4 py-2.5 font-medium text-sm border-b-2 transition-colors whitespace-nowrap {{ $filter === 'all' ? 'text-orange-600 dark:text-orange-400 border-orange-600' : 'text-slate-600 dark:text-slate-400 border-transparent hover:text-slate-900 dark:hover:text-slate-200' }}"
        >
            Semua
        </button>
        <button 
            wire:click="$set('filter', 'hadir')" 
            class="px-4 py-2.5 font-medium text-sm border-b-2 transition-colors whitespace-nowrap {{ $filter === 'hadir' ? 'text-orange-600 dark:text-orange-400 border-orange-600' : 'text-slate-600 dark:text-slate-400 border-transparent hover:text-slate-900 dark:hover:text-slate-200' }}"
        >
            Hadir
        </button>
        <button 
            wire:click="$set('filter', 'sakit')" 
            class="px-4 py-2.5 font-medium text-sm border-b-2 transition-colors whitespace-nowrap {{ $filter === 'sakit' ? 'text-orange-600 dark:text-orange-400 border-orange-600' : 'text-slate-600 dark:text-slate-400 border-transparent hover:text-slate-900 dark:hover:text-slate-200' }}"
        >
            Sakit
        </button>
        <button 
            wire:click="$set('filter', 'izin')" 
            class="px-4 py-2.5 font-medium text-sm border-b-2 transition-colors whitespace-nowrap {{ $filter === 'izin' ? 'text-orange-600 dark:text-orange-400 border-orange-600' : 'text-slate-600 dark:text-slate-400 border-transparent hover:text-slate-900 dark:hover:text-slate-200' }}"
        >
            Izin
        </button>
        <button 
            wire:click="$set('filter', 'alpha')" 
            class="px-4 py-2.5 font-medium text-sm border-b-2 transition-colors whitespace-nowrap {{ $filter === 'alpha' ? 'text-orange-600 dark:text-orange-400 border-orange-600' : 'text-slate-600 dark:text-slate-400 border-transparent hover:text-slate-900 dark:hover:text-slate-200' }}"
        >
            Alpha
        </button>
    </div>

    <!-- Sort -->
    <div class="flex justify-end">
        <select 
            wire:model.live="sortBy"
            class="px-3 py-2 text-sm border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-white"
        >
            <option value="latest">Terbaru</option>
            <option value="oldest">Terlama</option>
        </select>
    </div>

    <!-- Empty State -->
    @if($absensi->isEmpty())
        <div class="rounded-lg border-2 border-dashed border-slate-300 dark:border-slate-600 p-12 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 dark:bg-slate-800 mb-4">
                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-2">Belum ada data absensi</h3>
            <p class="text-slate-600 dark:text-slate-400 text-sm">Absensi akan muncul di sini setelah Anda mendaftar dan menghadiri kegiatan.</p>
        </div>
    @else
        <!-- Responsive Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-100 dark:bg-slate-700/50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Kegiatan</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Tanggal</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Catatan</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Diupdate</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @foreach($absensi as $row)
                        @php
                            $badgeInfo = $this->getStatusBadge($row->status_kehadiran);
                        @endphp
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                            <td class="px-4 py-4">
                                <div class="text-sm font-medium text-slate-900 dark:text-white">
                                    {{ $row->pendaftaranKegiatan->kegiatan->judul }}
                                </div>
                                <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                                    {{ $row->pendaftaranKegiatan->kegiatan->lokasi ?? '-' }}
                                </div>
                            </td>
                            <td class="px-4 py-4 text-sm text-slate-700 dark:text-slate-300">
                                {{ $row->pendaftaranKegiatan->kegiatan->tanggal->format('d M Y') }}
                            </td>
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $badgeInfo['color'] }}">
                                    {{ $badgeInfo['icon'] }} {{ $badgeInfo['label'] }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-sm text-slate-600 dark:text-slate-400">
                                {{ $row->catatan ?? '-' }}
                            </td>
                            <td class="px-4 py-4 text-sm text-slate-500 dark:text-slate-500">
                                {{ $row->updated_at->format('d M Y H:i') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $absensi->links(data: ['scrollTo' => false]) }}
        </div>
    @endif

    <!-- Polling Indicator -->
    <div class="text-xs text-slate-500 dark:text-slate-400 text-center pt-4">
        🔄 Auto-refresh setiap 30 detik
    </div>
</div>
