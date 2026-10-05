<?php 

namespace App\Filament\Widgets;

use App\Models\TransaksiKas;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class KeuanganOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Scope pemasuka() dan pengeluaran() yg di buat di TransaksiKas.php di pakai di sini
        $totalPemasukan = TransaksiKas::pemasukan()->sum('nominal');
        $totalPengeluaran = TransaksiKas::pengeluaran()->sum('nominal');
        $saldo = $totalPemasukan - $totalPengeluaran;

        $pemasukanBulanIni = TransaksiKas::pemasukan()
            ->whereMonth('tanggal_bayar', now()->month)
            ->whereYear('tanggal_bayar', now()->year)
            ->sum('nominal');

        $pengeluaranBulanIni = TransaksiKas::pengeluaran()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('nominal');

        return [
            Stat::make('Saldo Kas', 'Rp' . number_format($saldo, 0, ',', '.'))
            ->description('Total pemasukan lunas di kurangi pengeluaran')
            ->color($saldo >= 0 ? 'success' : 'danger'),

            Stat::make('Pemasukan Bulan Ini', 'Rp' . number_format($pemasukanBulanIni, 0, ',', '.'))
            ->description(now()->translatedFormat('F Y'))
            ->color('success'),

            Stat::make('Pengeluaran Bulan Ini', 'Rp' . number_format($pengeluaranBulanIni, 0, ',', '.'))
            ->description(now()->translatedFormat('F Y'))
            ->color('danger'),
        ];
        
    }
}