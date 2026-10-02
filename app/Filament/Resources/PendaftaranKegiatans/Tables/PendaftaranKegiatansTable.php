<?php

namespace App\Filament\Resources\PendaftaranKegiatans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PendaftaranKegiatansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Akses relation: 'anggota.nama' membaca kolom 'nama' dari tabel anggota
                TextColumn::make('anggota.nama')
                    ->label('Nama Anggota')
                    ->searchable()
                    ->sortable(),
                
                // Sama: akses 'judul' dari kegiatan yang related
                TextColumn::make('kegiatan.judul')
                    ->label('Judul Kegiatan')
                    ->searchable()
                    ->sortable(),
                
                // Status dengan badge berwarna
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'terdaftar' => 'success',      // hijau
                        'dibatalkan' => 'danger',      // merah
                        default => 'gray',
                    })
                    ->sortable(),
                
                // Tanggal pendaftaran (dari created_at)
                TextColumn::make('created_at')
                    ->label('Tanggal Daftar')
                    ->dateTime()
                    ->sortable(),
                
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Filter: Admin bisa filter by status
                SelectFilter::make('status')
                    ->options([
                        'terdaftar' => 'Terdaftar',
                        'dibatalkan' => 'Dibatalkan',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
