<?php

namespace App\Filament\Resources\TransaksiKas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TransaksiKasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('anggota.nama')
                    ->label('anggota')
                    ->searchable()
                    ->placeholder('-'), // tampil "-" kalau anggota_id kosong (transaksi pengeluaran umum)

                 // ->money('IDR') otomatis format angka mentah jadi "Rp50.000,00"
                TextColumn::make('nominal')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('jenis')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pemasukan' => 'success',
                        'pengeluaran' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('kategori')
                    ->searchable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state){
                        'lunas' => 'success',
                        'nunggak' => 'danger',
                        'pending' => 'warning',
                        default => 'gray',
                    }),

                TextColumn::make('tanggal_bayar')
                    ->date('d M Y')
                    ->placeholder('Belum dibayar')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([
                SelectFilter::make('jenis')
                    ->options([
                        'pemasukan' => 'Pemasukan',
                        'pengeluaran' => 'Pengeluaran',
                    ]),
                SelectFilter::make('status')
                    ->options([
                        'lunas' => 'Lunas',
                        'nunggak' => 'Nunggak',
                        'pending' => 'Pending',
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
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
