<div class="space-y-6" wire:poll.30s="$refresh">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-800 dark:text-white">Riwayat Pembayaran</h1>
            <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Riwayat pembayaran iuran kas Anda</p>
        </div>
    </div>

    <!-- Alert: Ada Tagihan Belum Lunas -->
    @if($tagihanBelumLunas > 0)
        <div class="rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-900/50 p-4 flex items-start gap-4">
            <div class="flex-shrink-0">
                <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </div>
            <div>
                <h3 class="font-semibold text-red-800 dark:text-red-300">Perhatian!</h3>
                <p class="text-red-700 dark:text-red-400 text-sm mt-1">
                    Anda memiliki <strong>{{ $tagihanBelumLunas }} pembayaran belum lunas</strong>. 
                    Silakan hubungi bendahara untuk melakukan pembayaran.
                </p>
            </div>
        </div>
    @endif

    <!-- Ringkasan Keuangan -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-4">
            <div class="text-sm text-slate-600 dark:text-slate-400 font-medium">Total Tagihan</div>
            <div class="text-2xl font-bold text-slate-900 dark:text-white mt-2">{{ $ringkasan['total_tagihan'] }}</div>
        </div>
        <div class="rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-900/50 p-4">
            <div class="text-sm text-green-600 dark:text-green-400 font-medium">Lunas</div>
            <div class="text-2xl font-bold text-green-700 dark:text-green-300 mt-2">{{ $ringkasan['total_lunas'] }}</div>
        </div>
        <div class="rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-900/50 p-4">
            <div class="text-sm text-red-600 dark:text-red-400 font-medium">Belum Lunas</div>
            <div class="text-2xl font-bold text-red-700 dark:text-red-300 mt-2">{{ $ringkasan['total_belum_lunas'] }}</div>
        </div>
        <div class="rounded-lg bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-900/50 p-4">
            <div class="text-sm text-blue-600 dark:text-blue-400 font-medium">Persentase Lunas</div>
            <div class="text-2xl font-bold text-blue-700 dark:text-blue-300 mt-2">{{ $ringkasan['persentase_lunas'] }}%</div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="flex gap-2 border-b border-slate-200 dark:border-slate-700">
        <button 
            wire:click="$set('filter', 'all')" 
            class="px-4 py-2.5 font-medium text-sm border-b-2 transition-colors {{ $filter === 'all' ? 'text-orange-600 dark:text-orange-400 border-orange-600' : 'text-slate-600 dark:text-slate-400 border-transparent hover:text-slate-900 dark:hover:text-slate-200' }}"
        >
            Semua
        </button>
        <button 
            wire:click="$set('filter', 'lunas')" 
            class="px-4 py-2.5 font-medium text-sm border-b-2 transition-colors {{ $filter === 'lunas' ? 'text-orange-600 dark:text-orange-400 border-orange-600' : 'text-slate-600 dark:text-slate-400 border-transparent hover:text-slate-900 dark:hover:text-slate-200' }}"
        >
            Lunas
        </button>
        <button 
            wire:click="$set('filter', 'belum_lunas')" 
            class="px-4 py-2.5 font-medium text-sm border-b-2 transition-colors {{ $filter === 'belum_lunas' ? 'text-orange-600 dark:text-orange-400 border-orange-600' : 'text-slate-600 dark:text-slate-400 border-transparent hover:text-slate-900 dark:hover:text-slate-200' }}"
        >
            Belum Lunas
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
    @if($pembayaran->isEmpty())
        <div class="rounded-lg border-2 border-dashed border-slate-300 dark:border-slate-600 p-12 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 dark:bg-slate-800 mb-4">
                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-2">Belum ada riwayat pembayaran</h3>
            <p class="text-slate-600 dark:text-slate-400 text-sm">Riwayat pembayaran akan muncul di sini setelah Anda mendaftar kegiatan dan ada iuran kas.</p>
        </div>
    @else
        <!-- Responsive Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-100 dark:bg-slate-700/50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Kegiatan</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Nominal</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Tanggal Bayar</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @foreach($pembayaran as $row)
                        @php
                            $badgeInfo = $this->getStatusBadge($row->status_bayar);
                        @endphp
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                            <td class="px-4 py-4">
                                <div class="text-sm font-medium text-slate-900 dark:text-white">
                                    {{ $row->kasKegiatan->kegiatan->judul ?? 'Kegiatan tidak ditemukan' }}
                                </div>
                                <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                                    {{ $row->kasKegiatan->kegiatan->tanggal->format('d M Y') ?? '-' }}
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="text-sm font-semibold text-slate-900 dark:text-white">
                                    Rp {{ number_format($row->kasKegiatan->nominal_kas ?? 0, 0, ',', '.') }}
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $badgeInfo['color'] }}">
                                    {{ $badgeInfo['icon'] }} {{ $badgeInfo['label'] }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-sm text-slate-600 dark:text-slate-400">
                                @if($row->status_bayar === 'lunas' && $row->tanggal_bayar)
                                    {{ $row->tanggal_bayar->format('d M Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-4 py-4 text-sm text-slate-600 dark:text-slate-400">
                                {{ $row->keterangan ?? '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $pembayaran->links(data: ['scrollTo' => false]) }}
        </div>
    @endif

    <!-- Polling Indicator -->
    <div class="text-xs text-slate-500 dark:text-slate-400 text-center pt-4">
        🔄 Auto-refresh setiap 30 detik
    </div>
</div>
