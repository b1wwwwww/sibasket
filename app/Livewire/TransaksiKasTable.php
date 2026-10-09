<?php

namespace App\Livewire;

use App\Models\TransaksiKas;
use Livewire\Component;
use Livewire\WithPagination;

class TransaksiKasTable extends Component
{
    use WithPagination;

    public $search = '';
    public $jenis = '';
    public $status = '';
    public $perPage = 10;

    protected $queryString = ['search', 'jenis', 'status', 'page'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingJenis()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $transaksi = TransaksiKas::find($id);
        if ($transaksi) {
            $transaksi->delete();
            $this->dispatch('notify', message: 'Transaksi berhasil dihapus');
        }
    }

    public function render()
    {
        $query = TransaksiKas::with('anggota')->query();

        if ($this->search) {
            $query->whereHas('anggota', function ($q) {
                $q->where('nama', 'like', '%' . $this->search . '%');
            })
            ->orWhere('kategori', 'like', '%' . $this->search . '%')
            ->orWhere('keterangan', 'like', '%' . $this->search . '%');
        }

        if ($this->jenis) {
            $query->where('jenis', $this->jenis);
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        $transaksi = $query->orderBy('tanggal_bayar', 'desc')->paginate($this->perPage);

        return view('livewire.transaksi-kas-table', [
            'transaksi' => $transaksi,
        ]);
    }
}
