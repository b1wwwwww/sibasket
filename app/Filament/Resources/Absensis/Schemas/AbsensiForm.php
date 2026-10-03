<?php

namespace App\Filament\Resources\Absensis\Schemas;

use App\Models\PendaftaranKegiatan;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AbsensiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Select untuk memilih Pendaftaran Kegiatan
                // Saat Sie Absensi membuka form, dia akan melihat daftar:
                // "Nama Anggota - Kegiatan" (contoh: "Budi - Latihan Pagi 3 Oktober")
                Select::make('pendaftaran_id')
                    ->label('Pendaftar (Anggota - Kegiatan)')
                    ->required()
                    ->options(
                        PendaftaranKegiatan::with(['anggota', 'kegiatan'])
                            ->get()
                            ->mapWithKeys(function ($pendaftaran) {
                                return [
                                    $pendaftaran->id => "{$pendaftaran->anggota->nama} - {$pendaftaran->kegiatan->judul}",
                                ];
                            })
                    )
                    ->searchable()
                    ->preload()
                    ->helperText('Pilih anggota dan kegiatan. Hanya pendaftaran yang status "approved" yang bisa diabsen.'),

                // Select untuk Status Kehadiran
                // 4 opsi: Hadir, Izin, Sakit, Alpa
                // Urutan ini mengikuti alur bisnis yang wajar (best case -> worst case)
                Select::make('status_kehadiran')
                    ->label('Status Kehadiran')
                    ->options([
                        'hadir' => 'Hadir',
                        'izin' => 'Izin',
                        'sakit' => 'Sakit',
                        'alpa' => 'Alpa',
                    ])
                    ->default('hadir')
                    ->native(false)
                    ->required()
                    ->helperText('Pilih status kehadiran anggota pada kegiatan ini.'),

                // Textarea untuk catatan opsional
                // Contoh: "Anak sakit flu", "Izin karena ada acara keluarga", dll
                Textarea::make('catatan')
                    ->label('Catatan')
                    ->default(null)
                    ->columnSpanFull()
                    ->rows(3)
                    ->helperText('Catatan tambahan jika ada, misal alasan izin/sakit (opsional).'),
            ]);
    }
}
