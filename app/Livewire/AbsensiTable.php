<?php

namespace App\Livewire;

use App\Models\Absensi;
use App\Models\Kegiatan;
use App\Models\PendaftaranKegiatan;
use Livewire\Component;
use Livewire\WithPagination;

class AbsensiTable extends Component
{
    use WithPagination;

    public $kegiatanId;
    public $search = '';
    public $statusKehadiran = '';
    public $tanggalFilter = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'statusKehadiran' => ['except' => ''],
        'tanggalFilter' => ['except' => ''],
        'kegiatanId' => ['except' => ''],
    ];

    public function mount($kegiatanId = null)
    {
        if ($kegiatanId) {
            $this->kegiatanId = $kegiatanId;
        } else {
            // Default ke kegiatan terbaru yang mengandung kata 'latihan' atau kegiatan pertama
            $defaultKegiatan = Kegiatan::where('judul', 'like', '%latihan%')
                ->orderBy('tanggal', 'desc')
                ->first();
                
            if (!$defaultKegiatan) {
                $defaultKegiatan = Kegiatan::orderBy('tanggal', 'desc')->first();
            }
            
            $this->kegiatanId = $defaultKegiatan?->id;
        }
        
        // Set tanggal filter sesuai kegiatan yang dipilih
        $kegiatan = $this->kegiatanId ? Kegiatan::find($this->kegiatanId) : null;
        if ($kegiatan) {
            $this->tanggalFilter = $kegiatan->tanggal->format('Y-m-d');
        } else {
            $this->tanggalFilter = request()->get('tanggal', date('Y-m-d'));
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingTanggalFilter()
    {
        $this->resetPage();
    }

    public function updateStatusKehadiran($pendaftaranId, $newStatus)
    {
        $absensi = Absensi::where('pendaftaran_id', $pendaftaranId)->firstOrCreate(
            ['pendaftaran_id' => $pendaftaranId],
            ['status_kehadiran' => 'tidak_hadir']
        );

        $absensi->update(['status_kehadiran' => $newStatus]);
        session()->flash('message', 'Status kehadiran berhasil diperbarui.');
    }

    public function updateCatatan($pendaftaranId, $catatan)
    {
        $absensi = Absensi::where('pendaftaran_id', $pendaftaranId)->firstOrCreate(
            ['pendaftaran_id' => $pendaftaranId],
            ['status_kehadiran' => 'tidak_hadir']
        );

        $absensi->update(['catatan' => $catatan]);
        session()->flash('message', 'Catatan berhasil disimpan.');
    }

    public function markAllAsHadir()
    {
        $pendaftarans = PendaftaranKegiatan::with(['anggota', 'kegiatan', 'absensi'])
            ->when($this->kegiatanId, fn($q) => $q->where('kegiatan_id', $this->kegiatanId))
            ->when($this->tanggalFilter, function($q) {
                $q->whereHas('kegiatan', fn($query) => 
                    $query->whereDate('tanggal', $this->tanggalFilter)
                );
            })
            ->where('status', 'terdaftar')
            ->get();

        foreach ($pendaftarans as $p) {
            Absensi::where('pendaftaran_id', $p->id)->firstOrCreate(
                ['pendaftaran_id' => $p->id],
                ['status_kehadiran' => 'hadir']
            )->update(['status_kehadiran' => 'hadir']);
        }

        session()->flash('message', count($pendaftarans) . ' anggota berhasil dimark Hadir.');
    }

    public function markAllAsTidakHadir()
    {
        $pendaftarans = PendaftaranKegiatan::with(['anggota', 'kegiatan', 'absensi'])
            ->when($this->kegiatanId, fn($q) => $q->where('kegiatan_id', $this->kegiatanId))
            ->when($this->tanggalFilter, function($q) {
                $q->whereHas('kegiatan', fn($query) => 
                    $query->whereDate('tanggal', $this->tanggalFilter)
                );
            })
            ->where('status', 'terdaftar')
            ->get();

        foreach ($pendaftarans as $p) {
            Absensi::where('pendaftaran_id', $p->id)->firstOrCreate(
                ['pendaftaran_id' => $p->id],
                ['status_kehadiran' => 'tidak_hadir']
            )->update(['status_kehadiran' => 'tidak_hadir']);
        }

        session()->flash('message', count($pendaftarans) . ' anggota berhasil dimark Tidak Hadir.');
    }

    public function resetAll()
    {
        $pendaftarans = PendaftaranKegiatan::with(['anggota', 'kegiatan', 'absensi'])
            ->when($this->kegiatanId, fn($q) => $q->where('kegiatan_id', $this->kegiatanId))
            ->when($this->tanggalFilter, function($q) {
                $q->whereHas('kegiatan', fn($query) => 
                    $query->whereDate('tanggal', $this->tanggalFilter)
                );
            })
            ->where('status', 'terdaftar')
            ->get();

        foreach ($pendaftarans as $p) {
            Absensi::where('pendaftaran_id', $p->id)->delete();
        }

        session()->flash('message', 'Semua absensi berhasil direset.');
    }

    public function render()
    {
        $query = PendaftaranKegiatan::with(['anggota', 'kegiatan', 'absensi'])
            ->when($this->kegiatanId, fn($q) => $q->where('kegiatan_id', $this->kegiatanId))
            ->when($this->tanggalFilter, function($q) {
                $q->whereHas('kegiatan', fn($query) => 
                    $query->whereDate('tanggal', $this->tanggalFilter)
                );
            })
            ->where('status', 'terdaftar')
            ->when($this->search, function($q) {
                $q->whereHas('anggota', fn($query) => 
                    $query->where('nama', 'like', '%' . $this->search . '%')
                          ->orWhere('nis', 'like', '%' . $this->search . '%')
                );
            })
            ->when($this->statusKehadiran, function($q) {
                $q->whereHas('absensi', fn($query) => 
                    $query->where('status_kehadiran', $this->statusKehadiran)
                );
            });

        $kegiatan = $this->kegiatanId ? Kegiatan::find($this->kegiatanId) : null;
        $kegiatanList = Kegiatan::orderBy('tanggal', 'desc')->get();

        return view('livewire.absensi-table', [
            'pendaftarans' => $query->latest()->paginate(15),
            'kegiatan' => $kegiatan,
            'kegiatanList' => $kegiatanList,
        ]);
    }
}
