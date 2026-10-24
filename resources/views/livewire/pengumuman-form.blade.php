<div class="p-6">
    <div class="mb-6">
        <a href="{{ route('pengumuman.index') }}" class="inline-flex items-center gap-2 text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium text-sm transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg border border-gray-200 dark:border-gray-700 p-6 transition-colors">
        <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">
            {{ $pengumuman_id ? 'Edit Pengumuman' : 'Buat Pengumuman Baru' }}
        </h2>

        <form wire:submit.prevent="save" class="space-y-4 text-gray-900 dark:text-gray-100">
            <!-- Judul -->
            <div>
                <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Judul <span class="text-red-600">*</span></label>
                <input 
                    type="text"
                    wire:model="judul"
                    placeholder="Masukkan judul pengumuman"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                >
                @error('judul')
                    <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Isi Pengumuman -->
            <div>
                <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Isi Pengumuman <span class="text-red-600">*</span></label>
                <textarea 
                    id="isi_input"
                    wire:model.live="isi"
                    placeholder="Masukkan isi pengumuman"
                    rows="10"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                ></textarea>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Anda bisa menggunakan HTML basic untuk format (contoh: &lt;b&gt;bold&lt;/b&gt;, &lt;i&gt;italic&lt;/i&gt;, &lt;p&gt;paragraph&lt;/p&gt;)</p>
            </div>
            @error('isi')
                <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span>
            @enderror

            <!-- Status & Kategori (Grid) -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Status <span class="text-red-600">*</span></label>
                    <select 
                        wire:model="status"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                    >
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                    </select>
                    @error('status')
                        <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Kategori (Opsional)</label>
                    <select 
                        wire:model="kategori"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                    >
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Penting">Penting</option>
                        <option value="Info">Info Umum</option>
                        <option value="Prestasi">Prestasi</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                    @error('kategori')
                        <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Publish Mode Selection -->
            <div class="border border-gray-300 dark:border-gray-600 rounded-lg p-4 bg-gray-50 dark:bg-gray-700/50">
                <label class="block text-sm font-semibold mb-3 text-gray-700 dark:text-gray-300">Mode Publish</label>
                <div class="space-y-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input 
                            type="radio"
                            wire:model="publish_mode"
                            value="now"
                            class="w-4 h-4 border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500"
                        >
                        <span class="text-sm text-gray-700 dark:text-gray-300">Publish Sekarang</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input 
                            type="radio"
                            wire:model="publish_mode"
                            value="scheduled"
                            class="w-4 h-4 border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500"
                        >
                        <span class="text-sm text-gray-700 dark:text-gray-300">Jadwalkan Publish</span>
                    </label>
                </div>

                @if($publish_mode === 'scheduled')
                    <div class="mt-4">
                        <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Waktu Publish <span class="text-red-600">*</span></label>
                        <input 
                            type="datetime-local"
                            wire:model="scheduled_at"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                        >
                        @error('scheduled_at')
                            <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                @endif
            </div>

            <!-- Foto Upload -->
            <div>
                <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Foto (Opsional)</label>
                <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-4 bg-gray-50 dark:bg-gray-700">
                    @if ($foto_path)
                        <div class="mb-4">
                            <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Foto Saat Ini</p>
                            <img src="{{ asset('storage/' . $foto_path) }}" alt="Foto Pengumuman" class="h-32 w-auto rounded">
                        </div>
                    @endif

                    <input 
                        type="file"
                        wire:model="foto_file"
                        accept="image/*"
                        class="w-full"
                    >
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Max 2MB, format: JPG, PNG, GIF</p>

                    @if ($foto_file)
                        <div class="mt-4">
                            <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Preview Foto Baru</p>
                            <img src="{{ $foto_file->temporaryUrl() }}" alt="Preview" class="h-32 w-auto rounded">
                        </div>
                    @endif

                    @error('foto_file')
                        <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Pin Pengumuman -->
            <div class="flex items-center gap-3">
                <input 
                    type="checkbox"
                    wire:model="is_pinned"
                    id="is_pinned"
                    class="w-4 h-4 rounded border-gray-300 dark:border-gray-600 text-blue-600 focus:ring-2 focus:ring-blue-500"
                >
                <label for="is_pinned" class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                    Pin Pengumuman (Tampilkan di Atas)
                </label>
            </div>

            <!-- Preview Button -->
            <div class="flex gap-2">
                <button 
                    type="button"
                    wire:click="togglePreview"
                    class="px-4 py-2 bg-gray-600 dark:bg-gray-700 text-white rounded hover:bg-gray-700 dark:hover:bg-gray-600 transition-colors"
                >
                    {{ $show_preview ? '✕ Tutup Preview' : '👁 Preview' }}
                </button>
            </div>

            <!-- Preview Section -->
            @if($show_preview)
                <div class="border-2 border-blue-500 rounded-lg p-6 bg-blue-50 dark:bg-blue-900/20">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Preview Pengumuman</h3>
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-4">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $judul ?: 'Judul Pengumuman' }}</h2>
                        @if($kategori)
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full mb-3 {{ 
                                $kategori == 'Penting' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' : 
                                ($kategori == 'Prestasi' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' : 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400')
                            }}">
                                {{ $kategori }}
                            </span>
                        @endif
                        <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 whitespace-pre-wrap break-words">
                            {{ $isi ?: 'Isi pengumuman akan ditampilkan di sini...' }}
                        </div>
                    </div>
                </div>
            @endif

            <!-- Buttons -->
            <div class="flex gap-4 pt-4">
                <button 
                    type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors"
                >
                    {{ $pengumuman_id ? 'Update' : 'Buat' }}
                </button>
                <a 
                    href="{{ route('pengumuman.index') }}"
                    class="px-6 py-2 bg-gray-400 dark:bg-gray-600 text-white rounded hover:bg-gray-500 dark:hover:bg-gray-500 transition-colors"
                >
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
// No custom script needed anymore
</script>
@endpush
