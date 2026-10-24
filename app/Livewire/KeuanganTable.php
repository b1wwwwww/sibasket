<?php

namespace App\Livewire;

use App\Models\KasKegiatan;
use App\Models\KasAnggota;
use App\Models\Kegiatan;
use App\Models\PengeluaranOperasional;
use App\Models\Absensi;
use Livewire\Component;
use Livewire\WithPagination;

class KeuanganTable extends Component
{
    use WithPagination;

    // Section 1: Kas Anggota
    public $selectedKegiatanId = null;
    public $searchKasAnggota = '';

    // Section 2: Pengeluaran
    public $showPengeluaranForm = false;
    public $pengeluaranId = null;
    public $tanggalPengeluaran;
    public $kategoriPengeluaran = 'lainnya';
    public $nominalPengeluaran;
    public $keteranganPengeluaran;
    public $notePengeluaran;

    public function mount()
    {
        // Default: pilih kegiatan latihan terakhir (jika ada)
        $latestLatihan = Kegiatan::where('kategori', 'latihan')
            ->orderBy('tanggal', 'desc')
            ->first();

        if ($latestLatihan) {
            $this->selectedKegiatanId = $latestLatihan->id;
        }

        $this->tanggalPengeluaran = now()->format('Y-m-d');
    }

    /**
     * Toggle status bayar kas anggota
     */
    public function toggleBayar($kasAnggotaId)
    {
        $kasAnggota = KasAnggota::findOrFail($kasAnggotaId);

        if ($kasAnggota->status_bayar === 'belum_bayar') {
            $kasAnggota->update([
                'status_bayar' => 'sudah_bayar',
                'tanggal_bayar' => now(),
            ]);
            session()->flash('success', 'Status bayar berhasil diupdate!');
        } else {
            $kasAnggota->update([
                'status_bayar' => 'belum_bayar',
                'tanggal_bayar' => null,
            ]);
            session()->flash('success', 'Status bayar berhasil direset!');
        }
    }

    /**
     * Show form tambah pengeluaran
     */
    public function tambahPengeluaran()
    {
        $this->reset(['pengeluaranId', 'tanggalPengeluaran', 'kategoriPengeluaran', 'nominalPengeluaran', 'keteranganPengeluaran', 'notePengeluaran']);
        $this->tanggalPengeluaran = now()->format('Y-m-d');
        $this->showPengeluaranForm = true;
    }

    /**
     * Edit pengeluaran
     */
    public function editPengeluaran($id)
    {
        $pengeluaran = PengeluaranOperasional::findOrFail($id);
        $this->pengeluaranId = $pengeluaran->id;
        $this->tanggalPengeluaran = $pengeluaran->tanggal->format('Y-m-d');
        $this->kategoriPengeluaran = $pengeluaran->kategori;
        $this->nominalPengeluaran = $pengeluaran->nominal;
        $this->keteranganPengeluaran = $pengeluaran->keterangan;
        $this->notePengeluaran = $pengeluaran->note;
        $this->showPengeluaranForm = true;
    }

    /**
     * Simpan pengeluaran (create/update)
     */
    public function simpanPengeluaran()
    {
        $this->validate([
            'tanggalPengeluaran' => 'required|date',
            'kategoriPengeluaran' => 'required|in:booking_lapang,beli_barang,bantu_teman,lainnya',
            'nominalPengeluaran' => 'required|integer|min:1',
            'keteranganPengeluaran' => 'nullable|string|max:500',
            'notePengeluaran' => 'nullable|string|max:500',
        ], [
            'tanggalPengeluaran.required' => 'Tanggal wajib diisi.',
            'kategoriPengeluaran.required' => 'Kategori wajib dipilih.',
            'nominalPengeluaran.required' => 'Nominal wajib diisi.',
            'nominalPengeluaran.min' => 'Nominal minimal Rp 1.',
        ]);

        if ($this->pengeluaranId) {
            // Update
            $pengeluaran = PengeluaranOperasional::findOrFail($this->pengeluaranId);
            $pengeluaran->update([
                'tanggal' => $this->tanggalPengeluaran,
                'kategori' => $this->kategoriPengeluaran,
                'nominal' => $this->nominalPengeluaran,
                'keterangan' => $this->keteranganPengeluaran,
                'note' => $this->notePengeluaran,
            ]);
            session()->flash('success', 'Pengeluaran berhasil diupdate!');
        } else {
            // Create
            PengeluaranOperasional::create([
                'tanggal' => $this->tanggalPengeluaran,
                'kategori' => $this->kategoriPengeluaran,
                'nominal' => $this->nominalPengeluaran,
                'keterangan' => $this->keteranganPengeluaran,
                'note' => $this->notePengeluaran,
            ]);
            session()->flash('success', 'Pengeluaran berhasil ditambahkan!');
        }

        $this->showPengeluaranForm = false;
        $this->reset(['pengeluaranId', 'tanggalPengeluaran', 'kategoriPengeluaran', 'nominalPengeluaran', 'keteranganPengeluaran', 'notePengeluaran']);
    }

    /**
     * Hapus pengeluaran
     */
    public function hapusPengeluaran($id)
    {
        PengeluaranOperasional::findOrFail($id)->delete();
        session()->flash('success', 'Pengeluaran berhasil dihapus!');
    }

    /**
     * Cancel form pengeluaran
     */
    public function cancelPengeluaran()
    {
        $this->showPengeluaranForm = false;
        $this->reset(['pengeluaranId', 'tanggalPengeluaran', 'kategoriPengeluaran', 'nominalPengeluaran', 'keteranganPengeluaran', 'notePengeluaran']);
    }

    public function render()
    {
        // Kegiatan latihan untuk dropdown
        $kegiatanLatihan = Kegiatan::where('kategori', 'latihan')
            ->orderBy('tanggal', 'desc')
            ->get();

        // Kas Anggota jika kegiatan dipilih
        $kasAnggotaList = [];
        $kasKegiatan = null;
        if ($this->selectedKegiatanId) {
            $kasKegiatan = KasKegiatan::where('kegiatan_id', $this->selectedKegiatanId)->first();

            if ($kasKegiatan) {
                $kasAnggotaList = $kasKegiatan->kasAnggota()
                    ->with('anggota')
                    ->when($this->searchKasAnggota, function ($query) {
                        $query->whereHas('anggota', function ($q) {
                            $q->where('nama', 'like', '%' . $this->searchKasAnggota . '%');
                        });
                    })
                    ->get();
            }
        }

        // Pengeluaran operasional (paginated)
        $pengeluaranList = PengeluaranOperasional::orderBy('tanggal', 'desc')
            ->paginate(10);

        // Ringkasan real-time
        $totalKasTerkumpul = KasAnggota::where('status_bayar', 'sudah_bayar')
            ->join('kas_kegiatan', 'kas_anggota.kas_kegiatan_id', '=', 'kas_kegiatan.id')
            ->sum('kas_kegiatan.nominal_kas');

        $totalKasBelum = KasAnggota::where('status_bayar', 'belum_bayar')
            ->join('kas_kegiatan', 'kas_anggota.kas_kegiatan_id', '=', 'kas_kegiatan.id')
            ->sum('kas_kegiatan.nominal_kas');

        $totalPengeluaran = PengeluaranOperasional::sum('nominal');
        $saldoBersih = $totalKasTerkumpul - $totalPengeluaran;

        return view('livewire.keuangan-table', [
            'kegiatanLatihan' => $kegiatanLatihan,
            'kasKegiatan' => $kasKegiatan,
            'kasAnggotaList' => $kasAnggotaList,
            'pengeluaranList' => $pengeluaranList,
            'totalKasTerkumpul' => $totalKasTerkumpul,
            'totalKasBelum' => $totalKasBelum,
            'totalPengeluaran' => $totalPengeluaran,
            'saldoBersih' => $saldoBersih,
        ]);
    }
}
