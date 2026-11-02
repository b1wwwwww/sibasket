<?php

namespace App\Livewire;

use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\JadwalLatihan;
use App\Models\PendaftaranKegiatan;
use App\Models\Absensi;
use App\Models\KasAnggota;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MemberDashboard extends Component
{
    public $anggota;
    public $jadwalMingguIni = [];
    public $statusAnggota;
    public $terdaftarCount;
    public $totalJadwal;
    public $persentaseKehadiran;
    public $cicilanKas;
    public $totalCicilan;

    public function mount()
    {
        // SECURITY: Hanya member yang sudah login bisa akses
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // SECURITY: Cek apakah user punya role 'member'
        if (!$user->hasRole('member')) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak');
        }

        // Load anggota data dari user
        $this->anggota = $user->anggota;

        // BUG FIX: Jika user tidak memiliki anggota profile, redirect
        if (!$this->anggota) {
            return redirect()->route('dashboard')->with('error', 'Profil anggota tidak ditemukan');
        }

        // Load jadwal latihan untuk minggu ini
        $this->loadJadwalMingguIni();

        // Load status dan metrics
        $this->loadMetrics();
    }

    private function loadJadwalMingguIni()
    {
        // Ambil jadwal latihan yang aktif, diurutkan berdasarkan hari (Selasa, Jumat, Sabtu)
        $jadwalAktif = JadwalLatihan::aktif()->get();

        // Map hari ke urutan (Selasa=0, Jumat=1, Sabtu=2)
        $hariMap = ['selasa' => 0, 'jumat' => 1, 'sabtu' => 2];

        $jadwalMingguIni = [];

        foreach ($jadwalAktif as $jadwal) {
            // Cari kegiatan yang sesuai dengan jadwal ini (tanggal hari ini atau besok)
            // BUG FIX: Filter kegiatan hanya yang status 'published' (bukan cancelled)
            $kegiatan = Kegiatan::where('jadwal_latihan_id', $jadwal->id)
                ->where('status', 'published')
                ->whereDate('tanggal', '>=', Carbon::now()->toDateString())
                ->orderBy('tanggal', 'asc')
                ->first();

            if ($kegiatan) {
                // Cek apakah anggota sudah daftar ke kegiatan ini
                $sudahDaftar = PendaftaranKegiatan::where('anggota_id', $this->anggota->id)
                    ->where('kegiatan_id', $kegiatan->id)
                    ->exists();

                // Cek apakah kegiatan sudah dibatalkan
                $dibatalkan = $kegiatan->status === 'cancelled';

                // BUG FIX: Cek kuota kegiatan
                $kuotaPenuh = $kegiatan->isKuotaPenuh();

                // BUG FIX: Cek apakah anggota aktif (hanya aktif yang bisa daftar)
                $anggotaAktif = $this->anggota->isAktif();

                $jadwalMingguIni[] = [
                    'jadwal' => $jadwal,
                    'kegiatan' => $kegiatan,
                    'sudah_daftar' => $sudahDaftar,
                    'dibatalkan' => $dibatalkan,
                    'kuota_penuh' => $kuotaPenuh,
                    'bisa_daftar' => !$sudahDaftar && !$dibatalkan && !$kuotaPenuh && $anggotaAktif && $kegiatan->isMenerimaPendaftaran(),
                ];
            }
        }

        $this->jadwalMingguIni = $jadwalMingguIni;
    }

    private function loadMetrics()
    {
        // Status anggota
        $this->statusAnggota = $this->anggota->status;

        // Total jadwal latihan (dari JadwalLatihan yang aktif)
        $this->totalJadwal = JadwalLatihan::aktif()->count() ?: 1; // Avoid division by zero

        // Terdaftar count (kegiatan yang published dan belum selesai)
        $this->terdaftarCount = PendaftaranKegiatan::where('anggota_id', $this->anggota->id)
            ->whereHas('kegiatan', function ($q) {
                $q->whereIn('status', ['published', 'ongoing']);
            })
            ->count();

        // Persentase kehadiran
        $totalAbsensi = Absensi::whereHas('pendaftaranKegiatan', function ($q) {
            $q->where('anggota_id', $this->anggota->id);
        })->count();

        $hadirCount = Absensi::whereHas('pendaftaranKegiatan', function ($q) {
            $q->where('anggota_id', $this->anggota->id);
        })
            ->where('status_kehadiran', 'hadir')
            ->count();

        $this->persentaseKehadiran = $totalAbsensi > 0 ? round(($hadirCount / $totalAbsensi) * 100, 0) : 0;

        // Cicilan kas untuk kegiatan bulan ini
        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        $totalCicilanBulanIni = KasAnggota::where('anggota_id', $this->anggota->id)
            ->whereHas('kasKegiatan', function ($q) use ($bulanIni, $tahunIni) {
                $q->whereMonth('created_at', $bulanIni)
                    ->whereYear('created_at', $tahunIni);
            })
            ->count();

        $sudahBayar = KasAnggota::where('anggota_id', $this->anggota->id)
            ->where('status_bayar', 'sudah_bayar')
            ->whereHas('kasKegiatan', function ($q) use ($bulanIni, $tahunIni) {
                $q->whereMonth('created_at', $bulanIni)
                    ->whereYear('created_at', $tahunIni);
            })
            ->count();

        $this->totalCicilan = $totalCicilanBulanIni;
        $this->cicilanKas = $sudahBayar;
    }

    public function daftarKegiatan($kegiatanId)
    {
        // SECURITY: Validasi user masih member
        if (!Auth::user()->hasRole('member')) {
            $this->dispatch('error', 'Anda tidak memiliki akses');
            return;
        }

        // SECURITY: Validasi anggota masih aktif
        if ($this->anggota->status !== 'aktif') {
            $this->dispatch('error', 'Status anggota Anda tidak aktif');
            return;
        }

        // BUG FIX: Validasi kegiatan ada dan valid
        $kegiatan = Kegiatan::findOrFail($kegiatanId);

        if ($kegiatan->status === 'cancelled') {
            $this->dispatch('error', 'Kegiatan ini sudah dibatalkan');
            return;
        }

        if (!$kegiatan->isMenerimaPendaftaran()) {
            $this->dispatch('error', 'Kegiatan ini tidak menerima pendaftaran lagi');
            return;
        }

        // BUG FIX: Cek kuota
        if ($kegiatan->isKuotaPenuh()) {
            $this->dispatch('error', 'Kuota kegiatan sudah penuh');
            return;
        }

        // BUG FIX: Validasi belum daftar sebelumnya
        $sudahDaftar = PendaftaranKegiatan::where('anggota_id', $this->anggota->id)
            ->where('kegiatan_id', $kegiatanId)
            ->exists();

        if ($sudahDaftar) {
            $this->dispatch('error', 'Anda sudah terdaftar di kegiatan ini');
            return;
        }

        // Buat pendaftaran
        try {
            PendaftaranKegiatan::create([
                'anggota_id' => $this->anggota->id,
                'kegiatan_id' => $kegiatanId,
                'status' => 'terdaftar',
            ]);

            $this->dispatch('success', 'Berhasil terdaftar di kegiatan!');
            $this->loadJadwalMingguIni(); // Refresh jadwal
        } catch (\Exception $e) {
            $this->dispatch('error', 'Gagal mendaftar: ' . $e->getMessage());
        }
    }

    public function batalkanPendaftaran($kegiatanId)
    {
        // SECURITY: Validasi user masih member
        if (!Auth::user()->hasRole('member')) {
            $this->dispatch('error', 'Anda tidak memiliki akses');
            return;
        }

        try {
            $pendaftaran = PendaftaranKegiatan::where('anggota_id', $this->anggota->id)
                ->where('kegiatan_id', $kegiatanId)
                ->firstOrFail();

            // Cek kegiatan apakah sudah ongoing/completed
            if (in_array($pendaftaran->kegiatan->status, ['ongoing', 'completed'])) {
                $this->dispatch('error', 'Tidak bisa membatalkan pendaftaran kegiatan yang sedang/sudah berlangsung');
                return;
            }

            $pendaftaran->delete();
            $this->dispatch('success', 'Pendaftaran dibatalkan');
            $this->loadJadwalMingguIni();
        } catch (\Exception $e) {
            $this->dispatch('error', 'Gagal membatalkan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.member-dashboard', [
            'jadwalMingguIni' => $this->jadwalMingguIni,
            'statusAnggota' => $this->statusAnggota,
            'terdaftarCount' => $this->terdaftarCount,
            'totalJadwal' => $this->totalJadwal,
            'persentaseKehadiran' => $this->persentaseKehadiran,
            'cicilanKas' => $this->cicilanKas,
            'totalCicilan' => $this->totalCicilan,
            'anggota' => $this->anggota,
        ]);
    }
}
