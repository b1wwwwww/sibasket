<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Daftar Kegiatan</h1>
            <p class="mt-1 text-sm text-gray-700 dark:text-gray-300">Kelola kegiatan klub basket</p>
        </div>
        <a href="/dashboard/kegiatan/create" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Buat Kegiatan
        </a>
    </div>

    <!-- Search & Filter -->
    <div class="bg-white dark:bg-gray-800 px-4 py-5 sm:px-6 rounded-lg shadow mb-6 border border-gray-200 dark:border-gray-700 transition-colors">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Search Input -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Cari Kegiatan</label>
                <input 
                    type="text" 
                    wire:model.live="search"
                    placeholder="Judul, deskripsi, atau lokasi..."
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm transition-colors"
                />
            </div>

            <!-- Kategori Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kategori</label>
                <select 
                    wire:model.live="kategori"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm transition-colors"
                >
                    <option value="">Semua Kategori</option>
                    <option value="latihan">Latihan</option>
                    <option value="pertandingan">Pertandingan</option>
                    <option value="seleksi">Seleksi</option>
                    <option value="gathering">Gathering</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>

            <!-- Status Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                <select 
                    wire:model.live="status"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm transition-colors"
                >
                    <option value="">Semua Status</option>
                    <option value="draft">Draft</option>
                    <option value="published">Dipublikasi</option>
                    <option value="ongoing">Sedang Berlangsung</option>
                    <option value="completed">Selesai</option>
                    <option value="cancelled">Dibatalkan</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700 transition-colors">
        <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <x-table-header label="No" />
                    <x-table-header label="Foto" />
                    <x-table-header label="Judul" />
                    <x-table-header label="Tanggal" />
                    <x-table-header label="Kategori" />
                    <x-table-header label="Status" />
                    <x-table-header label="Aksi" />
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($kegiatan as $index => $item)
                    <tr class="bg-white dark:bg-gray-900 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                            {{ ($kegiatan->currentPage() - 1) * $perPage + $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($item->foto)
                                <img src="{{ \Storage::url($item->foto) }}" alt="{{ $item->judul }}" class="h-10 w-10 object-cover rounded-md">
                            @else
                                <div class="h-10 w-10 bg-gray-300 dark:bg-gray-600 rounded-md flex items-center justify-center">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200 font-medium">
                            {{ $item->judul }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                            {{ $item->tanggal->format('d/m/Y H:i') ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($item->kategori)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                                    {{ ucfirst($item->kategori) }}
                                </span>
                            @else
                                <span class="text-gray-500 dark:text-gray-400 text-xs">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($item->status === 'published')
                                <x-badge type="success" label="Dipublikasi" />
                            @elseif($item->status === 'draft')
                                <x-badge type="warning" label="Draft" />
                            @elseif($item->status === 'ongoing')
                                <x-badge type="info" label="Berlangsung" />
                            @elseif($item->status === 'completed')
                                <x-badge type="success" label="Selesai" />
                            @else
                                <x-badge type="danger" label="Dibatalkan" />
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
                            <a href="/dashboard/kegiatan/{{ $item->id }}/edit" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 font-medium transition-colors">Edit</a>
                            <button 
                                wire:click="delete({{ $item->id }})"
                                wire:confirm="Yakin ingin menghapus kegiatan ini?"
                                class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 font-medium transition-colors"
                            >
                                Hapus
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                            <svg class="w-12 h-12 mx-auto mb-3 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                            Tidak ada data kegiatan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $kegiatan->links() }}
    </div>
</div>
