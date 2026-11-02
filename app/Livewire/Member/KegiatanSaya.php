<?php

namespace App\Livewire\Member;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\PendaftaranKegiatan;
use App\Models\Kegiatan;
use App\Models\Absensi;

class KegiatanSaya extends Component
{
    use WithPagination;

    public string $filter = 'all'; // all, upcoming, past

    // Inline state
    public ?int $expandedPendaftaranId = null;
    public string $statusDeklarasi = 'hadir';
    public string $alasanDeklarasi = '';

    protected $listeners = ['refreshComponent' => '$refresh'];

    /**
     * Get kegiatan yang pernah didaftar member yang login
     */
    public function getKegiatan()
    {
        $user = Auth::user();
        if (!$user->anggota) {
            return collect();
        }

        $query = PendaftaranKegiatan::query()
            ->where('anggota_id', $user->anggota->id)
            ->with(['kegiatan', 'kegiatan.jadwalLatihan', 'absensi'])
            ->latest('created_at');

        // Filter berdasarkan status
        if ($this->filter === 'upcoming') {
            $query->whereHas('kegiatan', function ($q) {
                $q->where('tanggal', '>=', now()->toDateString())
                  ->where('status', 'published');
            });
        } elseif ($this->filter === 'past') {
            $query->whereHas('kegiatan', function ($q) {
                $q->where('tanggal', '<', now()->toDateString());
            });
        }

        return $query->paginate(10);
    }

    /**
     * Get status badge info (label + warna)
     */
    public function getStatusBadge(PendaftaranKegiatan $pendaftaran): array
    {
        $status = $pendaftaran->status;
        $absensi = $pendaftaran->absensi;

        if ($absensi) {
            return match ($absensi->status_kehadiran) {
                'hadir' => ['label' => 'Hadir', 'color' => 'green'],
                'sakit' => ['label' => 'Sakit', 'color' => 'yellow'],
                'izin' => ['label' => 'Izin', 'color' => 'blue'],
                'alpha' => ['label' => 'Alpha', 'color' => 'red'],
                default => ['label' => ucfirst($absensi->status_kehadiran), 'color' => 'gray'],
            };
        }

        return match ($status) {
            'terdaftar' => ['label' => 'Terdaftar', 'color' => 'blue'],
            'dibatalkan' => ['label' => 'Dibatalkan', 'color' => 'red'],
            'menunggu' => ['label' => 'Menunggu Konfirmasi', 'color' => 'yellow'],
            default => ['label' => ucfirst($status), 'color' => 'gray'],
        };
    }

    /**
     * Open inline dropdown untuk deklarasi status kehadiran
     */
    public function toggleInlineStatus(int $pendaftaranId)
    {
        if ($this->expandedPendaftaranId === $pendaftaranId) {
            $this->expandedPendaftaranId = null;
            return;
        }

        $this->expandedPendaftaranId = $pendaftaranId;
        $pendaftaran = PendaftaranKegiatan::find($pendaftaranId);
        
        if ($pendaftaran && $pendaftaran->absensi) {
            $this->statusDeklarasi = $pendaftaran->absensi->status_kehadiran;
            $this->alasanDeklarasi = $pendaftaran->absensi->catatan ?? '';
        } else {
            $this->statusDeklarasi = 'hadir';
            $this->alasanDeklarasi = '';
        }
    }

    /**
     * Submit status kehadiran (create/update absensi record)
     */
    public function submitStatusKehadiran()
    {
        $this->validate([
            'statusDeklarasi' => 'required|in:hadir,sakit,izin',
            'alasanDeklarasi' => 'required_if:statusDeklarasi,sakit,izin|max:255',
        ], [
            'alasanDeklarasi.required_if' => 'Alasan harus diisi jika status bukan Hadir',
        ]);

        if (!$this->expandedPendaftaranId) {
            session()->flash('error', 'Pendaftaran tidak ditemukan');
            return;
        }

        $pendaftaran = PendaftaranKegiatan::find($this->expandedPendaftaranId);
        if (!$pendaftaran || $pendaftaran->anggota_id !== Auth::user()->anggota->id) {
            session()->flash('error', 'Anda tidak berhak mengakses pendaftaran ini');
            return;
        }

        // Create or update absensi record
        Absensi::updateOrCreate(
            ['pendaftaran_id' => $this->expandedPendaftaranId],
            [
                'status_kehadiran' => $this->statusDeklarasi,
                'catatan' => $this->alasanDeklarasi,
            ]
        );

        session()->flash('success', 'Status kehadiran berhasil disimpan');
        $this->expandedPendaftaranId = null;
        $this->dispatch('refreshComponent');
    }

    /**
     * Cek apakah member sudah deklarasi status (ada absensi record)
     */
    public function sudahDeklarasi(PendaftaranKegiatan $pendaftaran): bool
    {
        return $pendaftaran->absensi !== null;
    }

    /**
     * Get warna button berdasarkan status deklarasi
     */
    public function getButtonColor(string $status): string
    {
        return match ($status) {
            'hadir' => 'bg-green-100 text-green-800 hover:bg-green-200 dark:bg-green-900/30 dark:text-green-300',
            'sakit' => 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200 dark:bg-yellow-900/30 dark:text-yellow-300',
            'izin' => 'bg-blue-100 text-blue-800 hover:bg-blue-200 dark:bg-blue-900/30 dark:text-blue-300',
            default => 'bg-slate-100 text-slate-800 hover:bg-slate-200 dark:bg-slate-700 dark:text-slate-300',
        };
    }

    public function render()
    {
        return view('livewire.member.kegiatan-saya', [
            'kegiatanSaya' => $this->getKegiatan(),
        ]);
    }
}
