<?php

namespace App\Livewire;

use App\Models\JadwalLatihan;
use Livewire\Component;

class JadwalLatihanTable extends Component
{
    public $hari = '';
    public $jam_mulai = '';
    public $jam_selesai = '';
    public $lokasi = '';
    public $tipe_lokasi = 'outdoor';
    public $aktif = true;
    
    public $jadwalLatihan;
    public $showForm = false;
    public $editingId = null;

    public function mount()
    {
        $this->loadJadwal();
    }

    public function loadJadwal()
    {
        $this->jadwalLatihan = JadwalLatihan::all();
    }

    public function resetForm()
    {
        $this->hari = '';
        $this->jam_mulai = '';
        $this->jam_selesai = '';
        $this->lokasi = '';
        $this->tipe_lokasi = 'outdoor';
        $this->aktif = true;
        $this->editingId = null;
        $this->showForm = false;
    }

    public function save()
    {
        $validated = $this->validate([
            'hari' => 'required|in:selasa,jumat,sabtu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'lokasi' => 'required|string|max:100',
            'tipe_lokasi' => 'required|in:indoor,outdoor',
        ], [
            'hari.required' => 'Hari wajib dipilih',
            'jam_mulai.required' => 'Jam mulai wajib diisi',
            'jam_selesai.required' => 'Jam selesai wajib diisi',
            'jam_selesai.after' => 'Jam selesai harus lebih besar dari jam mulai',
            'lokasi.required' => 'Lokasi wajib diisi',
            'tipe_lokasi.required' => 'Tipe lokasi wajib dipilih',
        ]);

        if ($this->editingId) {
            $jadwal = JadwalLatihan::findOrFail($this->editingId);
            $jadwal->update($validated);
            $this->dispatch('notify', message: 'Jadwal latihan berhasil diupdate');
        } else {
            JadwalLatihan::create($validated);
            $this->dispatch('notify', message: 'Jadwal latihan berhasil ditambahkan');
        }

        $this->loadJadwal();
        $this->resetForm();
    }

    public function edit($id)
    {
        $jadwal = JadwalLatihan::findOrFail($id);
        $this->editingId = $id;
        $this->hari = $jadwal->hari;
        $this->jam_mulai = $jadwal->jam_mulai;
        $this->jam_selesai = $jadwal->jam_selesai;
        $this->lokasi = $jadwal->lokasi;
        $this->tipe_lokasi = $jadwal->tipe_lokasi;
        $this->aktif = $jadwal->aktif;
        $this->showForm = true;
    }

    public function delete($id)
    {
        JadwalLatihan::findOrFail($id)->delete();
        $this->dispatch('notify', message: 'Jadwal latihan berhasil dihapus');
        $this->loadJadwal();
    }

    public function toggleAktif($id)
    {
        $jadwal = JadwalLatihan::findOrFail($id);
        $jadwal->update(['aktif' => !$jadwal->aktif]);
        $this->dispatch('notify', message: 'Status jadwal latihan berhasil diupdate');
        $this->loadJadwal();
    }

    public function render()
    {
        return view('livewire.jadwal-latihan-table');
    }
}
