<?php

namespace App\Livewire;

use App\Models\TransaksiKas;
use App\Models\Anggota;
use Livewire\Component;

class TransaksiKasForm extends Component
{
    public $transaksi_id = null;
    public $anggota_id = '';
    public $nominal = '';
    public $jenis = 'pemasukan';
    public $kategori = '';
    public $status = 'pending';
    public $tanggal_bayar = '';
    public $keterangan = '';

    protected $rules = [
        'anggota_id' => 'required|exists:anggota,id',
        'nominal' => 'required|numeric|min:0.01',
        'jenis' => 'required|in:pemasukan,pengeluaran',
        'kategori' => 'required|string|max:255',
        'status' => 'required|in:lunas,nunggak,pending',
        'tanggal_bayar' => 'required|date_format:Y-m-d',
        'keterangan' => 'nullable|string',
    ];

    public function mount($transaksi_id = null)
    {
        if ($transaksi_id) {
            $transaksi = TransaksiKas::findOrFail($transaksi_id);
            $this->transaksi_id = $transaksi_id;
            $this->anggota_id = $transaksi->anggota_id;
            $this->nominal = $transaksi->nominal;
            $this->jenis = $transaksi->jenis;
            $this->kategori = $transaksi->kategori;
            $this->status = $transaksi->status;
            $this->tanggal_bayar = $transaksi->tanggal_bayar->format('Y-m-d');
            $this->keterangan = $transaksi->keterangan;
        } else {
            $this->tanggal_bayar = now()->format('Y-m-d');
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->transaksi_id) {
            // Update
            $transaksi = TransaksiKas::findOrFail($this->transaksi_id);
            $transaksi->update([
                'anggota_id' => $this->anggota_id,
                'nominal' => $this->nominal,
                'jenis' => $this->jenis,
                'kategori' => $this->kategori,
                'status' => $this->status,
                'tanggal_bayar' => $this->tanggal_bayar,
                'keterangan' => $this->keterangan,
            ]);
            $this->dispatch('notify', message: 'Transaksi berhasil diupdate');
        } else {
            // Create
            TransaksiKas::create([
                'anggota_id' => $this->anggota_id,
                'nominal' => $this->nominal,
                'jenis' => $this->jenis,
                'kategori' => $this->kategori,
                'status' => $this->status,
                'tanggal_bayar' => $this->tanggal_bayar,
                'keterangan' => $this->keterangan,
            ]);
            $this->dispatch('notify', message: 'Transaksi berhasil ditambahkan');
        }

        return redirect('/dashboard/keuangan');
    }

    public function render()
    {
        $anggota = Anggota::orderBy('nama')->get();

        return view('livewire.transaksi-kas-form', [
            'anggota' => $anggota,
        ]);
    }
}
