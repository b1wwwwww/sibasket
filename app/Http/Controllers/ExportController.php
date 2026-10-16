<?php

namespace App\Http\Controllers;

use App\Exports\AbsensiExport;
use App\Exports\KeuanganExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ExportController extends Controller
{
    /**
     * Export Keuangan to Excel
     */
    public function keuangan(Request $request)
    {
        Gate::authorize('view keuangan');

        $jenis = $request->query('jenis');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $fileName = 'Laporan-Keuangan-' . now()->format('d-m-Y-His') . '.xlsx';

        return Excel::download(
            new KeuanganExport($jenis, $startDate, $endDate),
            $fileName
        );
    }

    /**
     * Export Absensi to Excel
     */
    public function absensi(Request $request)
    {
        Gate::authorize('view absensi');

        $kegiatanId = $request->query('kegiatan_id');
        $fileName = 'Laporan-Absensi-' . now()->format('d-m-Y-His') . '.xlsx';

        return Excel::download(
            new AbsensiExport($kegiatanId),
            $fileName
        );
    }
}

