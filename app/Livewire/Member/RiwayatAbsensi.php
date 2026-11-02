<?php

namespace App\Livewire\Member;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\Absensi;

class RiwayatAbsensi extends Component
{
    use WithPagination;

    public string $filter = 'all'; // all, hadir, sakit, izin, alpha
    public string $sortBy = 'latest'; // latest, oldest

    protected $listeners = ['refreshComponent' => '$refresh'];

    /**
     * Get riwayat absensi member yang login dengan polling support
     * wire:poll.30s akan auto-refresh setiap 30 detik
     */
    public function getAbsensi()
    {
        $user = Auth::user();
        if (!$user->anggota) {
            return collect();
        }

        $query = Absensi::query()
            ->whereHas('pendaftaranKegiatan', function ($q) use ($user) {
                $q->where('anggota_id', $user->anggota->id);
            })
            ->with([
                'pendaftaranKegiatan.kegiatan',
                'pendaftaranKegiatan.kegiatan.jadwalLatihan'
            ]);

        // Filter berdasarkan status kehadiran
        if ($this->filter !== 'all') {
            $query->where('status_kehadiran', $this->filter);
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
     * Get badge info untuk status kehadiran
     */
    public function getStatusBadge(string $status): array
    {
        return match ($status) {
            'hadir' => ['label' => 'Hadir', 'color' => 'bg-green-100 text-green-800', 'icon' => '✓'],
            'sakit' => ['label' => 'Sakit', 'color' => 'bg-yellow-100 text-yellow-800', 'icon' => '🏥'],
            'izin' => ['label' => 'Izin', 'color' => 'bg-blue-100 text-blue-800', 'icon' => '📋'],
            'alpha' => ['label' => 'Alpha', 'color' => 'bg-red-100 text-red-800', 'icon' => '✗'],
            default => ['label' => 'Tidak Diketahui', 'color' => 'bg-gray-100 text-gray-800', 'icon' => '?'],
        };
    }

    /**
     * Hitung statistik kehadiran
     */
    public function getStatistik(): array
    {
        $user = Auth::user();
        if (!$user->anggota) {
            return [
                'total' => 0,
                'hadir' => 0,
                'sakit' => 0,
                'izin' => 0,
                'alpha' => 0,
            ];
        }

        $absensi = Absensi::query()
            ->whereHas('pendaftaranKegiatan', function ($q) use ($user) {
                $q->where('anggota_id', $user->anggota->id);
            })
            ->get();

        return [
            'total' => $absensi->count(),
            'hadir' => $absensi->where('status_kehadiran', 'hadir')->count(),
            'sakit' => $absensi->where('status_kehadiran', 'sakit')->count(),
            'izin' => $absensi->where('status_kehadiran', 'izin')->count(),
            'alpha' => $absensi->where('status_kehadiran', 'alpha')->count(),
        ];
    }

    public function render()
    {
        return view('livewire.member.riwayat-absensi', [
            'absensi' => $this->getAbsensi(),
            'statistik' => $this->getStatistik(),
        ]);
    }
}
