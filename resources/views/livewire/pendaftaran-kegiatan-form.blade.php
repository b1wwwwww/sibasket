<div>
    <!-- Status Alert -->
    @if(session('message'))
        <x-alert type="success" :message="session('message')" />
    @endif
    @if(session('error'))
        <x-alert type="error" :message="session('error')" />
    @endif

    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ $kegiatan->judul }}</h3>

        <!-- Kegiatan Details -->
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <p class="text-sm text-gray-600">Tanggal</p>
                <p class="font-semibold">{{ $kegiatan->tanggal->format('d M Y H:i') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Lokasi</p>
                <p class="font-semibold">{{ $kegiatan->lokasi }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Kuota</p>
                <p class="font-semibold">{{ $kegiatan->kuota ?? 'Tidak Terbatas' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Status Kegiatan</p>
                <x-badge :status="$kegiatan->status" />
            </div>
        </div>

        <p class="text-gray-700 mb-6">{{ $kegiatan->deskripsi }}</p>

        <!-- Registration Status & Actions -->
        <div class="border-t pt-4">
            @if($pendaftaran)
                <div class="mb-4">
                    <p class="text-sm text-gray-600">Status Pendaftaran Anda</p>
                    <x-badge :status="$pendaftaran->status" />
                </div>
                
                @if($pendaftaran->status === 'terdaftar')
                    <button wire:click="batalkan" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        Batalkan Pendaftaran
                    </button>
                @else
                    <button wire:click="daftar" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Daftar Ulang
                    </button>
                @endif
            @else
                @if($kegiatan->isMenerimaPendaftaran())
                    <button wire:click="daftar" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Daftar Sekarang
                    </button>
                @else
                    <p class="text-red-600">Kegiatan ini tidak menerima pendaftaran baru.</p>
                @endif
            @endif
        </div>
    </div>
</div>
