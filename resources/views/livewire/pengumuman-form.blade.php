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

            <div>
                <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Isi Pengumuman <span class="text-red-600">*</span></label>
                <textarea 
                    wire:model="isi"
                    placeholder="Masukkan isi pengumuman"
                    rows="8"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                ></textarea>
                @error('isi')
                    <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Tanggal Publish <span class="text-red-600">*</span></label>
                <input 
                    type="date"
                    wire:model="tanggal_publish"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                >
                @error('tanggal_publish')
                    <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

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
