<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AbsensiExport implements FromCollection, WithHeadings, WithStyles
{
    protected $kegiatanId;

    public function __construct($kegiatanId = null)
    {
        $this->kegiatanId = $kegiatanId;
    }

    /**
     * Ambil data Absensi dengan relasi yang diperlukan
     */
    public function collection()
    {
        $query = Absensi::with(['pendaftaranKegiatan.anggota', 'pendaftaranKegiatan.kegiatan']);

        if ($this->kegiatanId) {
            $query->whereHas('pendaftaranKegiatan', function ($q) {
                $q->where('kegiatan_id', $this->kegiatanId);
            });
        }

        return $query->get()->map(function ($absensi) {
            return [
                'Kegiatan' => $absensi->pendaftaranKegiatan->kegiatan->nama_kegiatan ?? '-',
                'Anggota' => $absensi->pendaftaranKegiatan->anggota->nama ?? '-',
                'Status Kehadiran' => ucfirst($absensi->status_kehadiran),
                'Catatan' => $absensi->catatan ?? '-',
                'Tanggal Dibuat' => $absensi->created_at->format('d-m-Y H:i'),
            ];
        });
    }

    /**
     * Header kolom
     */
    public function headings(): array
    {
        return [
            'Kegiatan',
            'Anggota',
            'Status Kehadiran',
            'Catatan',
            'Tanggal Dibuat',
        ];
    }

    /**
     * Style header row
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => ['rgb' => '4472C4'],
                ],
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'center',
                ],
            ],
        ];
    }
}
