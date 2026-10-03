<?php

namespace App\Filament\Resources\Absensis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AbsensisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Nama Anggota -- ditarik dari relasi anggota() di PendaftaranKegiatan
                TextColumn::make('pendaftaranKegiatan.anggota.nama')
                    ->label('Nama Anggota')
                    ->searchable()
                    ->sortable(),

                // Judul Kegiatan -- ditarik dari relasi kegiatan() di PendaftaranKegiatan
                TextColumn::make('pendaftaranKegiatan.kegiatan.judul')
                    ->label('Kegiatan')
                    ->searchable()
                    ->sortable(),

                // Tanggal Kegiatan untuk context tambahan
                TextColumn::make('pendaftaranKegiatan.kegiatan.tanggal')
                    ->label('Tanggal Kegiatan')
                    ->dateTime()
                    ->sortable(),

                // Status Kehadiran dengan badge warna
                // Warna membantu Sie Absensi langsung scan data di tabel tanpa harus buka detail
                TextColumn::make('status_kehadiran')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'hadir' => 'success',   // hijau
                        'izin' => 'info',       // biru
                        'sakit' => 'warning',   // kuning
                        'alpa' => 'danger',     // merah
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),

                // Catatan -- opsional, tapi helpful untuk audit trail
                TextColumn::make('catatan')
                    ->label('Catatan')
                    ->limit(50)
                    ->toggleable(isToggledHiddenByDefault: false),

                // Timestamps untuk audit (siapa yang input/update dan kapan)
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Diupdate')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Filter berdasarkan Status Kehadiran
                // Sie Absensi bisa langsung filter "tampilkan hanya yang alpa" untuk follow-up
                SelectFilter::make('status_kehadiran')
                    ->label('Filter Status')
                    ->options([
                        'hadir' => 'Hadir',
                        'izin' => 'Izin',
                        'sakit' => 'Sakit',
                        'alpa' => 'Alpa',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            // Sort default: terbaru (most recent) di paling atas (LIFO - Last In First Out)
            // Ini memudahkan Sie Absensi melihat input absensi yang paling baru dibuat
            ->defaultSort('created_at', 'desc');
    }
}
