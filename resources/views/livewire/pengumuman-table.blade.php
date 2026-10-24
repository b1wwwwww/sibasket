<div class="p-6">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Pengumuman</h2>
            <p class="mt-1 text-sm text-gray-700 dark:text-gray-300">Kelola pengumuman untuk anggota klub</p>
        </div>
        <a href="{{ route('pengumuman.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white rounded transition-colors">
            + Buat Pengumuman
        </a>
    </div>

    <!-- Filters -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <div>
            <input 
                type="text" 
                wire:model.live="search" 
                placeholder="Cari pengumuman..."
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
            >
        </div>
        <div>
            <select 
                wire:model.live="kategori"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
            >
                <option value="">Semua Kategori</option>
                <option value="Penting">Penting</option>
                <option value="Info">Info Umum</option>
                <option value="Prestasi">Prestasi</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
        <div>
            <select 
                wire:model.live="status"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
            >
                <option value="">Semua Status</option>
                <option value="published">Published</option>
                <option value="draft">Draft</option>
            </select>
        </div>
    </div>

    <!-- Bulk Actions Bar -->
    @if(!empty($selected))
        <div class="mb-4 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg flex items-center justify-between">
            <div class="flex items-center gap-4">
                <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                    {{ count($selected) }} {{ count($selected) === 1 ? 'pengumuman' : 'pengumuman' }} dipilih
                </span>
                <div class="flex gap-2">
                    <button 
                        wire:click="bulkPublish"
                        class="px-3 py-1 text-sm bg-green-600 text-white rounded hover:bg-green-700 transition-colors"
                    >
                        Publikasikan
                    </button>
                    <button 
                        wire:click="bulkUnpublish"
                        class="px-3 py-1 text-sm bg-yellow-600 text-white rounded hover:bg-yellow-700 transition-colors"
                    >
                        Unpublish
                    </button>
                    <button 
                        wire:click="bulkDelete"
                        wire:confirm="Hapus {{ count($selected) }} pengumuman?"
                        class="px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700 transition-colors"
                    >
                        Hapus
                    </button>
                </div>
            </div>
            <button 
                wire:click="$set('selected', []); $set('selectAll', false)"
                class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300"
            >
                ✕
            </button>
        </div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-sm transition-colors">
        <table class="w-full border-collapse text-gray-900 dark:text-gray-100">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="border border-gray-200 dark:border-gray-600 p-3 text-center w-10">
                        <input 
                            type="checkbox"
                            wire:model.live="selectAll"
                            class="w-4 h-4 border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500"
                        >
                    </th>
                    <th class="border border-gray-200 dark:border-gray-600 p-3 text-left text-sm font-semibold">Foto</th>
                    <th class="border border-gray-200 dark:border-gray-600 p-3 text-left text-sm font-semibold">Judul</th>
                    <th class="border border-gray-200 dark:border-gray-600 p-3 text-left text-sm font-semibold">Isi Preview</th>
                    <th class="border border-gray-200 dark:border-gray-600 p-3 text-left text-sm font-semibold">Kategori</th>
                    <th class="border border-gray-200 dark:border-gray-600 p-3 text-left text-sm font-semibold text-center">Status</th>
                    <th class="border border-gray-200 dark:border-gray-600 p-3 text-left text-sm font-semibold">Tgl Publish</th>
                    <th class="border border-gray-200 dark:border-gray-600 p-3 text-center w-40 text-sm font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                @forelse($pengumuman as $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/60 transition-colors {{ $item->is_pinned ? 'bg-blue-50/50 dark:bg-blue-900/20' : '' }} {{ in_array($item->id, $selected) ? 'bg-blue-100 dark:bg-blue-900/40' : '' }}">
                        <td class="border border-gray-200 dark:border-gray-600 p-3 text-center">
                            <input 
                                type="checkbox"
                                wire:model.live="selected"
                                value="{{ $item->id }}"
                                class="w-4 h-4 border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500"
                            >
                        </td>
                        <td class="border border-gray-200 dark:border-gray-600 p-2 text-center">
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto" class="h-10 w-10 object-cover rounded shadow-sm">
                            @else
                                <div class="h-10 w-10 bg-gray-200 dark:bg-gray-600 rounded flex items-center justify-center text-gray-400 dark:text-gray-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                        </td>
                        <td class="border border-gray-200 dark:border-gray-600 p-3">
                            <div class="flex items-center gap-2">
                                @if($item->is_pinned)
                                    <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v8l2 2v2h-5v3l-1 1-1-1v-3H5v-2l2-2V4z"></path>
                                    </svg>
                                @endif
                                @if($item->scheduled_at)
                                    <svg class="w-4 h-4 text-orange-600 dark:text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2h16V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                                <span class="font-medium">{{ $item->judul }}</span>
                            </div>
                        </td>
                        <td class="border border-gray-200 dark:border-gray-600 p-3 text-sm text-gray-600 dark:text-gray-400">
                            <div class="line-clamp-2">
                                {{ Str::limit(strip_tags($item->isi), 80) }}
                            </div>
                        </td>
                        <td class="border border-gray-200 dark:border-gray-600 p-3">
                            @if($item->kategori)
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ 
                                    $item->kategori == 'Penting' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' : 
                                    ($item->kategori == 'Prestasi' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' : 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400')
                                }}">
                                    {{ $item->kategori }}
                                </span>
                            @else
                                <span class="text-gray-400 text-xs">-</span>
                            @endif
                        </td>
                        <td class="border border-gray-200 dark:border-gray-600 p-3 text-center">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ 
                                $item->status == 'published' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300'
                            }}">
                                {{ ucfirst($item->status) }}
                            </span>
                            @if($item->scheduled_at)
                                <p class="text-xs text-orange-600 dark:text-orange-400 mt-1">
                                    Terjadwal: {{ $item->scheduled_at->format('d/m H:i') }}
                                </p>
                            @endif
                        </td>
                        <td class="border border-gray-200 dark:border-gray-600 p-3 text-sm">
                            {{ $item->tanggal_publish->format('d/m/Y H:i') }}
                        </td>
                        <td class="border border-gray-200 dark:border-gray-600 p-3 text-center space-x-1">
                            <button 
                                wire:click="togglePin({{ $item->id }})"
                                title="{{ $item->is_pinned ? 'Unpin' : 'Pin to top' }}"
                                class="p-1 {{ $item->is_pinned ? 'text-blue-600 dark:text-blue-400' : 'text-gray-400 dark:text-gray-500' }} hover:bg-gray-100 dark:hover:bg-gray-700 rounded transition-colors"
                            >
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v8l2 2v2h-5v3l-1 1-1-1v-3H5v-2l2-2V4z"></path>
                                </svg>
                            </button>
                            <a 
                                href="{{ route('pengumuman.edit', $item->id) }}"
                                class="p-1 text-blue-600 dark:text-blue-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded inline-block transition-colors"
                                title="Edit"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <button 
                                wire:click="delete({{ $item->id }})"
                                wire:confirm="Hapus pengumuman ini?"
                                class="p-1 text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded transition-colors"
                                title="Hapus"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="border border-gray-200 dark:border-gray-600 p-8 text-center text-gray-500 dark:text-gray-400">
                            Tidak ada pengumuman
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $pengumuman->links() }}
    </div>
</div>
