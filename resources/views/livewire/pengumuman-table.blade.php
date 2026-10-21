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

    <!-- Search -->
    <div class="mb-4">
        <input 
            type="text" 
            wire:model.live="search" 
            placeholder="Cari pengumuman..."
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
        >
    </div>

    <!-- Table -->
    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-sm transition-colors">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="border border-gray-200 dark:border-gray-600 p-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Judul</th>
                    <th class="border border-gray-200 dark:border-gray-600 p-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Tanggal Publish</th>
                    <th class="border border-gray-200 dark:border-gray-600 p-2 text-center w-32 text-sm font-semibold text-gray-700 dark:text-gray-200">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                @forelse($pengumuman as $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/60 transition-colors">
                        <td class="border border-gray-200 dark:border-gray-600 p-2 text-gray-900 dark:text-gray-200">{{ $item->judul }}</td>
                        <td class="border border-gray-200 dark:border-gray-600 p-2 text-gray-900 dark:text-gray-200">{{ $item->tanggal_publish->format('d-m-Y') }}</td>
                        <td class="border border-gray-200 dark:border-gray-600 p-2 text-center space-x-2">
                            <a 
                                href="{{ route('pengumuman.edit', $item->id) }}"
                                class="text-blue-600 dark:text-blue-400 hover:underline"
                            >
                                Edit
                            </a>
                            <button 
                                wire:click="delete({{ $item->id }})"
                                wire:confirm="Hapus pengumuman ini?"
                                class="text-red-600 dark:text-red-400 hover:underline"
                            >
                                Hapus
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="border border-gray-200 dark:border-gray-600 p-4 text-center text-gray-500 dark:text-gray-400">
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
