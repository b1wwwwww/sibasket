<?php

namespace App\Filament\Resources\Absensis\Pages;

use App\Filament\Resources\Absensis\AbsensiResource;
use App\Models\Anggota;
use Filament\Resources\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class RecapAbsensi extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string $resource = AbsensiResource::class;

    protected string $view = 'filament.resources.absensis.pages.recap-absensi';

    protected static ?string $title = 'Recap Absensi';

    public function table(Table $table): Table
    {
        return $table
            ->query(Anggota::query()->with(['pendaftaranKegiatan.absensi']))
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama Anggota')
                    ->searchable(),
                
                TextColumn::make('total_kegiatan')
                    ->state(fn ($record) => $record->pendaftaranKegiatan->count())
                    ->label('Total Kegiatan'),
                
                TextColumn::make('hadir')
                    ->state(fn ($record) => $record->pendaftaranKegiatan->where('absensi.status_kehadiran', 'hadir')->count())
                    ->label('Hadir'),
                
                TextColumn::make('izin')
                    ->state(fn ($record) => $record->pendaftaranKegiatan->where('absensi.status_kehadiran', 'izin')->count())
                    ->label('Izin'),
                
                TextColumn::make('sakit')
                    ->state(fn ($record) => $record->pendaftaranKegiatan->where('absensi.status_kehadiran', 'sakit')->count())
                    ->label('Sakit'),
                
                TextColumn::make('alpa')
                    ->state(fn ($record) => $record->pendaftaranKegiatan->where('absensi.status_kehadiran', 'alpa')->count())
                    ->label('Alpa'),
            ]);
    }
}
