<?php

namespace App\Exports;

use App\Models\TransaksiKas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KeuanganExport implements FromCollection, WithHeadings, WithStyles
{
    protected $jenis;
    protected $startDate;
    protected $endDate;

    public function __construct($jenis = null, $startDate = null, $endDate = null)
    {
        $this->jenis = $jenis;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * Ambil data Transaksi Kas dengan filter
     */
    public function collection()
    {
        $query = TransaksiKas::with('anggota');

        if ($this->jenis) {
            $query->where('jenis', $this->jenis);
        }

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('tanggal_bayar', [$this->startDate, $this->endDate]);
        }

        return $query->get()->map(function ($transaksi) {
            return [
                'Tanggal' => $transaksi->tanggal_bayar->format('d-m-Y'),
                'Anggota' => $transaksi->anggota->nama ?? '-',
                'Jenis' => ucfirst($transaksi->jenis),
                'Kategori' => ucfirst($transaksi->kategori),
                'Nominal' => 'Rp ' . number_format($transaksi->nominal, 0, ',', '.'),
                'Status' => ucfirst($transaksi->status),
                'Keterangan' => $transaksi->keterangan ?? '-',
            ];
        });
    }

    /**
     * Header kolom
     */
    public function headings(): array
    {
        return [
            'Tanggal',
            'Anggota',
            'Jenis',
            'Kategori',
            'Nominal',
            'Status',
            'Keterangan',
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
                    'startColor' => ['rgb' => '70AD47'],
                ],
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'center',
                ],
            ],
        ];
    }
}
