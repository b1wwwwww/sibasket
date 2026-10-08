<?php

namespace App\Livewire;

use App\Models\Absensi;
use App\Models\Kegiatan;
use App\Models\PendaftaranKegiatan;
use Livewire\Component;
use Livewire\WithPagination;

class AbsensiTable extends Component
{
    use WithPagination;

    public $kegiatanId;
    public $search = '';
    public $statusKehadiran = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'statusKehadiran' => ['except' => ''],
    ];

    public function mount($kegiatanId = null)
    {
        $this->kegiatanId = $kegiatanId;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updateStatusKehadiran($pendaftaranId, $newStatus)
    {
        $absensi = Absensi::where('pendaftaran_id', $pendaftaranId)->firstOrCreate(
            ['pendaftaran_id' => $pendaftaranId],
            ['status_kehadiran' => 'tidak_hadir']
        );

        $absensi->update(['status_kehadiran' => $newStatus]);
        session()->flash('message', 'Status kehadiran berhasil diperbarui.');
    }

    public function updateCatatan($pendaftaranId, $catatan)
    {
        $absensi = Absensi::where('pendaftaran_id', $pendaftaranId)->firstOrCreate(
            ['pendaftaran_id' => $pendaftaranId],
            ['status_kehadiran' => 'tidak_hadir']
        );

        $absensi->update(['catatan' => $catatan]);
        session()->flash('message', 'Catatan berhasil disimpan.');
    }

    public function render()
    {
        $query = PendaftaranKegiatan::with(['anggota', 'kegiatan', 'absensi'])
            ->when($this->kegiatanId, fn($q) => $q->where('kegiatan_id', $this->kegiatanId))
            ->where('status', 'terdaftar')
            ->when($this->search, function($q) {
                $q->whereHas('anggota', fn($query) => 
                    $query->where('nama', 'like', '%' . $this->search . '%')
                          ->orWhere('nis', 'like', '%' . $this->search . '%')
                );
            })
            ->when($this->statusKehadiran, function($q) {
                $q->whereHas('absensi', fn($query) => 
                    $query->where('status_kehadiran', $this->statusKehadiran)
                );
            });

        $kegiatan = $this->kegiatanId ? Kegiatan::find($this->kegiatanId) : null;

        return view('livewire.absensi-table', [
            'pendaftarans' => $query->latest()->paginate(15),
            'kegiatan' => $kegiatan,
        ]);
    }
}
