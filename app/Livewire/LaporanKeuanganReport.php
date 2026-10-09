<?php

namespace App\Livewire;

use App\Models\TransaksiKas;
use Livewire\Component;
use Carbon\Carbon;

class LaporanKeuanganReport extends Component
{
    public $tanggal_dari = '';
    public $tanggal_sampai = '';
    public $kategori = '';

    public function mount()
    {
        // Default: laporan bulan ini
        $this->tanggal_dari = now()->startOfMonth()->format('Y-m-d');
        $this->tanggal_sampai = now()->endOfMonth()->format('Y-m-d');
    }

    public function getReportData()
    {
        $query = TransaksiKas::whereBetween('tanggal_bayar', [$this->tanggal_dari, $this->tanggal_sampai]);

        if ($this->kategori) {
            $query->where('kategori', $this->kategori);
        }

        return $query->orderBy('tanggal_bayar', 'desc')->get();
    }

    public function getSummary()
    {
        $transaksi = $this->getReportData();

        $totalPemasukan = $transaksi->where('jenis', 'pemasukan')->where('status', 'lunas')->sum('nominal');
        $totalPengeluaran = $transaksi->where('jenis', 'pengeluaran')->sum('nominal');
        $saldo = $totalPemasukan - $totalPengeluaran;

        return [
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'saldo' => $saldo,
            'countTransaksi' => $transaksi->count(),
        ];
    }

    public function getKategoriBreakdown()
    {
        $transaksi = $this->getReportData();
        $breakdown = [];

        foreach ($transaksi as $t) {
            if (!isset($breakdown[$t->kategori])) {
                $breakdown[$t->kategori] = [
                    'kategori' => $t->kategori,
                    'pemasukan' => 0,
                    'pengeluaran' => 0,
                ];
            }

            if ($t->jenis === 'pemasukan' && $t->status === 'lunas') {
                $breakdown[$t->kategori]['pemasukan'] += $t->nominal;
            } elseif ($t->jenis === 'pengeluaran') {
                $breakdown[$t->kategori]['pengeluaran'] += $t->nominal;
            }
        }

        return array_values($breakdown);
    }

    public function render()
    {
        $kategoriList = TransaksiKas::distinct()->pluck('kategori')->sort();
        $summary = $this->getSummary();
        $breakdown = $this->getKategoriBreakdown();
        $transaksi = $this->getReportData();

        return view('livewire.laporan-keuangan-report', [
            'kategoriList' => $kategoriList,
            'summary' => $summary,
            'breakdown' => $breakdown,
            'transaksi' => $transaksi,
        ]);
    }
}
