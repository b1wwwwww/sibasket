<?php

namespace App\Livewire;

use App\Models\PendaftaranAnggota;
use Livewire\Component;

class PublicPendaftaranForm extends Component
{
    public $nama = '';
    public $nama_panggilan = '';
    public $kelas = '';
    public $jurusan = '';
    public $jenis_kelamin = '';
    public $kontak_siswa = '';
    public $kontak_orang_tua = '';
    public $alamat = '';
    public $pengalaman_basket = '';
    public $alasan_gabung = '';
    public $setuju_peraturan = false;
    public $orang_tua_mengetahui = '';
    public $submitted = false;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'nama_panggilan' => 'required|string|max:100',
        'kelas' => 'required|in:10,11,12',
        'jurusan' => 'required|in:pplg,elektro,bp,tkj,mesin,otomotif,tekstil',
        'jenis_kelamin' => 'required|in:laki-laki,perempuan',
        'kontak_siswa' => 'required|unique:pendaftaran_anggota,kontak_siswa|regex:/^08[0-9]{8,11}$/',
        'kontak_orang_tua' => 'required|regex:/^08[0-9]{8,11}$/',
        'alamat' => 'nullable|string|max:500',
        'pengalaman_basket' => 'required|in:iya,tidak',
        'alasan_gabung' => 'required|string|min:10|max:500',
        'setuju_peraturan' => 'required|accepted',
        'orang_tua_mengetahui' => 'required|in:iya,tidak',
    ];

    protected $messages = [
        'nama.required' => 'Nama lengkap wajib diisi',
        'nama_panggilan.required' => 'Nama panggilan wajib diisi',
        'kelas.required' => 'Kelas wajib dipilih',
        'jurusan.required' => 'Jurusan wajib dipilih',
        'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
        'kontak_siswa.required' => 'Nomor WA wajib diisi',
        'kontak_siswa.unique' => 'Nomor WA sudah terdaftar',
        'kontak_siswa.regex' => 'Format nomor WA tidak valid (08xxxxxxxxx)',
        'kontak_orang_tua.required' => 'Nomor orang tua wajib diisi',
        'pengalaman_basket.required' => 'Pengalaman basket wajib dipilih',
        'alasan_gabung.required' => 'Alasan bergabung wajib diisi',
        'alasan_gabung.min' => 'Alasan bergabung minimal 10 karakter',
        'setuju_peraturan.required' => 'Anda harus setuju dengan peraturan',
        'orang_tua_mengetahui.required' => 'Pilih apakah orang tua mengetahui',
    ];

    public function submit()
    {
        $validated = $this->validate();

        // Buat record di pendaftaran_anggota
        PendaftaranAnggota::create($validated);

        $this->submitted = true;
        $this->reset();
    }

    public function render()
    {
        return view('livewire.public-pendaftaran-form');
    }
}
