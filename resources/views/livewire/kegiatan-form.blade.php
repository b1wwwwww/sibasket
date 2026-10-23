<div class="px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="/dashboard/kegiatan" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 font-medium text-sm flex items-center gap-2 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700 transition-colors">
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                {{ $kegiatan_id ? 'Edit Kegiatan' : 'Buat Kegiatan Baru' }}
            </h2>
        </div>

        <form wire:submit="save" class="px-6 py-6 space-y-6 text-gray-900 dark:text-gray-100">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Judul Kegiatan *</label>
                <input 
                    type="text"
                    wire:model="judul"
                    placeholder="Masukkan judul kegiatan"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors"
                />
                @error('judul')
                    <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Deskripsi</label>
                <textarea 
                    wire:model="deskripsi"
                    placeholder="Masukkan deskripsi kegiatan..."
                    rows="4"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors"
                ></textarea>
                @error('deskripsi')
                    <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal Mulai *</label>
                    <input 
                        type="datetime-local"
                        wire:model="tanggal"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    />
                    @error('tanggal')
                        <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal Selesai (Opsional)</label>
                    <input 
                        type="datetime-local"
                        wire:model="tanggal_selesai"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    />
                    @error('tanggal_selesai')
                        <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Lokasi *</label>
                    <input 
                        type="text"
                        wire:model="lokasi"
                        placeholder="e.g., Lapangan Sekolah, Gedung Olahraga"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    />
                    @error('lokasi')
                        <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kategori (Opsional)</label>
                    <select 
                        wire:model="kategori"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    >
                        <option value="">-- Pilih Kategori --</option>
                        <option value="latihan">Latihan</option>
                        <option value="pertandingan">Pertandingan</option>
                        <option value="seleksi">Seleksi</option>
                        <option value="gathering">Gathering</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                    @error('kategori')
                        <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Foto Kegiatan (Opsional)</label>
                    <div class="border border-dashed border-gray-300 dark:border-gray-600 rounded-md p-4">
                        @if ($foto_path)
                            <div class="mb-3">
                                <img src="{{ \Storage::url($foto_path) }}" alt="Foto Kegiatan" class="w-full h-40 object-cover rounded-md">
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">Foto saat ini</p>
                            </div>
                        @endif
                        
                        @if ($foto)
                            <div class="mb-3">
                                <img src="{{ $foto->temporaryUrl() }}" alt="Preview Foto" class="w-full h-40 object-cover rounded-md">
                                <p class="text-xs text-blue-600 dark:text-blue-400 mt-2">Preview foto baru</p>
                            </div>
                        @endif
                        
                        <input 
                            type="file"
                            wire:model="foto"
                            accept="image/*"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 dark:file:bg-blue-900 file:text-blue-700 dark:file:text-blue-200 hover:file:bg-blue-100 dark:hover:file:bg-blue-800 transition-colors"
                        />
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Max 2MB (JPG, PNG, GIF)</p>
                    </div>
                    @error('foto')
                        <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kuota Peserta</label>
                    <input 
                        type="number"
                        wire:model="kuota"
                        placeholder="Biarkan kosong jika tanpa batas"
                        min="1"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    />
                    @error('kuota')
                        <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status *</label>
                    <select 
                        wire:model="status"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    >
                        <option value="draft">Draft</option>
                        <option value="published">Dipublikasi</option>
                        <option value="ongoing">Sedang Berlangsung</option>
                        <option value="completed">Selesai</option>
                        <option value="cancelled">Dibatalkan</option>
                    </select>
                    @error('status')
                        <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="flex gap-3 pt-6 border-t border-gray-200 dark:border-gray-600">
                <button 
                    type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium text-sm"
                >
                    {{ $kegiatan_id ? 'Update' : 'Buat' }}
                </button>
                <a 
                    href="/dashboard/kegiatan"
                    class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-100 rounded-md hover:bg-gray-400 dark:hover:bg-gray-500 font-medium text-sm transition-colors"
                >
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
