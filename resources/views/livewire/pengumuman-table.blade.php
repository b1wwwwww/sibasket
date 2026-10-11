<div class="p-6">
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold">Pengumuman</h2>
        <a href="{{ route('pengumuman.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
            + Buat Pengumuman
        </a>
    </div>

    <!-- Search -->
    <div class="mb-4">
        <input 
            type="text" 
            wire:model.live="search" 
            placeholder="Cari pengumuman..."
            class="w-full px-4 py-2 border rounded"
        >
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2 text-left">Judul</th>
                    <th class="border p-2 text-left">Tanggal Publish</th>
                    <th class="border p-2 text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengumuman as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="border p-2">{{ $item->judul }}</td>
                        <td class="border p-2">{{ $item->tanggal_publish->format('d-m-Y') }}</td>
                        <td class="border p-2 text-center space-x-2">
                            <a 
                                href="{{ route('pengumuman.edit', $item->id) }}"
                                class="text-blue-600 hover:underline"
                            >
                                Edit
                            </a>
                            <button 
                                wire:click="delete({{ $item->id }})"
                                wire:confirm="Hapus pengumuman ini?"
                                class="text-red-600 hover:underline"
                            >
                                Hapus
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="border p-4 text-center text-gray-500">
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
