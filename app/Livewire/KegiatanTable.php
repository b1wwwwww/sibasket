<?php

namespace App\Livewire;

use App\Models\Kegiatan;
use Livewire\Component;
use Livewire\WithPagination;

class KegiatanTable extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $kategori = '';
    public $perPage = 10;

    protected $queryString = ['search', 'status', 'kategori', 'page'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function updatingKategori()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $kegiatan = Kegiatan::find($id);
        if ($kegiatan) {
            $kegiatan->delete();
            $this->dispatch('notify', message: 'Kegiatan berhasil dihapus');
        }
    }

    public function render()
    {
        $query = Kegiatan::query();

        if ($this->search) {
            $query->where('judul', 'like', '%' . $this->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $this->search . '%')
                  ->orWhere('lokasi', 'like', '%' . $this->search . '%');
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        if ($this->kategori) {
            $query->where('kategori', $this->kategori);
        }

        $kegiatan = $query->orderBy('tanggal', 'desc')->paginate($this->perPage);

        return view('livewire.kegiatan-table', [
            'kegiatan' => $kegiatan,
        ]);
    }
}
