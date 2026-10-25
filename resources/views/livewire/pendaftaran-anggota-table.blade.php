<div class="p-6 rounded-2xl bg-slate-900/80 text-slate-100 shadow-xl ring-1 ring-white/10">
    <h2 class="mb-4 text-2xl font-bold text-slate-100">Daftar Pendaftar Baru</h2>

    @if (session()->has('success'))
        <div class="mb-4 rounded bg-green-500/90 p-3 text-white">{{ session('success') }}</div>
    @endif
    @if (session()->has('error'))
        <div class="mb-4 rounded bg-red-500/90 p-3 text-white">{{ session('error') }}</div>
    @endif

    <div class="mb-4 flex gap-4">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari pendaftar..." class="w-full rounded border border-slate-700 bg-slate-800 p-2 text-slate-100 placeholder:text-slate-400 focus:border-orange-500 focus:outline-none">
        <select wire:model.live="statusFilter" class="rounded border border-slate-700 bg-slate-800 p-2 text-slate-100 focus:border-orange-500 focus:outline-none">
            <option value="pending">Pending</option>
            <option value="approved">Approved</option>
            <option value="rejected">Rejected</option>
        </select>
    </div>

    <div class="overflow-hidden rounded-xl border border-slate-700 shadow-lg">
        <table class="w-full border-collapse bg-slate-900 text-left text-slate-200">
            <thead class="bg-slate-800 text-slate-200">
                <tr>
                    <th class="p-3 font-semibold">Nama</th>
                    <th class="p-3 font-semibold">Kontak WA</th>
                    <th class="p-3 font-semibold">Status</th>
                    <th class="p-3 font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendaftar as $p)
                    <tr class="border-b border-slate-700 bg-slate-900/80 hover:bg-slate-800/80">
                        <td class="p-3 text-slate-100">{{ $p->nama }}</td>
                        <td class="p-3 text-slate-200">{{ $p->kontak_siswa }}</td>
                        <td class="p-3">
                            <span class="inline-flex rounded px-2 py-1 text-sm font-medium {{ $p->status == 'pending' ? 'bg-yellow-400/20 text-yellow-200 ring-1 ring-yellow-400/30' : ($p->status == 'approved' ? 'bg-green-500/20 text-green-200 ring-1 ring-green-400/30' : 'bg-red-500/20 text-red-200 ring-1 ring-red-400/30') }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                        <td class="p-3 space-x-2">
                            <button wire:click="selectPendaftar({{ $p->id }})" class="rounded bg-blue-500 px-3 py-1 text-sm text-white hover:bg-blue-400">Detail</button>
                            @if($p->status == 'pending')
                                <button wire:click="approve({{ $p->id }})" class="rounded bg-green-500 px-3 py-1 text-sm text-white hover:bg-green-400">Approve</button>
                                <button wire:click="openRejectModal({{ $p->id }})" class="rounded bg-red-500 px-3 py-1 text-sm text-white hover:bg-red-400">Reject</button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-6 text-center text-slate-400">
                            Belum ada pendaftar dengan status "{{ ucfirst($statusFilter) }}"
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4 text-slate-300">{{ $pendaftar->links() }}</div>

    {{-- Modals --}}
    @if($showRejectModal)
        <div class="fixed inset-0 flex items-center justify-center bg-slate-950/70">
            <div class="w-full max-w-md rounded-xl bg-slate-900 p-6 shadow-2xl ring-1 ring-slate-700">
                <h3 class="mb-4 text-lg font-bold text-slate-100">Alasan Penolakan</h3>
                <textarea wire:model="rejectionReason" class="mb-4 w-full rounded border border-slate-700 bg-slate-800 p-2 text-slate-100 placeholder:text-slate-400" rows="3"></textarea>
                <div class="flex gap-2">
                    <button wire:click="reject" class="rounded bg-red-500 px-4 py-2 text-white hover:bg-red-400">Kirim Penolakan</button>
                    <button wire:click="$set('showRejectModal', false)" class="rounded border border-slate-600 px-4 py-2 text-slate-200 hover:bg-slate-800">Batal</button>
                </div>
            </div>
        </div>
    @endif
</div>
