<?php

namespace App\Filament\Resources\PendaftaranKegiatans\Tables;

use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

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
                
                // Kuota Sisa (hitung: kuota total - jumlah terdaftar)
                TextColumn::make('kegiatan_kuota_info')
                    ->label('Kuota Sisa')
                    ->formatStateUsing(function ($record) {
                        $kegiatan = $record->kegiatan;
                        
                        if (!$kegiatan) {
                            return 'N/A';
                        }
                        
                        // Hitung jumlah yang terdaftar (bukan dibatalkan)
                        $jumlahTerdaftar = $kegiatan->pendaftaranKegiatan()
                            ->where('status', 'terdaftar')
                            ->count();
                        
                        // Jika kuota NULL, berarti tanpa batas
                        if ($kegiatan->kuota === null) {
                            return $jumlahTerdaftar . ' / ∞';
                        }
                        
                        return $jumlahTerdaftar . ' / ' . $kegiatan->kuota;
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
                
                // Filter: Admin bisa filter by kegiatan
                SelectFilter::make('kegiatan_id')
                    ->relationship('kegiatan', 'judul')
                    ->label('Kegiatan')
                    ->searchable()
                    ->preload(),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // Bulk action untuk cancel registrasi (ubah status jadi dibatalkan)
                    BulkAction::make('cancelRegistrations')
                        ->label('Cancel Selected')
                        ->icon('heroicon-o-x-mark')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->modalHeading('Cancel Registrations?')
                        ->modalDescription('Registrasi yang dipilih akan diubah statusnya menjadi "Dibatalkan". Data tidak akan dihapus, hanya status yang berubah.')
                        ->modalSubmitActionLabel('Yes, Cancel')
                        ->action(function (Collection $records) {
                            $records->each(function ($record) {
                                $record->update(['status' => 'dibatalkan']);
                            });
                        })
                        ->successNotificationTitle('Registrasi berhasil dibatalkan'),
                    
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
