<div>
    <div class="mb-4">
        <h2 class="text-xl font-semibold text-gray-800">
            Absensi Kegiatan {{ $kegiatan ? ': ' . $kegiatan->judul : '' }}
        </h2>
    </div>

    <!-- Filter & Search -->
    <div class="flex gap-4 mb-4">
        <input wire:model.live="search" type="text" placeholder="Cari anggota (nama/nis)..." class="border rounded px-3 py-2 w-64">
        
        <select wire:model.live="statusKehadiran" class="border rounded px-3 py-2">
            <option value="">Semua Status</option>
            <option value="hadir">Hadir</option>
            <option value="izin">Izin</option>
            <option value="tidak_hadir">Tidak Hadir</option>
        </select>
    </div>

    <!-- Alert -->
    @if(session('message'))
        <x-alert type="success" :message="session('message')" />
    @endif

    <!-- Table -->
    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Anggota</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Kehadiran</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($pendaftarans as $p)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $p->anggota->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $p->anggota->nis }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <select wire:change="updateStatusKehadiran({{ $p->id }}, $event.target.value)" class="border rounded px-2 py-1 text-sm">
                            <option value="tidak_hadir" @selected(!$p->absensi || $p->absensi->status_kehadiran === 'tidak_hadir')>Tidak Hadir</option>
                            <option value="hadir" @selected($p->absensi && $p->absensi->status_kehadiran === 'hadir')>Hadir</option>
                            <option value="izin" @selected($p->absensi && $p->absensi->status_kehadiran === 'izin')>Izin</option>
                        </select>
                    </td>
                    <td class="px-6 py-4">
                        <input wire:change="updateCatatan({{ $p->id }}, $event.target.value)" 
                               type="text" 
                               value="{{ $p->absensi?->catatan ?? '' }}" 
                               placeholder="Catatan..." 
                               class="border rounded px-2 py-1 w-64 text-sm">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($p->absensi)
                            <span class="text-xs text-gray-500">
                                {{ $p->absensi->created_at->format('d M, H:i') }}
                            </span>
                        @else
                            <span class="text-xs text-gray-400">Belum dimark</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada pendaftar ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t">
            {{ $pendaftarans->links() }}
        </div>
    </div>
</div>
