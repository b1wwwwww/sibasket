<?php

namespace App\Livewire;

use App\Models\Pengumuman;
use Livewire\Component;
use Livewire\WithPagination;

class PengumumanTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    protected $queryString = ['search', 'page'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $pengumuman = Pengumuman::find($id);
        if ($pengumuman) {
            $pengumuman->delete();
            $this->dispatch('notify', message: 'Pengumuman berhasil dihapus');
        }
    }

    public function render()
    {
        $query = Pengumuman::query();

        if ($this->search) {
            $query->where('judul', 'like', '%' . $this->search . '%')
                  ->orWhere('isi', 'like', '%' . $this->search . '%');
        }

        $pengumuman = $query->orderBy('tanggal_publish', 'desc')
                            ->paginate($this->perPage);

        return view('livewire.pengumuman-table', [
            'pengumuman' => $pengumuman,
        ]);
    }
}
