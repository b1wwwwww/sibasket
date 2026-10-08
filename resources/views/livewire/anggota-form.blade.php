<div class="px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="/dashboard/anggota" class="text-blue-600 hover:text-blue-900 font-medium text-sm flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">
                {{ $anggota_id ? 'Edit Anggota' : 'Tambah Anggota Baru' }}
            </h2>
        </div>

        <form wire:submit="save" class="px-6 py-6 space-y-6">
            <!-- User ID -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">User *</label>
                <select 
                    wire:model="user_id"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                >
                    <option value="">Pilih User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
                @error('user_id')
                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Nama -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama *</label>
                <input 
                    type="text"
                    wire:model="nama"
                    placeholder="Masukkan nama anggota"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                />
                @error('nama')
                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- NIS -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">NIS *</label>
                <input 
                    type="text"
                    wire:model="nis"
                    placeholder="Masukkan NIS"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                />
                @error('nis')
                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Kelas & Jurusan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kelas *</label>
                    <input 
                        type="text"
                        wire:model="kelas"
                        placeholder="e.g., 10A, 11B"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    />
                    @error('kelas')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jurusan</label>
                    <input 
                        type="text"
                        wire:model="jurusan"
                        placeholder="e.g., IPA, IPS"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    />
                    @error('jurusan')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Posisi & Status -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Posisi *</label>
                    <input 
                        type="text"
                        wire:model="posisi"
                        placeholder="e.g., Guard, Forward, Center"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    />
                    @error('posisi')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select 
                        wire:model="status"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    >
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                        <option value="cuti">Cuti</option>
                    </select>
                    @error('status')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Tanggal Bergabung -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Bergabung *</label>
                <input 
                    type="date"
                    wire:model="tanggal_bergabung"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                />
                @error('tanggal_bergabung')
                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 pt-6 border-t border-gray-200">
                <button 
                    type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium text-sm"
                >
                    {{ $anggota_id ? 'Update' : 'Tambah' }}
                </button>
                <a 
                    href="/dashboard/anggota"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 font-medium text-sm"
                >
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
