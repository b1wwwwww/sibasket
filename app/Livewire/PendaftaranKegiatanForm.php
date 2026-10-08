<?php

namespace App\Livewire;

use App\Models\Kegiatan;
use App\Models\PendaftaranKegiatan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PendaftaranKegiatanForm extends Component
{
    public Kegiatan $kegiatan;

    public function mount(Kegiatan $kegiatan)
    {
        $this->kegiatan = $kegiatan;
    }

    public function daftar()
    {
        $user = Auth::user();
        $anggota = $user->anggota;

        if (!$anggota) {
            session()->flash('error', 'Akun Anda belum terhubung dengan data Anggota.');
            return;
        }

        if (!$this->kegiatan->isMenerimaPendaftaran()) {
            session()->flash('error', 'Kegiatan ini sudah tidak menerima pendaftaran.');
            return;
        }

        if ($this->kegiatan->isKuotaPenuh()) {
            session()->flash('error', 'Maaf, kuota kegiatan ini sudah penuh.');
            return;
        }

        // Cek apakah sudah terdaftar
        $existing = PendaftaranKegiatan::where('anggota_id', $anggota->id)
            ->where('kegiatan_id', $this->kegiatan->id)
            ->first();

        if ($existing) {
            if ($existing->status === 'dibatalkan') {
                $existing->update(['status' => 'terdaftar']);
                session()->flash('message', 'Pendaftaran berhasil diaktifkan kembali.');
                return;
            }
            session()->flash('error', 'Anda sudah terdaftar di kegiatan ini.');
            return;
        }

        PendaftaranKegiatan::create([
            'anggota_id' => $anggota->id,
            'kegiatan_id' => $this->kegiatan->id,
            'status' => 'terdaftar',
        ]);

        session()->flash('message', 'Berhasil mendaftar ke kegiatan.');
    }

    public function batalkan()
    {
        $user = Auth::user();
        $anggota = $user->anggota;

        $pendaftaran = PendaftaranKegiatan::where('anggota_id', $anggota->id)
            ->where('kegiatan_id', $this->kegiatan->id)
            ->first();

        if ($pendaftaran && $pendaftaran->status === 'terdaftar') {
            $pendaftaran->update(['status' => 'dibatalkan']);
            session()->flash('message', 'Pendaftaran berhasil dibatalkan.');
        }
    }

    public function render()
    {
        $user = Auth::user();
        $anggota = $user->anggota ?? null;
        $pendaftaran = $anggota ? PendaftaranKegiatan::where('anggota_id', $anggota->id)
            ->where('kegiatan_id', $this->kegiatan->id)
            ->first() : null;

        return view('livewire.pendaftaran-kegiatan-form', [
            'pendaftaran' => $pendaftaran,
        ]);
    }
}
