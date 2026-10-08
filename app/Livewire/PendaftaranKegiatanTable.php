<?php

namespace App\Livewire;

use App\Models\PendaftaranKegiatan;
use App\Models\Kegiatan;
use Livewire\Component;
use Livewire\WithPagination;

class PendaftaranKegiatanTable extends Component
{
    use WithPagination;

    public $kegiatanId;
    public $search = '';
    public $status = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => ''],
    ];

    public function mount($kegiatanId = null)
    {
        $this->kegiatanId = $kegiatanId;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updateStatus($id, $newStatus)
    {
        $pendaftaran = PendaftaranKegiatan::findOrFail($id);
        $pendaftaran->update(['status' => $newStatus]);
        
        session()->flash('message', 'Status pendaftaran berhasil diperbarui.');
    }

    public function deletePendaftaran($id)
    {
        PendaftaranKegiatan::findOrFail($id)->delete();
        session()->flash('message', 'Pendaftaran berhasil dihapus.');
    }

    public function render()
    {
        $query = PendaftaranKegiatan::with(['anggota', 'kegiatan'])
            ->when($this->kegiatanId, fn($q) => $q->where('kegiatan_id', $this->kegiatanId))
            ->when($this->search, function($q) {
                $q->whereHas('anggota', fn($query) => 
                    $query->where('nama', 'like', '%' . $this->search . '%')
                          ->orWhere('nis', 'like', '%' . $this->search . '%')
                );
            })
            ->when($this->status, fn($q) => $q->where('status', $this->status));

        $kegiatan = $this->kegiatanId ? Kegiatan::find($this->kegiatanId) : null;

        return view('livewire.pendaftaran-kegiatan-table', [
            'pendaftarans' => $query->latest()->paginate(10),
            'kegiatan' => $kegiatan,
        ]);
    }
}
