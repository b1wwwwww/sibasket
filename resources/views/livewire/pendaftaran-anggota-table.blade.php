<div class="p-6 rounded-2xl bg-white dark:bg-slate-900/80 text-gray-900 dark:text-slate-100 shadow-xl ring-1 ring-gray-200 dark:ring-white/10">
    <h2 class="mb-4 text-2xl font-bold text-gray-900 dark:text-slate-100">Daftar Pendaftar Baru</h2>

    @if (session()->has('success'))
        <div class="mb-4 rounded bg-green-100 dark:bg-green-500/90 border border-green-400 dark:border-transparent p-3 text-green-700 dark:text-white">{{ session('success') }}</div>
    @endif
    @if (session()->has('error'))
        <div class="mb-4 rounded bg-red-100 dark:bg-red-500/90 border border-red-400 dark:border-transparent p-3 text-red-700 dark:text-white">{{ session('error') }}</div>
    @endif

    <div class="mb-4 flex gap-4">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari pendaftar..." class="w-full rounded border border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 p-2 text-gray-900 dark:text-slate-100 placeholder:text-gray-400 dark:placeholder:text-slate-400 focus:border-blue-500 dark:focus:border-orange-500 focus:outline-none">
        <select wire:model.live="statusFilter" class="rounded border border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 p-2 text-gray-900 dark:text-slate-100 focus:border-blue-500 dark:focus:border-orange-500 focus:outline-none">
            <option value="pending">Pending</option>
            <option value="approved">Approved</option>
            <option value="rejected">Rejected</option>
        </select>
    </div>

    <div class="overflow-hidden rounded-xl border border-gray-300 dark:border-slate-700 shadow-lg">
        <table class="w-full border-collapse bg-white dark:bg-slate-900 text-left text-gray-900 dark:text-slate-200">
            <thead class="bg-gray-100 dark:bg-slate-800 text-gray-900 dark:text-slate-200">
                <tr>
                    <th class="p-3 font-semibold">Nama</th>
                    <th class="p-3 font-semibold">Kontak WA</th>
                    <th class="p-3 font-semibold">Status</th>
                    <th class="p-3 font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendaftar as $p)
                    <tr class="border-b border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900/80 hover:bg-gray-50 dark:hover:bg-slate-800/80">
                        <td class="p-3 text-gray-900 dark:text-slate-100">{{ $p->nama }}</td>
                        <td class="p-3 text-gray-700 dark:text-slate-200">{{ $p->kontak_siswa }}</td>
                        <td class="p-3">
                            <span class="inline-flex rounded px-2 py-1 text-sm font-medium {{ $p->status == 'pending' ? 'bg-yellow-100 dark:bg-yellow-400/20 text-yellow-800 dark:text-yellow-200 ring-1 ring-yellow-300 dark:ring-yellow-400/30' : ($p->status == 'approved' ? 'bg-green-100 dark:bg-green-500/20 text-green-800 dark:text-green-200 ring-1 ring-green-300 dark:ring-green-400/30' : 'bg-red-100 dark:bg-red-500/20 text-red-800 dark:text-red-200 ring-1 ring-red-300 dark:ring-red-400/30') }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                        <td class="p-3 space-x-2">
                            <button wire:click="selectPendaftar({{ $p->id }})" class="rounded bg-blue-500 px-3 py-1 text-sm text-white hover:bg-blue-600 dark:hover:bg-blue-400">Detail</button>
                            @if($p->status == 'pending')
                                <button wire:click="approve({{ $p->id }})" class="rounded bg-green-500 px-3 py-1 text-sm text-white hover:bg-green-600 dark:hover:bg-green-400">Approve</button>
                                <button wire:click="openRejectModal({{ $p->id }})" class="rounded bg-red-500 px-3 py-1 text-sm text-white hover:bg-red-600 dark:hover:bg-red-400">Reject</button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-6 text-center text-gray-500 dark:text-slate-400">
                            Belum ada pendaftar dengan status "{{ ucfirst($statusFilter) }}"
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4 text-gray-600 dark:text-slate-300">{{ $pendaftar->links() }}</div>

    {{-- Modal Detail Pendaftar --}}
    @if($showDetailModal && $selectedPendaftar)
        <div class="fixed inset-0 flex items-center justify-center bg-black/30 dark:bg-slate-950/70 z-50">
            <div class="w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-xl bg-white dark:bg-slate-900 p-6 shadow-2xl ring-1 ring-gray-300 dark:ring-slate-700">
                
                {{-- Header --}}
                <div class="mb-6 flex items-center justify-between border-b border-gray-300 dark:border-slate-700 pb-4">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-slate-100">Detail Pendaftar Baru</h3>
                    <button wire:click="$set('showDetailModal', false)" class="text-gray-400 dark:text-slate-400 hover:text-gray-600 dark:hover:text-slate-200">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                {{-- Data Pendaftar --}}
                <div class="space-y-5 mb-6">
                    
                    {{-- Nama & Nama Panggilan --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1">Nama Lengkap</label>
                            <p class="text-gray-900 dark:text-slate-100 bg-gray-100 dark:bg-slate-800/50 rounded p-3">{{ $selectedPendaftar->nama }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1">Nama Panggilan</label>
                            <p class="text-gray-900 dark:text-slate-100 bg-gray-100 dark:bg-slate-800/50 rounded p-3">{{ $selectedPendaftar->nama_panggilan }}</p>
                        </div>
                    </div>

                    {{-- Jurusan & Jenis Kelamin --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1">Jurusan</label>
                            <p class="text-gray-900 dark:text-slate-100 bg-gray-100 dark:bg-slate-800/50 rounded p-3">{{ $selectedPendaftar->jurusan }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1">Jenis Kelamin</label>
                            <p class="text-gray-900 dark:text-slate-100 bg-gray-100 dark:bg-slate-800/50 rounded p-3">{{ ucfirst($selectedPendaftar->jenis_kelamin) }}</p>
                        </div>
                    </div>

                    {{-- Kelas & Kontak Siswa --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1">Kelas</label>
                            <p class="text-gray-900 dark:text-slate-100 bg-gray-100 dark:bg-slate-800/50 rounded p-3">{{ $selectedPendaftar->kelas ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1">Kontak Siswa (WA)</label>
                            <p class="text-gray-900 dark:text-slate-100 bg-gray-100 dark:bg-slate-800/50 rounded p-3 break-all">{{ $selectedPendaftar->kontak_siswa }}</p>
                        </div>
                    </div>

                    {{-- Kontak Orang Tua & NIS --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1">Kontak Orang Tua</label>
                            <p class="text-gray-900 dark:text-slate-100 bg-gray-100 dark:bg-slate-800/50 rounded p-3 break-all">{{ $selectedPendaftar->kontak_orang_tua }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1">NIS</label>
                            <p class="text-gray-900 dark:text-slate-100 bg-gray-100 dark:bg-slate-800/50 rounded p-3">
                                @if($selectedPendaftar->nis)
                                    {{ $selectedPendaftar->nis }}
                                @else
                                    <span class="text-gray-500 dark:text-slate-400 italic">Belum terisi (akan diisi admin via WA)</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1">Alamat</label>
                        <p class="text-gray-900 dark:text-slate-100 bg-gray-100 dark:bg-slate-800/50 rounded p-3">
                            @if($selectedPendaftar->alamat)
                                {{ $selectedPendaftar->alamat }}
                            @else
                                <span class="text-gray-500 dark:text-slate-400 italic">-</span>
                            @endif
                        </p>
                    </div>

                    {{-- Pengalaman Basket --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1">Pengalaman Basket</label>
                        <p class="text-gray-900 dark:text-slate-100 bg-gray-100 dark:bg-slate-800/50 rounded p-3">{{ $selectedPendaftar->pengalaman_basket ?? '-' }}</p>
                    </div>

                    {{-- Alasan Gabung --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1">Alasan Bergabung</label>
                        <p class="text-gray-900 dark:text-slate-100 bg-gray-100 dark:bg-slate-800/50 rounded p-3">{{ $selectedPendaftar->alasan_gabung }}</p>
                    </div>

                    {{-- Persetujuan --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1">Setuju Peraturan</label>
                            <p class="text-gray-900 dark:text-slate-100 bg-gray-100 dark:bg-slate-800/50 rounded p-3">
                                <span class="{{ $selectedPendaftar->setuju_peraturan ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                    {{ $selectedPendaftar->setuju_peraturan ? '✓ Setuju' : '✗ Tidak Setuju' }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1">Orang Tua Mengetahui</label>
                            <p class="text-gray-900 dark:text-slate-100 bg-gray-100 dark:bg-slate-800/50 rounded p-3">{{ $selectedPendaftar->orang_tua_mengetahui ?? '-' }}</p>
                        </div>
                    </div>

                    {{-- Tanggal Daftar --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1">Tanggal Pendaftaran</label>
                        <p class="text-gray-900 dark:text-slate-100 bg-gray-100 dark:bg-slate-800/50 rounded p-3">{{ $selectedPendaftar->created_at->format('d-m-Y H:i') }}</p>
                    </div>
                </div>

                {{-- Aksi Buttons (Tutup saja karena action ada di tabel) --}}
                <div class="flex gap-3 border-t border-gray-300 dark:border-slate-700 pt-4">
                    <button wire:click="$set('showDetailModal', false)" class="flex-1 rounded border border-gray-300 dark:border-slate-600 px-4 py-2 text-gray-700 dark:text-slate-200 hover:bg-gray-100 dark:hover:bg-slate-800">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- Modal Reject --}}
    @if($showRejectModal)
        <div class="fixed inset-0 flex items-center justify-center bg-black/30 dark:bg-slate-950/70 z-50">
            <div class="w-full max-w-md rounded-xl bg-white dark:bg-slate-900 p-6 shadow-2xl ring-1 ring-gray-300 dark:ring-slate-700">
                <h3 class="mb-4 text-lg font-bold text-gray-900 dark:text-slate-100">Alasan Penolakan</h3>
                <textarea wire:model="rejectionReason" placeholder="Jelaskan alasan penolakan..." class="mb-4 w-full rounded border border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 p-2 text-gray-900 dark:text-slate-100 placeholder:text-gray-400 dark:placeholder:text-slate-400 focus:border-blue-500 dark:focus:border-orange-500 focus:outline-none" rows="4"></textarea>
                <div class="flex gap-2">
                    <button wire:click="reject" class="flex-1 rounded bg-red-500 px-4 py-2 font-semibold text-white hover:bg-red-600 dark:hover:bg-red-400">Kirim Penolakan</button>
                    <button wire:click="$set('showRejectModal', false)" class="flex-1 rounded border border-gray-300 dark:border-slate-600 px-4 py-2 text-gray-700 dark:text-slate-200 hover:bg-gray-100 dark:hover:bg-slate-800">Batal</button>
                </div>
            </div>
        </div>
    @endif
</div>
