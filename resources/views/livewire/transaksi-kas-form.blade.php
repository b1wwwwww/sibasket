<div class="px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="/dashboard/keuangan" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 font-medium text-sm flex items-center gap-2 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700 transition-colors">
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                {{ $transaksi_id ? 'Edit Transaksi Kas' : 'Buat Transaksi Kas Baru' }}
            </h2>
        </div>

        <form wire:submit="save" class="px-6 py-6 space-y-6 text-gray-900 dark:text-gray-100">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Anggota *</label>
                <select 
                    wire:model="anggota_id"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors"
                >
                    <option value="">Pilih Anggota</option>
                    @foreach($anggota as $member)
                        <option value="{{ $member->id }}">{{ $member->nama }}</option>
                    @endforeach
                </select>
                @error('anggota_id')
                    <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jenis Transaksi *</label>
                    <select 
                        wire:model="jenis"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    >
                        <option value="pemasukan">Pemasukan</option>
                        <option value="pengeluaran">Pengeluaran</option>
                    </select>
                    @error('jenis')
                        <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kategori *</label>
                    <input 
                        type="text"
                        wire:model="kategori"
                        placeholder="e.g., Iuran Bulanan, Donasi, Gaji Pelatih"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    />
                    @error('kategori')
                        <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nominal (Rp) *</label>
                    <input 
                        type="number"
                        wire:model="nominal"
                        placeholder="0"
                        step="0.01"
                        min="0"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    />
                    @error('nominal')
                        <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal Bayar *</label>
                    <input 
                        type="date"
                        wire:model="tanggal_bayar"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    />
                    @error('tanggal_bayar')
                        <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status *</label>
                <select 
                    wire:model="status"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors"
                >
                    <option value="lunas">Lunas</option>
                    <option value="pending">Pending</option>
                    <option value="nunggak">Nunggak</option>
                </select>
                @error('status')
                    <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Keterangan</label>
                <textarea 
                    wire:model="keterangan"
                    placeholder="Masukkan keterangan (opsional)..."
                    rows="3"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition-colors"
                ></textarea>
                @error('keterangan')
                    <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex gap-3 pt-6 border-t border-gray-200 dark:border-gray-600">
                <button 
                    type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium text-sm"
                >
                    {{ $transaksi_id ? 'Update' : 'Buat' }}
                </button>
                <a 
                    href="/dashboard/keuangan"
                    class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-100 rounded-md hover:bg-gray-400 dark:hover:bg-gray-500 font-medium text-sm transition-colors"
                >
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
