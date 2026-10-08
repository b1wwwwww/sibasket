<div class="px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="/dashboard/kegiatan" class="text-blue-600 hover:text-blue-900 font-medium text-sm flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">
                {{ $kegiatan_id ? 'Edit Kegiatan' : 'Buat Kegiatan Baru' }}
            </h2>
        </div>

        <form wire:submit="save" class="px-6 py-6 space-y-6">
            <!-- Judul -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Judul Kegiatan *</label>
                <input 
                    type="text"
                    wire:model="judul"
                    placeholder="Masukkan judul kegiatan"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                />
                @error('judul')
                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea 
                    wire:model="deskripsi"
                    placeholder="Masukkan deskripsi kegiatan..."
                    rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                ></textarea>
                @error('deskripsi')
                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tanggal & Lokasi -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal & Waktu *</label>
                    <input 
                        type="datetime-local"
                        wire:model="tanggal"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    />
                    @error('tanggal')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi *</label>
                    <input 
                        type="text"
                        wire:model="lokasi"
                        placeholder="e.g., Lapangan Sekolah, Gedung Olahraga"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    />
                    @error('lokasi')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Kuota & Status -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kuota Peserta</label>
                    <input 
                        type="number"
                        wire:model="kuota"
                        placeholder="Biarkan kosong jika tanpa batas"
                        min="1"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    />
                    @error('kuota')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select 
                        wire:model="status"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    >
                        <option value="draft">Draft</option>
                        <option value="published">Dipublikasi</option>
                        <option value="ongoing">Sedang Berlangsung</option>
                        <option value="completed">Selesai</option>
                        <option value="cancelled">Dibatalkan</option>
                    </select>
                    @error('status')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 pt-6 border-t border-gray-200">
                <button 
                    type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium text-sm"
                >
                    {{ $kegiatan_id ? 'Update' : 'Buat' }}
                </button>
                <a 
                    href="/dashboard/kegiatan"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 font-medium text-sm"
                >
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
