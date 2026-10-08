<?php

namespace App\Livewire;

use App\Models\Anggota;
use App\Models\User;
use Livewire\Component;

class AnggotaForm extends Component
{
    public $anggota_id = null;
    public $user_id = '';
    public $nama = '';
    public $nis = '';
    public $kelas = '';
    public $jurusan = '';
    public $posisi = '';
    public $status = 'aktif';
    public $tanggal_bergabung = '';

    protected $rules = [
        'user_id' => 'required|exists:users,id',
        'nama' => 'required|string|max:255',
        'nis' => 'required|string|max:20|unique:anggota,nis',
        'kelas' => 'required|string|max:10',
        'jurusan' => 'nullable|string|max:255',
        'posisi' => 'required|string|max:255',
        'status' => 'required|in:aktif,nonaktif,cuti',
        'tanggal_bergabung' => 'required|date',
    ];

    public function mount($anggota_id = null)
    {
        if ($anggota_id) {
            $anggota = Anggota::findOrFail($anggota_id);
            $this->anggota_id = $anggota_id;
            $this->user_id = $anggota->user_id;
            $this->nama = $anggota->nama;
            $this->nis = $anggota->nis;
            $this->kelas = $anggota->kelas;
            $this->jurusan = $anggota->jurusan;
            $this->posisi = $anggota->posisi;
            $this->status = $anggota->status;
            $this->tanggal_bergabung = $anggota->tanggal_bergabung?->format('Y-m-d');

            // Update validation rules untuk edit (NIS bisa sama dengan dirinya sendiri)
            $this->rules['nis'] = 'required|string|max:20|unique:anggota,nis,' . $anggota_id;
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->anggota_id) {
            // Update
            $anggota = Anggota::findOrFail($this->anggota_id);
            $anggota->update([
                'user_id' => $this->user_id,
                'nama' => $this->nama,
                'nis' => $this->nis,
                'kelas' => $this->kelas,
                'jurusan' => $this->jurusan,
                'posisi' => $this->posisi,
                'status' => $this->status,
                'tanggal_bergabung' => $this->tanggal_bergabung,
            ]);
            $this->dispatch('notify', message: 'Anggota berhasil diupdate');
        } else {
            // Create
            Anggota::create([
                'user_id' => $this->user_id,
                'nama' => $this->nama,
                'nis' => $this->nis,
                'kelas' => $this->kelas,
                'jurusan' => $this->jurusan,
                'posisi' => $this->posisi,
                'status' => $this->status,
                'tanggal_bergabung' => $this->tanggal_bergabung,
            ]);
            $this->dispatch('notify', message: 'Anggota berhasil ditambahkan');
        }

        return redirect('/dashboard/anggota');
    }

    public function render()
    {
        $users = User::all();
        return view('livewire.anggota-form', [
            'users' => $users,
        ]);
    }
}
