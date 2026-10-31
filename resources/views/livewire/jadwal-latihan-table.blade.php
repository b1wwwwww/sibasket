<div class="p-6 rounded-2xl bg-white dark:bg-slate-900/80 text-gray-900 dark:text-slate-100 shadow-xl ring-1 ring-gray-200 dark:ring-white/10">
    <h2 class="mb-6 text-2xl font-bold text-gray-900 dark:text-slate-100">Kelola Jadwal Latihan</h2>

    {{-- Tombol Tambah --}}
    @if(!$showForm)
        <button wire:click="$set('showForm', true)" class="mb-6 rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 dark:hover:bg-blue-500">
            + Tambah Jadwal Latihan
        </button>
    @endif

    {{-- Form Tambah/Edit --}}
    @if($showForm)
        <div class="mb-6 rounded-lg border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 p-6">
            <h3 class="mb-4 text-lg font-bold">{{ $editingId ? 'Edit' : 'Tambah' }} Jadwal Latihan</h3>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                {{-- Hari --}}
                <div>
                    <label class="block text-sm font-semibold mb-2">Hari *</label>
                    <select wire:model="hari" class="w-full rounded border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-700 p-2 text-gray-900 dark:text-slate-100 focus:border-blue-500 dark:focus:border-orange-500 focus:outline-none">
                        <option value="">-- Pilih Hari --</option>
                        <option value="selasa">Selasa</option>
                        <option value="jumat">Jumat</option>
                        <option value="sabtu">Sabtu</option>
                    </select>
                    @error('hari') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Jam Mulai --}}
                <div>
                    <label class="block text-sm font-semibold mb-2">Jam Mulai *</label>
                    <input wire:model="jam_mulai" type="time" class="w-full rounded border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-700 p-2 text-gray-900 dark:text-slate-100 focus:border-blue-500 dark:focus:border-orange-500 focus:outline-none">
                    @error('jam_mulai') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Jam Selesai --}}
                <div>
                    <label class="block text-sm font-semibold mb-2">Jam Selesai *</label>
                    <input wire:model="jam_selesai" type="time" class="w-full rounded border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-700 p-2 text-gray-900 dark:text-slate-100 focus:border-blue-500 dark:focus:border-orange-500 focus:outline-none">
                    @error('jam_selesai') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Lokasi --}}
                <div>
                    <label class="block text-sm font-semibold mb-2">Lokasi *</label>
                    <input wire:model="lokasi" type="text" placeholder="Lapangan Sekolah, GOR, dll" class="w-full rounded border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-700 p-2 text-gray-900 dark:text-slate-100 focus:border-blue-500 dark:focus:border-orange-500 focus:outline-none">
                    @error('lokasi') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Tipe Lokasi --}}
                <div>
                    <label class="block text-sm font-semibold mb-2">Tipe Lokasi *</label>
                    <select wire:model="tipe_lokasi" class="w-full rounded border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-700 p-2 text-gray-900 dark:text-slate-100 focus:border-blue-500 dark:focus:border-orange-500 focus:outline-none">
                        <option value="outdoor">Outdoor</option>
                        <option value="indoor">Indoor</option>
                    </select>
                </div>
            </div>

            {{-- Tombol Action --}}
            <div class="mt-6 flex gap-2">
                <button wire:click="save" class="rounded bg-green-600 px-4 py-2 text-white hover:bg-green-700 dark:hover:bg-green-500">
                    {{ $editingId ? 'Update' : 'Tambah' }}
                </button>
                <button wire:click="resetForm" class="rounded border border-gray-300 dark:border-slate-600 px-4 py-2 text-gray-700 dark:text-slate-200 hover:bg-gray-100 dark:hover:bg-slate-800">
                    Batal
                </button>
            </div>
        </div>
    @endif

    {{-- Tabel Jadwal Latihan --}}
    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="border-b border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800">
                    <th class="px-4 py-2 text-left text-sm font-semibold">Hari</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Jam</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Lokasi</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Tipe</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Status</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jadwalLatihan as $jadwal)
                    <tr class="border-b border-gray-200 dark:border-slate-700 hover:bg-gray-50 dark:hover:bg-slate-800/50">
                        <td class="px-4 py-3 capitalize font-medium">{{ $jadwal->hari }}</td>
                        <td class="px-4 py-3">{{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }}</td>
                        <td class="px-4 py-3">{{ $jadwal->lokasi }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex rounded px-2 py-1 text-xs font-semibold capitalize 
                                {{ $jadwal->tipe_lokasi == 'indoor' ? 'bg-blue-100 dark:bg-blue-500/20 text-blue-800 dark:text-blue-200' : 'bg-green-100 dark:bg-green-500/20 text-green-800 dark:text-green-200' }}">
                                {{ $jadwal->tipe_lokasi }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <button wire:click="toggleAktif({{ $jadwal->id }})" class="inline-flex rounded px-2 py-1 text-xs font-semibold
                                {{ $jadwal->aktif ? 'bg-green-100 dark:bg-green-500/20 text-green-800 dark:text-green-200' : 'bg-red-100 dark:bg-red-500/20 text-red-800 dark:text-red-200' }}">
                                {{ $jadwal->aktif ? 'Aktif' : 'Nonaktif' }}
                            </button>
                        </td>
                        <td class="px-4 py-3 space-x-2">
                            <button wire:click="edit({{ $jadwal->id }})" class="rounded bg-blue-500 px-3 py-1 text-sm text-white hover:bg-blue-600 dark:hover:bg-blue-400">Edit</button>
                            <button wire:click="delete({{ $jadwal->id }})" onclick="return confirm('Yakin hapus?')" class="rounded bg-red-500 px-3 py-1 text-sm text-white hover:bg-red-600 dark:hover:bg-red-400">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500 dark:text-slate-400">
                            Belum ada jadwal latihan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
