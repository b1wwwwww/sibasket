<div>
    <div class="mb-4">
        <h2 class="text-xl font-semibold text-gray-800">
            Daftar Pendaftar {{ $kegiatan ? ': ' . $kegiatan->judul : '' }}
        </h2>
    </div>

    <!-- Filter & Search -->
    <div class="flex gap-4 mb-4">
        <input wire:model.live="search" type="text" placeholder="Cari anggota (nama/nis)..." class="border rounded px-3 py-2 w-64">
        
        <select wire:model.live="status" class="border rounded px-3 py-2">
            <option value="">Semua Status</option>
            <option value="terdaftar">Terdaftar</option>
            <option value="dibatalkan">Dibatalkan</option>
        </select>
    </div>

    <!-- Table -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Anggota</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kegiatan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($pendaftarans as $p)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $p->anggota->nama }} ({{ $p->anggota->nis }})</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $p->kegiatan->judul }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <x-badge :status="$p->status" />
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($p->status === 'terdaftar')
                            <button wire:click="updateStatus({{ $p->id }}, 'dibatalkan')" class="text-red-600 hover:text-red-900">Batalkan</button>
                        @endif
                        <button wire:click="deletePendaftaran({{ $p->id }})" class="ml-4 text-gray-600 hover:text-gray-900" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada pendaftar ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">
            {{ $pendaftarans->links() }}
        </div>
    </div>
</div>
