<div class="px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="/dashboard/anggota" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 font-medium text-sm flex items-center gap-2 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700 transition-colors">
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                {{ $anggota_id ? 'Edit Anggota' : 'Tambah Anggota Baru' }}
            </h2>
        </div>

        <form wire:submit="save" class="px-6 py-6 space-y-6 text-gray-900 dark:text-gray-100">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">User *</label>
                <select 
                    wire:model="user_id"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors"
                >
                    <option value="">Pilih User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
                @error('user_id')
                    <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama *</label>
                <input 
                    type="text"
                    wire:model="nama"
                    placeholder="Masukkan nama anggota"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors"
                />
                @error('nama')
                    <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">NIS</label>
                <input 
                    type="text"
                    wire:model="nis"
                    placeholder="Masukkan NIS (opsional)"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors"
                />
                @error('nis')
                    <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kelas</label>
                    <select 
                        wire:model="kelas"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    >
                        <option value="">Pilih Kelas</option>
                        <option value="10">Kelas 10</option>
                        <option value="11">Kelas 11</option>
                        <option value="12">Kelas 12</option>
                    </select>
                    @error('kelas')
                        <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jurusan</label>
                    <select 
                        wire:model="jurusan"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    >
                        <option value="">Pilih Jurusan</option>
                        <option value="pplg">PPLG (Pengembangan Perangkat Lunak dan Gim)</option>
                        <option value="elektro">Teknik Elektro</option>
                        <option value="bp">BP (Broadcasting dan Perfilman)</option>
                        <option value="tkj">Teknik Komputer dan Jaringan</option>
                        <option value="mesin">Teknik Mesin</option>
                        <option value="otomotif">Teknik Otomotif</option>
                        <option value="tekstil">Teknik Tekstil</option>
                    </select>
                    @error('jurusan')
                        <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Posisi</label>
                    <select 
                        wire:model="posisi"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    >
                        <option value="">Pilih Posisi (opsional)</option>
                        <option value="PG">Point Guard (PG)</option>
                        <option value="SG">Shooting Guard (SG)</option>
                        <option value="SF">Small Forward (SF)</option>
                        <option value="PF">Power Forward (PF)</option>
                        <option value="C">Center (C)</option>
                    </select>
                    @error('posisi')
                        <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status *</label>
                    <select 
                        wire:model="status"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    >
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                    @error('status')
                        <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal Bergabung *</label>
                <input 
                    type="date"
                    wire:model="tanggal_bergabung"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors"
                />
                @error('tanggal_bergabung')
                    <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">No HP</label>
                    <input 
                        type="text"
                        wire:model="no_hp"
                        placeholder="e.g., 08123456789"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    />
                    @error('no_hp')
                        <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Alamat</label>
                    <textarea 
                        wire:model="alamat"
                        placeholder="Masukkan alamat lengkap"
                        rows="3"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    ></textarea>
                    @error('alamat')
                        <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="flex gap-3 pt-6 border-t border-gray-200 dark:border-gray-600">
                <button 
                    type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium text-sm"
                >
                    {{ $anggota_id ? 'Update' : 'Tambah' }}
                </button>
                <a 
                    href="/dashboard/anggota"
                    class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-100 rounded-md hover:bg-gray-400 dark:hover:bg-gray-500 font-medium text-sm transition-colors"
                >
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
