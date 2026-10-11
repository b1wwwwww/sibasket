<div class="p-6">
    <h2 class="text-2xl font-bold mb-6">
        {{ $pengumuman_id ? 'Edit Pengumuman' : 'Buat Pengumuman Baru' }}
    </h2>

    <form wire:submit.prevent="save" class="space-y-4">
        <!-- Judul -->
        <div>
            <label class="block text-sm font-semibold mb-2">Judul <span class="text-red-600">*</span></label>
            <input 
                type="text"
                wire:model="judul"
                placeholder="Masukkan judul pengumuman"
                class="w-full px-4 py-2 border rounded"
            >
            @error('judul')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Isi -->
        <div>
            <label class="block text-sm font-semibold mb-2">Isi Pengumuman <span class="text-red-600">*</span></label>
            <textarea 
                wire:model="isi"
                placeholder="Masukkan isi pengumuman"
                rows="8"
                class="w-full px-4 py-2 border rounded"
            ></textarea>
            @error('isi')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Tanggal Publish -->
        <div>
            <label class="block text-sm font-semibold mb-2">Tanggal Publish <span class="text-red-600">*</span></label>
            <input 
                type="date"
                wire:model="tanggal_publish"
                class="w-full px-4 py-2 border rounded"
            >
            @error('tanggal_publish')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="flex gap-4 pt-4">
            <button 
                type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
            >
                {{ $pengumuman_id ? 'Update' : 'Buat' }}
            </button>
            <a 
                href="{{ route('pengumuman.index') }}"
                class="px-6 py-2 bg-gray-400 text-white rounded hover:bg-gray-500"
            >
                Batal
            </a>
        </div>
    </form>
</div>
