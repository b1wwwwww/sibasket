<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\PendaftaranKegiatan;
use App\Models\Absensi;
use App\Models\TransaksiKas;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // === METRICS UNTUK SEMUA USER ===
        $totalAnggota = Anggota::count();
        $kegiatanAktif = Kegiatan::where('status', 'aktif')->count();
        $totalPendaftaran = PendaftaranKegiatan::count();
        $pengumumanTerbaru = Pengumuman::orderBy('tanggal_publish', 'desc')->limit(5)->get();

        // === METRICS PERHITUNGAN KEHADIRAN ===
        $totalAbsensi = Absensi::count();
        $hadirCount = Absensi::where('status_kehadiran', 'hadir')->count();
        $tingkatKehadiran = $totalAbsensi > 0 ? round(($hadirCount / $totalAbsensi) * 100, 2) : 0;

        // === METRICS KEUANGAN ===
        $totalPemasukan = TransaksiKas::where('jenis', 'pemasukan')->sum('nominal');
        $totalPengeluaran = TransaksiKas::where('jenis', 'pengeluaran')->sum('nominal');
        $saldoKas = $totalPemasukan - $totalPengeluaran;

        // === ROLE-SPECIFIC METRICS ===
        $metrics = [
            'total_anggota' => $totalAnggota,
            'kegiatan_aktif' => $kegiatanAktif,
            'total_pendaftaran' => $totalPendaftaran,
            'tingkat_kehadiran' => $tingkatKehadiran,
            'total_pemasukan' => $totalPemasukan,
            'total_pengeluaran' => $totalPengeluaran,
            'saldo_kas' => $saldoKas,
            'pengumuman_terbaru' => $pengumumanTerbaru,
        ];

        // === DASHBOARD SPESIFIK PER ROLE ===
        if ($user->hasRole('super_admin') || $user->hasRole('admin')) {
            // Admin dashboard: full metrics
            $metrics['kegiatan_list'] = Kegiatan::limit(5)->get();
            $metrics['pendaftaran_terbaru'] = PendaftaranKegiatan::with('anggota', 'kegiatan')
                ->limit(5)
                ->orderBy('created_at', 'desc')
                ->get();

            return view('pages.dashboard', [
                'dashboard_type' => 'admin',
                'metrics' => $metrics,
            ]);
        } elseif ($user->hasRole('pembina')) {
            // Pembina dashboard: view-only metrics
            return view('pages.dashboard', [
                'dashboard_type' => 'pembina',
                'metrics' => $metrics,
            ]);
        } elseif ($user->hasRole('member')) {
            // Member dashboard: personal metrics
            $anggota = $user->anggota;
            $myKegiatan = $anggota ? $anggota->pendaftaranKegiatan()->with('kegiatan')->get() : [];
            $myAbsensi = $anggota ? Absensi::whereHas('pendaftaranKegiatan', function ($q) use ($anggota) {
                $q->where('anggota_id', $anggota->id);
            })->count() : 0;

            $metrics['my_kegiatan'] = $myKegiatan;
            $metrics['my_absensi_count'] = $myAbsensi;

            return view('pages.dashboard', [
                'dashboard_type' => 'member',
                'metrics' => $metrics,
            ]);
        }

        // Default: unauthorized
        return abort(403, 'Unauthorized access');
    }
}
