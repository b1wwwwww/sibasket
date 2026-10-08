<?php

namespace App\Livewire;

use App\Models\Kegiatan;
use Livewire\Component;

class KegiatanForm extends Component
{
    public $kegiatan_id = null;
    public $judul = '';
    public $deskripsi = '';
    public $tanggal = '';
    public $lokasi = '';
    public $kuota = '';
    public $status = 'draft';

    protected $rules = [
        'judul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'tanggal' => 'required|date_format:Y-m-d\TH:i',
        'lokasi' => 'required|string|max:255',
        'kuota' => 'nullable|integer|min:1',
        'status' => 'required|in:draft,published,ongoing,completed,cancelled',
    ];

    public function mount($kegiatan_id = null)
    {
        if ($kegiatan_id) {
            $kegiatan = Kegiatan::findOrFail($kegiatan_id);
            $this->kegiatan_id = $kegiatan_id;
            $this->judul = $kegiatan->judul;
            $this->deskripsi = $kegiatan->deskripsi;
            $this->tanggal = $kegiatan->tanggal?->format('Y-m-d\TH:i');
            $this->lokasi = $kegiatan->lokasi;
            $this->kuota = $kegiatan->kuota;
            $this->status = $kegiatan->status;
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->kegiatan_id) {
            // Update
            $kegiatan = Kegiatan::findOrFail($this->kegiatan_id);
            $kegiatan->update([
                'judul' => $this->judul,
                'deskripsi' => $this->deskripsi,
                'tanggal' => $this->tanggal,
                'lokasi' => $this->lokasi,
                'kuota' => $this->kuota ?: null,
                'status' => $this->status,
            ]);
            $this->dispatch('notify', message: 'Kegiatan berhasil diupdate');
        } else {
            // Create
            Kegiatan::create([
                'judul' => $this->judul,
                'deskripsi' => $this->deskripsi,
                'tanggal' => $this->tanggal,
                'lokasi' => $this->lokasi,
                'kuota' => $this->kuota ?: null,
                'status' => $this->status,
            ]);
            $this->dispatch('notify', message: 'Kegiatan berhasil ditambahkan');
        }

        return redirect('/dashboard/kegiatan');
    }

    public function render()
    {
        return view('livewire.kegiatan-form');
    }
}
