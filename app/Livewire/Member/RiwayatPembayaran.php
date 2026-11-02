<?php

namespace App\Livewire\Member;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\KasAnggota;

class RiwayatPembayaran extends Component
{
    use WithPagination;

    public string $filter = 'all'; // all, lunas, belum_lunas
    public string $sortBy = 'latest'; // latest, oldest

    protected $listeners = ['refreshComponent' => '$refresh'];

    /**
     * Get riwayat pembayaran kas member yang login dengan polling support
     * wire:poll.30s akan auto-refresh setiap 30 detik
     */
    public function getPembayaran()
    {
        $user = Auth::user();
        if (!$user->anggota) {
            return collect();
        }

        $query = KasAnggota::query()
            ->where('anggota_id', $user->anggota->id)
            ->with([
                'kasKegiatan',
                'kasKegiatan.kegiatan'
            ]);

        // Filter berdasarkan status pembayaran
        if ($this->filter !== 'all') {
            $query->where('status_bayar', $this->filter);
        }

        // Sort
        if ($this->sortBy === 'latest') {
            $query->latest('updated_at');
        } else {
            $query->oldest('updated_at');
        }

        return $query->paginate(15);
    }

    /**
     * Get badge info untuk status pembayaran
     */
    public function getStatusBadge(string $status): array
    {
        return match ($status) {
            'lunas' => ['label' => 'Lunas', 'color' => 'bg-green-100 text-green-800', 'icon' => '✓'],
            'belum_lunas' => ['label' => 'Belum Lunas', 'color' => 'bg-red-100 text-red-800', 'icon' => '⚠'],
            default => ['label' => 'Tidak Diketahui', 'color' => 'bg-gray-100 text-gray-800', 'icon' => '?'],
        };
    }

    /**
     * Hitung ringkasan keuangan
     */
    public function getRingkasan(): array
    {
        $user = Auth::user();
        if (!$user->anggota) {
            return [
                'total_tagihan' => 0,
                'total_lunas' => 0,
                'total_belum_lunas' => 0,
                'persentase_lunas' => 0,
            ];
        }

        $pembayaran = KasAnggota::where('anggota_id', $user->anggota->id)->get();

        $totalTagihan = $pembayaran->count();
        $totalLunas = $pembayaran->where('status_bayar', 'lunas')->count();
        $totalBelumLunas = $totalTagihan - $totalLunas;
        $persentaseLunas = $totalTagihan > 0 ? round(($totalLunas / $totalTagihan) * 100, 1) : 0;

        return [
            'total_tagihan' => $totalTagihan,
            'total_lunas' => $totalLunas,
            'total_belum_lunas' => $totalBelumLunas,
            'persentase_lunas' => $persentaseLunas,
        ];
    }

    /**
     * Get tagihan belum lunas untuk notification badge
     */
    public function getTagihanBelumLunas(): int
    {
        $user = Auth::user();
        if (!$user->anggota) {
            return 0;
        }

        return KasAnggota::where('anggota_id', $user->anggota->id)
            ->where('status_bayar', 'belum_lunas')
            ->count();
    }

    public function render()
    {
        return view('livewire.member.riwayat-pembayaran', [
            'pembayaran' => $this->getPembayaran(),
            'ringkasan' => $this->getRingkasan(),
            'tagihanBelumLunas' => $this->getTagihanBelumLunas(),
        ]);
    }
}
