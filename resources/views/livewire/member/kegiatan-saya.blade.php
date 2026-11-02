<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-800 dark:text-white">Kegiatan Saya</h1>
            <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Daftar kegiatan yang pernah Anda ikuti</p>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="flex gap-2 border-b border-slate-200 dark:border-slate-700">
        <button 
            wire:click="$set('filter', 'all')" 
            class="px-4 py-2.5 font-medium text-sm border-b-2 transition-colors {{ $filter === 'all' ? 'text-orange-600 dark:text-orange-400 border-orange-600' : 'text-slate-600 dark:text-slate-400 border-transparent hover:text-slate-900 dark:hover:text-slate-200' }}"
        >
            Semua ({{ $kegiatanSaya->total() }})
        </button>
        <button 
            wire:click="$set('filter', 'upcoming')" 
            class="px-4 py-2.5 font-medium text-sm border-b-2 transition-colors {{ $filter === 'upcoming' ? 'text-orange-600 dark:text-orange-400 border-orange-600' : 'text-slate-600 dark:text-slate-400 border-transparent hover:text-slate-900 dark:hover:text-slate-200' }}"
        >
            Akan Datang
        </button>
        <button 
            wire:click="$set('filter', 'past')" 
            class="px-4 py-2.5 font-medium text-sm border-b-2 transition-colors {{ $filter === 'past' ? 'text-orange-600 dark:text-orange-400 border-orange-600' : 'text-slate-600 dark:text-slate-400 border-transparent hover:text-slate-900 dark:hover:text-slate-200' }}"
        >
            Sudah Lewat
        </button>
    </div>

    <!-- Empty State -->
    @if($kegiatanSaya->isEmpty())
        <div class="rounded-lg border-2 border-dashed border-slate-300 dark:border-slate-600 p-12 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 dark:bg-slate-800 mb-4">
                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-2">Belum ada kegiatan</h3>
            <p class="text-slate-600 dark:text-slate-400 text-sm">Anda belum mendaftar kegiatan apapun. Cek Dashboard untuk mendaftar kegiatan.</p>
        </div>
    @else
        <!-- Kegiatan List -->
        <div class="space-y-4">
            @foreach($kegiatanSaya as $pendaftaran)
                <div class="rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-4 sm:p-6 hover:shadow-md transition-shadow">
                    <!-- Row 1: Judul + Status -->
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between mb-3">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">
                                {{ $pendaftaran->kegiatan->judul }}
                            </h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">
                                {{ $pendaftaran->kegiatan->deskripsi ? Str::limit($pendaftaran->kegiatan->deskripsi, 60) : 'Tidak ada deskripsi' }}
                            </p>
                        </div>
                        <div class="mt-3 sm:mt-0">
                            @php
                                $badgeInfo = $this->getStatusBadge($pendaftaran);
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                {{ $badgeInfo['color'] === 'green' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : '' }}
                                {{ $badgeInfo['color'] === 'yellow' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300' : '' }}
                                {{ $badgeInfo['color'] === 'blue' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' : '' }}
                                {{ $badgeInfo['color'] === 'red' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300' : '' }}
                                {{ $badgeInfo['color'] === 'gray' ? 'bg-slate-100 text-slate-800 dark:bg-slate-700 dark:text-slate-300' : '' }}
                            ">
                                {{ $badgeInfo['label'] }}
                            </span>
                        </div>
                    </div>

                    <!-- Row 2: Info -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-4 text-sm">
                        <div>
                            <span class="text-slate-600 dark:text-slate-400">Tanggal</span>
                            <p class="font-medium text-slate-900 dark:text-white">
                                {{ $pendaftaran->kegiatan->tanggal->format('d M Y') }}
                            </p>
                        </div>
                        <div>
                            <span class="text-slate-600 dark:text-slate-400">Jam</span>
                            <p class="font-medium text-slate-900 dark:text-white">
                                @if($pendaftaran->kegiatan->jadwalLatihan)
                                    {{ $pendaftaran->kegiatan->jadwalLatihan->jam_mulai }} - {{ $pendaftaran->kegiatan->jadwalLatihan->jam_selesai }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                        <div>
                            <span class="text-slate-600 dark:text-slate-400">Lokasi</span>
                            <p class="font-medium text-slate-900 dark:text-white">{{ $pendaftaran->kegiatan->lokasi ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-slate-600 dark:text-slate-400">Kategori</span>
                            <p class="font-medium text-slate-900 dark:text-white">{{ $pendaftaran->kegiatan->kategori ?? 'Umum' }}</p>
                        </div>
                    </div>

                    <!-- Row 3: Actions (Inline Dropdown) -->
                    <div class="pt-3 border-t border-slate-200 dark:border-slate-700">
                        @if($pendaftaran->status === 'terdaftar' && $pendaftaran->kegiatan->tanggal >= now()->toDateString())
                            
                            @if($this->sudahDeklarasi($pendaftaran))
                                <div class="flex items-center justify-between gap-2">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-slate-600 dark:text-slate-400">Status:</span>
                                        <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-semibold {{ $this->getButtonColor($pendaftaran->absensi->status_kehadiran) }}">
                                            {{ ucfirst($pendaftaran->absensi->status_kehadiran) }}
                                        </span>
                                    </div>
                                    <button 
                                        wire:click="toggleInlineStatus({{ $pendaftaran->id }})"
                                        class="text-sm text-orange-600 dark:text-orange-400 hover:underline"
                                    >
                                        {{ $expandedPendaftaranId === $pendaftaran->id ? 'Tutup' : 'Ubah' }}
                                    </button>
                                </div>
                            @else
                                <button 
                                    wire:click="toggleInlineStatus({{ $pendaftaran->id }})"
                                    class="w-full flex items-center justify-center px-3 py-2 text-sm font-medium text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/20 hover:bg-green-100 dark:hover:bg-green-900/30 rounded-lg transition-colors"
                                >
                                    Deklarasi Status Kehadiran
                                </button>
                            @endif

                            {{-- Inline Dropdown --}}
                            @if($expandedPendaftaranId === $pendaftaran->id)
                                <div class="mt-4 p-4 bg-slate-50 dark:bg-slate-900 rounded-lg border border-slate-200 dark:border-slate-700 space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Status Kehadiran</label>
                                        <select wire:model.live="statusDeklarasi" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-orange-500">
                                            <option value="hadir">Hadir</option>
                                            <option value="sakit">Sakit</option>
                                            <option value="izin">Izin</option>
                                        </select>
                                    </div>
                                    @if($statusDeklarasi !== 'hadir')
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Alasan</label>
                                            <textarea wire:model="alasanDeklarasi" rows="2" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white" placeholder="Sebutkan alasan..."></textarea>
                                        </div>
                                    @endif
                                    <button wire:click="submitStatusKehadiran" class="w-full px-4 py-2 text-sm font-medium text-white bg-orange-600 hover:bg-orange-700 rounded-lg transition-colors">
                                        Simpan Status
                                    </button>
                                </div>
                            @endif
                        
                        @else
                            <span class="text-sm text-slate-500 dark:text-slate-400">
                                @if($pendaftaran->kegiatan->tanggal < now()->toDateString())
                                    Kegiatan sudah berlangsung
                                @else
                                    Tidak bisa diubah
                                @endif
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $kegiatanSaya->links(data: ['scrollTo' => false]) }}
        </div>
    @endif

    <!-- Flash Messages -->
    @if(session()->has('success'))
        <script>
            Livewire.dispatch('showNotification', { message: '{{ session('success') }}', type: 'success' });
        </script>
    @endif
    @if(session()->has('error'))
        <script>
            Livewire.dispatch('showNotification', { message: '{{ session('error') }}', type: 'error' });
        </script>
    @endif
</div>
