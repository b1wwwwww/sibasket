<div class="p-4 sm:p-6">
    <div class="mb-4">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
            Daftar Pendaftar {{ $kegiatan ? ': ' . $kegiatan->judul : '' }}
        </h2>
        <p class="mt-1 text-sm text-gray-700 dark:text-gray-300">Kelola pendaftaran peserta kegiatan</p>
    </div>

    <!-- Filter & Search -->
    <div class="flex flex-col sm:flex-row gap-4 mb-4">
        <input wire:model.live="search" type="text" placeholder="Cari anggota (nama/nis)..." class="border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 w-full sm:w-64 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
        
        <select wire:model.live="status" class="border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
            <option value="">Semua Status</option>
            <option value="terdaftar">Terdaftar</option>
            <option value="dibatalkan">Dibatalkan</option>
        </select>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700 transition-colors">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Anggota</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Kegiatan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($pendaftarans as $p)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/60 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-200">{{ $p->anggota->nama }} ({{ $p->anggota->nis }})</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-200">{{ $p->kegiatan->judul }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <x-badge :status="$p->status" />
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($p->status === 'terdaftar')
                            <button wire:click="updateStatus({{ $p->id }}, 'dibatalkan')" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 transition-colors">Batalkan</button>
                        @endif
                        <button wire:click="deletePendaftaran({{ $p->id }})" class="ml-4 text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">Tidak ada pendaftar ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
            {{ $pendaftarans->links() }}
        </div>
    </div>
</div>
