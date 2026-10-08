<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Daftar Anggota</h1>
            <p class="mt-1 text-sm text-gray-600">Kelola data anggota klub basket</p>
        </div>
        <a href="/dashboard/anggota/create" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Anggota
        </a>
    </div>

    <!-- Search & Filter -->
    <div class="bg-white px-4 py-5 sm:px-6 rounded-lg shadow mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Search Input -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari Anggota</label>
                <input 
                    type="text" 
                    wire:model.live="search"
                    placeholder="Nama, NIS, atau Kelas..."
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm"
                />
            </div>

            <!-- Status Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select 
                    wire:model.live="status"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm"
                >
                    <option value="">Semua Status</option>
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                    <option value="cuti">Cuti</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <x-table-header label="No" />
                    <x-table-header label="Nama" />
                    <x-table-header label="NIS" />
                    <x-table-header label="Kelas" />
                    <x-table-header label="Status" />
                    <x-table-header label="Aksi" />
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($anggota as $index => $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ ($anggota->currentPage() - 1) * $perPage + $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $item->nama }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $item->nis }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $item->kelas }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($item->status === 'aktif')
                                <x-badge type="success" label="Aktif" />
                            @elseif($item->status === 'nonaktif')
                                <x-badge type="danger" label="Nonaktif" />
                            @else
                                <x-badge type="warning" label="Cuti" />
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
                            <a href="/dashboard/anggota/{{ $item->id }}/edit" class="text-blue-600 hover:text-blue-900 font-medium">Edit</a>
                            <button 
                                wire:click="delete({{ $item->id }})"
                                wire:confirm="Yakin ingin menghapus anggota ini?"
                                class="text-red-600 hover:text-red-900 font-medium"
                            >
                                Hapus
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                            Tidak ada data anggota
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $anggota->links() }}
    </div>
</div>
