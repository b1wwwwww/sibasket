<div class="space-y-4">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ $kegiatan ? $kegiatan->judul : 'Absensi' }}
            </h2>
            <p class="mt-1 text-sm text-gray-700 dark:text-gray-300">Catat dan kelola kehadiran anggota</p>
        </div>
        <div>
            <a href="/dashboard/absensi/export?kegiatan_id={{ $kegiatanId }}" target="_blank" class="inline-flex items-center justify-center px-4 py-2 border border-green-600 rounded-lg shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 dark:bg-green-700 dark:hover:bg-green-800 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Export Excel
            </a>
        </div>
    </div>

    <!-- Quick Actions Button -->
    <div class="bg-gradient-to-r from-orange-50 to-amber-50 dark:from-orange-900/20 dark:to-amber-900/20 rounded-lg p-4 shadow-sm border border-orange-200 dark:border-orange-700 transition-colors">
        <div class="flex flex-wrap items-center gap-3">
            <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Aksi Cepat:</span>
            <button 
                wire:click="markAllAsHadir" 
                class="inline-flex items-center px-4 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white text-sm font-medium transition-colors shadow-sm"
            >
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                ✅ Hadir Semua
            </button>
            <button 
                wire:click="resetAll" 
                class="inline-flex items-center px-4 py-2 rounded-lg bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium transition-colors shadow-sm"
            >
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                🔄 Reset
            </button>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-sm space-y-3 transition-colors border border-gray-200 dark:border-gray-700">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Search -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Cari Anggota</label>
                <input 
                    wire:model.live="search" 
                    type="text" 
                    placeholder="Nama atau NIS..." 
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-gray-900 dark:text-white dark:bg-gray-700 focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors"
                >
            </div>

            <!-- Status Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status Kehadiran</label>
                <select 
                    wire:model.live="statusKehadiran" 
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-gray-900 dark:text-white dark:bg-gray-700 focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors"
                >
                    <option value="">Semua Status</option>
                    <option value="hadir">Hadir</option>
                    <option value="izin">Izin</option>
                    <option value="sakit">Sakit</option>
                    <option value="alpa">Alpa</option>
                </select>
            </div>

            <!-- Date Filter (NEW) -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Filter Tanggal</label>
                <input 
                    wire:model.live="tanggalFilter" 
                    type="date" 
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-gray-900 dark:text-white dark:bg-gray-700 focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors"
                >
            </div>

            <!-- Kegiatan Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pilih Kegiatan</label>
                <select 
                    wire:model.live="kegiatanId" 
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-gray-900 dark:text-white dark:bg-gray-700 focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors"
                >
                    <option value="{{ $kegiatanList->firstWhere('judul', 'like', '%latihan%')?->id }}">Latihan (default)</option>
                    @foreach($kegiatanList as $k)
                        <option value="{{ $k->id }}">{{ $k->judul }} ({{ $k->tanggal->format('d M Y') }})</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Alert -->
    @if(session('message'))
        <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-lg p-4 text-green-800 dark:text-green-200 transition-colors">
            {{ session('message') }}
        </div>
    @endif

    <!-- Table -->
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700 transition-colors">
        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">NIS</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Kelas</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Jurusan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Status Kehadiran</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Catatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($pendaftarans as $p)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $p->anggota->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ $p->anggota->nis }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ $p->anggota->kelas }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ $p->anggota->jurusan ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex gap-2 items-center">
                                <!-- Hadir -->
                                <button 
                                    wire:click="updateStatusKehadiran({{ $p->id }}, 'hadir')"
                                    class="px-3 py-2 rounded-lg text-xs font-semibold transition-all duration-200 {{ $p->absensi && $p->absensi->status_kehadiran === 'hadir' ? 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-200 border-2 border-green-500 shadow-md' : 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400 border-2 border-gray-300 dark:border-gray-600 hover:border-green-400 dark:hover:border-green-600' }}"
                                >
                                    ✓ Hadir
                                </button>
                                
                                <!-- Izin -->
                                <button 
                                    wire:click="updateStatusKehadiran({{ $p->id }}, 'izin')"
                                    class="px-3 py-2 rounded-lg text-xs font-semibold transition-all duration-200 {{ $p->absensi && $p->absensi->status_kehadiran === 'izin' ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-200 border-2 border-yellow-500 shadow-md' : 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400 border-2 border-gray-300 dark:border-gray-600 hover:border-yellow-400 dark:hover:border-yellow-600' }}"
                                >
                                    ~ Izin
                                </button>
                                
                                <!-- Sakit -->
                                <button 
                                    wire:click="updateStatusKehadiran({{ $p->id }}, 'sakit')"
                                    class="px-3 py-2 rounded-lg text-xs font-semibold transition-all duration-200 {{ $p->absensi && $p->absensi->status_kehadiran === 'sakit' ? 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200 border-2 border-blue-500 shadow-md' : 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400 border-2 border-gray-300 dark:border-gray-600 hover:border-blue-400 dark:hover:border-blue-600' }}"
                                >
                                    + Sakit
                                </button>
                                
                                <!-- Alpa -->
                                <button 
                                    wire:click="updateStatusKehadiran({{ $p->id }}, 'alpa')"
                                    class="px-3 py-2 rounded-lg text-xs font-semibold transition-all duration-200 {{ $p->absensi && $p->absensi->status_kehadiran === 'alpa' ? 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-200 border-2 border-red-500 shadow-md' : 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400 border-2 border-gray-300 dark:border-gray-600 hover:border-red-400 dark:hover:border-red-600' }}"
                                >
                                    ✗ Alpa
                                </button>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <input 
                                wire:change="updateCatatan({{ $p->id }}, $event.target.value)" 
                                type="text" 
                                value="{{ $p->absensi?->catatan ?? '' }}" 
                                placeholder="Catatan..." 
                                class="w-64 border border-gray-300 dark:border-gray-600 rounded px-2 py-1 text-sm text-gray-900 dark:text-white dark:bg-gray-700 focus:ring-2 focus:ring-orange-500 transition-colors"
                            >
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($p->absensi)
                                <span class="text-gray-600 dark:text-gray-400">
                                    {{ $p->absensi->created_at->format('d M, H:i') }}
                                </span>
                            @else
                                <span class="text-gray-400 dark:text-gray-500">Belum dimark</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-600 dark:text-gray-400">
                            Tidak ada pendaftar ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
            {{ $pendaftarans->links() }}
        </div>
    </div>
</div>
