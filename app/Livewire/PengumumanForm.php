<?php

namespace App\Livewire;

use App\Models\Pengumuman;
use Livewire\Component;

class PengumumanForm extends Component
{
    public $pengumuman_id = null;
    public $judul = '';
    public $isi = '';
    public $tanggal_publish = '';

    protected $rules = [
        'judul' => 'required|string|max:255',
        'isi' => 'required|string',
        'tanggal_publish' => 'required|date_format:Y-m-d',
    ];

    protected $messages = [
        'judul.required' => 'Judul pengumuman harus diisi',
        'judul.max' => 'Judul maksimal 255 karakter',
        'isi.required' => 'Isi pengumuman harus diisi',
        'tanggal_publish.required' => 'Tanggal publish harus diisi',
        'tanggal_publish.date_format' => 'Format tanggal harus YYYY-MM-DD',
    ];

    public function mount($pengumuman_id = null)
    {
        if ($pengumuman_id) {
            $pengumuman = Pengumuman::findOrFail($pengumuman_id);
            $this->pengumuman_id = $pengumuman_id;
            $this->judul = $pengumuman->judul;
            $this->isi = $pengumuman->isi;
            $this->tanggal_publish = $pengumuman->tanggal_publish->format('Y-m-d');
        } else {
            $this->tanggal_publish = now()->format('Y-m-d');
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->pengumuman_id) {
            $pengumuman = Pengumuman::findOrFail($this->pengumuman_id);
            $pengumuman->update([
                'judul' => $this->judul,
                'isi' => $this->isi,
                'tanggal_publish' => $this->tanggal_publish,
            ]);
            $message = 'Pengumuman berhasil diperbarui';
        } else {
            Pengumuman::create([
                'judul' => $this->judul,
                'isi' => $this->isi,
                'tanggal_publish' => $this->tanggal_publish,
            ]);
            $message = 'Pengumuman berhasil dibuat';
        }

        $this->dispatch('notify', message: $message);
        return redirect()->route('pengumuman.index');
    }

    public function render()
    {
        return view('livewire.pengumuman-form');
    }
}
