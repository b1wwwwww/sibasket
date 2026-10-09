<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Keuangan</h1>
            <p class="mt-1 text-sm text-gray-600">Kelola transaksi kas dan keuangan klub</p>
        </div>
        <a href="/dashboard/keuangan/create" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Transaksi
        </a>
    </div>

    <!-- Search & Filter -->
    <div class="bg-white px-4 py-5 sm:px-6 rounded-lg shadow mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Search Input -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari Transaksi</label>
                <input 
                    type="text" 
                    wire:model.live="search"
                    placeholder="Nama, kategori, atau keterangan..."
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm"
                />
            </div>

            <!-- Jenis Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Transaksi</label>
                <select 
                    wire:model.live="jenis"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm"
                >
                    <option value="">Semua Jenis</option>
                    <option value="pemasukan">Pemasukan</option>
                    <option value="pengeluaran">Pengeluaran</option>
                </select>
            </div>

            <!-- Status Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select 
                    wire:model.live="status"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm"
                >
                    <option value="">Semua Status</option>
                    <option value="lunas">Lunas</option>
                    <option value="pending">Pending</option>
                    <option value="nunggak">Nunggak</option>
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
                    <x-table-header label="Tanggal" />
                    <x-table-header label="Anggota" />
                    <x-table-header label="Kategori" />
                    <x-table-header label="Jenis" />
                    <x-table-header label="Nominal" />
                    <x-table-header label="Status" />
                    <x-table-header label="Aksi" />
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($transaksi as $index => $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ ($transaksi->currentPage() - 1) * $perPage + $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $item->tanggal_bayar->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $item->anggota->nama }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $item->kategori }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($item->jenis === 'pemasukan')
                                <x-badge type="success" label="Pemasukan" />
                            @else
                                <x-badge type="danger" label="Pengeluaran" />
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                            Rp {{ number_format($item->nominal, 2, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($item->status === 'lunas')
                                <x-badge type="success" label="Lunas" />
                            @elseif($item->status === 'pending')
                                <x-badge type="warning" label="Pending" />
                            @else
                                <x-badge type="danger" label="Nunggak" />
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
                            <a href="/dashboard/keuangan/{{ $item->id }}/edit" class="text-blue-600 hover:text-blue-900 font-medium">Edit</a>
                            <button 
                                wire:click="delete({{ $item->id }})"
                                wire:confirm="Yakin ingin menghapus transaksi ini?"
                                class="text-red-600 hover:text-red-900 font-medium"
                            >
                                Hapus
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-8 text-center text-sm text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Tidak ada data transaksi
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $transaksi->links() }}
    </div>
</div>
