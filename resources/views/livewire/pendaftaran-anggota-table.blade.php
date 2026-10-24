<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Daftar Pendaftar Baru</h2>

    @if (session()->has('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">{{ session('success') }}</div>
    @endif
    @if (session()->has('error'))
        <div class="bg-red-500 text-white p-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    <div class="mb-4 flex gap-4">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari pendaftar..." class="border p-2 rounded">
        <select wire:model.live="statusFilter" class="border p-2 rounded">
            <option value="pending">Pending</option>
            <option value="approved">Approved</option>
            <option value="rejected">Rejected</option>
        </select>
    </div>

    <table class="w-full bg-white shadow rounded-lg overflow-hidden">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3">Nama</th>
                <th class="p-3">Kontak WA</th>
                <th class="p-3">Status</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pendaftar as $p)
                <tr class="border-b">
                    <td class="p-3">{{ $p->nama }}</td>
                    <td class="p-3">{{ $p->kontak_siswa }}</td>
                    <td class="p-3">
                        <span class="px-2 py-1 rounded text-sm {{ $p->status == 'pending' ? 'bg-yellow-200' : ($p->status == 'approved' ? 'bg-green-200' : 'bg-red-200') }}">
                            {{ ucfirst($p->status) }}
                        </span>
                    </td>
                    <td class="p-3 space-x-2">
                        <button wire:click="selectPendaftar({{ $p->id }})" class="bg-blue-500 text-white px-3 py-1 rounded text-sm">Detail</button>
                        @if($p->status == 'pending')
                            <button wire:click="approve({{ $p->id }})" class="bg-green-500 text-white px-3 py-1 rounded text-sm">Approve</button>
                            <button wire:click="openRejectModal({{ $p->id }})" class="bg-red-500 text-white px-3 py-1 rounded text-sm">Reject</button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-6 text-center text-gray-500">
                        Belum ada pendaftar dengan status "{{ ucfirst($statusFilter) }}"
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">{{ $pendaftar->links() }}</div>

    {{-- Modals --}}
    @if($showRejectModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded shadow-lg">
                <h3 class="font-bold text-lg mb-4">Alasan Penolakan</h3>
                <textarea wire:model="rejectionReason" class="w-full border p-2 mb-4" rows="3"></textarea>
                <button wire:click="reject" class="bg-red-500 text-white px-4 py-2 rounded">Kirim Penolakan</button>
                <button wire:click="$set('showRejectModal', false)" class="ml-2">Batal</button>
            </div>
        </div>
    @endif
</div>
