<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold mb-2">Daftar Anggota Basket</h1>
    <p class="text-gray-600 mb-6">Isi formulir di bawah untuk bergabung dengan klub basket kami</p>

    @if($submitted)
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            <h3 class="font-bold mb-2">✅ Pendaftaran Berhasil!</h3>
            <p class="mb-2">Terima kasih telah mendaftar. Data Anda akan diverifikasi oleh admin.</p>
            <p class="text-sm">Admin akan menghubungi Anda melalui nomor WA yang Anda berikan dalam 1-2 hari kerja.</p>
            <button wire:click="$set('submitted', false)" class="mt-3 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Kembali</button>
        </div>
    @else
        <form wire:submit="submit" class="space-y-4">
            {{-- Nama Lengkap --}}
            <div>
                <label class="block font-semibold mb-2">Nama Lengkap *</label>
                <input wire:model="nama" type="text" placeholder="Contoh: Ahmad Rizki Pratama" 
                    class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500">
                @error('nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Nama Panggilan --}}
            <div>
                <label class="block font-semibold mb-2">Nama Panggilan *</label>
                <input wire:model="nama_panggilan" type="text" placeholder="Contoh: Rizki"
                    class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500">
                @error('nama_panggilan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Kelas --}}
            <div>
                <label class="block font-semibold mb-2">Kelas *</label>
                <select wire:model="kelas" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500">
                    <option value="">-- Pilih Kelas --</option>
                    <option value="10">Kelas 10</option>
                    <option value="11">Kelas 11</option>
                    <option value="12">Kelas 12</option>
                </select>
                @error('kelas') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Jurusan & Jenis Kelamin (2 kolom) --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold mb-2">Jurusan *</label>
                    <select wire:model="jurusan" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500">
                        <option value="">-- Pilih Jurusan --</option>
                        <option value="pplg">PPLG (Pengembangan Perangkat Lunak)</option>
                        <option value="tkj">TKJ (Teknik Komputer dan Jaringan)</option>
                        <option value="bp">BP (Broadcasting dan Perfilman)</option>
                        <option value="elektro">Teknik Elektro</option>
                        <option value="mesin">Teknik Mesin</option>
                        <option value="otomotif">Teknik Otomotif</option>
                        <option value="tekstil">Teknik Tekstil</option>
                    </select>
                    @error('jurusan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Jenis Kelamin *</label>
                    <select wire:model="jenis_kelamin" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500">
                        <option value="">-- Pilih --</option>
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                    @error('jenis_kelamin') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Kontak WA & Orang Tua (2 kolom) --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold mb-2">Nomor WA Kamu *</label>
                    <input wire:model="kontak_siswa" type="text" placeholder="08xxxxxxxxx"
                        class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500">
                    @error('kontak_siswa') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Nomor WA Orang Tua *</label>
                    <input wire:model="kontak_orang_tua" type="text" placeholder="08xxxxxxxxx"
                        class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500">
                    @error('kontak_orang_tua') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Alamat (Opsional) --}}
            <div>
                <label class="block font-semibold mb-2">Alamat (Opsional)</label>
                <textarea wire:model="alamat" placeholder="Alamat rumah Anda..." rows="3"
                    class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500"></textarea>
                @error('alamat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Pengalaman & Orang Tua Tahu (2 kolom) --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold mb-2">Pengalaman Main Basket? *</label>
                    <select wire:model="pengalaman_basket" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500">
                        <option value="">-- Pilih --</option>
                        <option value="iya">Ya, pernah</option>
                        <option value="tidak">Tidak, pemula</option>
                    </select>
                    @error('pengalaman_basket') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Orang Tua Mengetahui? *</label>
                    <select wire:model="orang_tua_mengetahui" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500">
                        <option value="">-- Pilih --</option>
                        <option value="iya">Ya</option>
                        <option value="tidak">Tidak</option>
                    </select>
                    @error('orang_tua_mengetahui') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Alasan Gabung --}}
            <div>
                <label class="block font-semibold mb-2">Alasan Ingin Bergabung *</label>
                <textarea wire:model="alasan_gabung" placeholder="Jelaskan alasan Anda ingin bergabung dengan klub basket..." rows="4"
                    class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500"></textarea>
                <p class="text-gray-500 text-sm">Minimal 10 karakter</p>
                @error('alasan_gabung') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Checkbox --}}
            <div class="space-y-3 bg-gray-50 p-4 rounded">
                <label class="flex items-center">
                    <input wire:model="setuju_peraturan" type="checkbox" class="mr-2">
                    <span>Saya setuju dengan peraturan dan tata tertib klub basket *</span>
                </label>
                @error('setuju_peraturan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded hover:bg-blue-700 transition">
                Daftar Sekarang
            </button>
        </form>
    @endif
</div>
