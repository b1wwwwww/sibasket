<?php

namespace App\Livewire;

use App\Models\Anggota;
use Livewire\Component;
use Livewire\WithPagination;

class AnggotaTable extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $perPage = 10;

    protected $queryString = ['search', 'status', 'page'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $anggota = Anggota::find($id);
        if ($anggota) {
            $anggota->delete();
            $this->dispatch('notify', message: 'Anggota berhasil dihapus');
        }
    }

    public function render()
    {
        $query = Anggota::query();

        if ($this->search) {
            $query->where('nama', 'like', '%' . $this->search . '%')
                  ->orWhere('nis', 'like', '%' . $this->search . '%')
                  ->orWhere('kelas', 'like', '%' . $this->search . '%');
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        $anggota = $query->paginate($this->perPage);

        return view('livewire.anggota-table', [
            'anggota' => $anggota,
        ]);
    }
}
