<?php

namespace App\Livewire;

use App\Models\Kegiatan;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class KegiatanForm extends Component
{
    use WithFileUploads;

    public $kegiatan_id = null;
    public $judul = '';
    public $deskripsi = '';
    public $tanggal = '';
    public $tanggal_selesai = '';
    public $lokasi = '';
    public $kuota = '';
    public $kategori = '';
    public $foto = null;
    public $foto_path = '';
    public $status = 'draft';

    protected $rules = [
        'judul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'tanggal' => 'required|date_format:Y-m-d\\TH:i',
        'tanggal_selesai' => 'nullable|date_format:Y-m-d\\TH:i|after_or_equal:tanggal',
        'lokasi' => 'required|string|max:255',
        'kuota' => 'nullable|integer|min:1',
        'kategori' => 'nullable|string|max:255',
        'foto' => 'nullable|image|max:2048',
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
            $this->tanggal_selesai = $kegiatan->tanggal_selesai?->format('Y-m-d\TH:i');
            $this->lokasi = $kegiatan->lokasi;
            $this->kuota = $kegiatan->kuota;
            $this->kategori = $kegiatan->kategori;
            $this->foto_path = $kegiatan->foto;
            $this->status = $kegiatan->status;
        }
    }

    public function save()
    {
        $this->validate();

        $fotoPath = $this->foto_path;

        // Handle file upload jika ada foto baru
        if ($this->foto) {
            // Hapus foto lama jika ada
            if ($this->foto_path && \Storage::disk('public')->exists($this->foto_path)) {
                \Storage::disk('public')->delete($this->foto_path);
            }

            // Simpan foto baru ke storage/app/public/kegiatan/
            $fotoPath = $this->foto->store('kegiatan', 'public');
        }

        if ($this->kegiatan_id) {
            // Update
            $kegiatan = Kegiatan::findOrFail($this->kegiatan_id);
            $kegiatan->update([
                'judul' => $this->judul,
                'deskripsi' => $this->deskripsi,
                'tanggal' => $this->tanggal,
                'tanggal_selesai' => $this->tanggal_selesai ?: null,
                'lokasi' => $this->lokasi,
                'kuota' => $this->kuota ?: null,
                'kategori' => $this->kategori ?: null,
                'foto' => $fotoPath ?: null,
                'status' => $this->status,
            ]);
            $this->dispatch('notify', message: 'Kegiatan berhasil diupdate');
        } else {
            // Create
            Kegiatan::create([
                'judul' => $this->judul,
                'deskripsi' => $this->deskripsi,
                'tanggal' => $this->tanggal,
                'tanggal_selesai' => $this->tanggal_selesai ?: null,
                'lokasi' => $this->lokasi,
                'kuota' => $this->kuota ?: null,
                'kategori' => $this->kategori ?: null,
                'foto' => $fotoPath ?: null,
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
