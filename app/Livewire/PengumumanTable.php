<?php

namespace App\Livewire;

use App\Models\Pengumuman;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class PengumumanTable extends Component
{
    use WithPagination;

    public $search = '';
    public $kategori = '';
    public $status = '';
    public $perPage = 10;
    public $selectAll = false;
    public $selected = [];

    protected $queryString = ['search', 'kategori', 'status', 'page'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingKategori()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function toggleSelectAll()
    {
        if ($this->selectAll) {
            $this->selected = $this->getFilteredIds();
        } else {
            $this->selected = [];
        }
    }

    public function toggleSelect($id)
    {
        if (in_array($id, $this->selected)) {
            $this->selected = array_diff($this->selected, [$id]);
            $this->selectAll = false;
        } else {
            $this->selected[] = $id;
        }
    }

    public function getFilteredIds()
    {
        $query = Pengumuman::query();

        if ($this->search) {
            $query->where('judul', 'like', '%' . $this->search . '%')
                  ->orWhere('isi', 'like', '%' . $this->search . '%');
        }

        if ($this->kategori) {
            $query->where('kategori', $this->kategori);
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        return $query->pluck('id')->toArray();
    }

    public function bulkDelete()
    {
        if (empty($this->selected)) {
            $this->dispatch('notify', message: 'Pilih pengumuman terlebih dahulu');
            return;
        }

        foreach ($this->selected as $id) {
            $pengumuman = Pengumuman::find($id);
            if ($pengumuman) {
                if ($pengumuman->foto && Storage::disk('public')->exists($pengumuman->foto)) {
                    Storage::disk('public')->delete($pengumuman->foto);
                }
                $pengumuman->delete();
            }
        }

        $this->selected = [];
        $this->selectAll = false;
        $this->dispatch('notify', message: count($this->selected) . ' pengumuman berhasil dihapus');
    }

    public function bulkPublish()
    {
        if (empty($this->selected)) {
            $this->dispatch('notify', message: 'Pilih pengumuman terlebih dahulu');
            return;
        }

        Pengumuman::whereIn('id', $this->selected)->update(['status' => 'published']);
        
        $this->selected = [];
        $this->selectAll = false;
        $this->dispatch('notify', message: 'Pengumuman berhasil dipublikasi');
    }

    public function bulkUnpublish()
    {
        if (empty($this->selected)) {
            $this->dispatch('notify', message: 'Pilih pengumuman terlebih dahulu');
            return;
        }

        Pengumuman::whereIn('id', $this->selected)->update(['status' => 'draft']);
        
        $this->selected = [];
        $this->selectAll = false;
        $this->dispatch('notify', message: 'Pengumuman berhasil di-unpublish');
    }

    public function delete($id)
    {
        $pengumuman = Pengumuman::find($id);
        if ($pengumuman) {
            // Hapus foto jika ada
            if ($pengumuman->foto && Storage::disk('public')->exists($pengumuman->foto)) {
                Storage::disk('public')->delete($pengumuman->foto);
            }
            $pengumuman->delete();
            $this->dispatch('notify', message: 'Pengumuman berhasil dihapus');
        }
    }

    public function togglePin($id)
    {
        $pengumuman = Pengumuman::find($id);
        if ($pengumuman) {
            $pengumuman->update(['is_pinned' => !$pengumuman->is_pinned]);
            $message = $pengumuman->is_pinned ? 'Pengumuman di-pin ke atas' : 'Pengumuman tidak di-pin lagi';
            $this->dispatch('notify', message: $message);
        }
    }

    public function render()
    {
        $query = Pengumuman::query();

        if ($this->search) {
            $query->where('judul', 'like', '%' . $this->search . '%')
                  ->orWhere('isi', 'like', '%' . $this->search . '%');
        }

        if ($this->kategori) {
            $query->where('kategori', $this->kategori);
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        $pengumuman = $query->orderBy('is_pinned', 'desc')
                            ->orderBy('tanggal_publish', 'desc')
                            ->paginate($this->perPage);

        return view('livewire.pengumuman-table', [
            'pengumuman' => $pengumuman,
        ]);
    }
}
