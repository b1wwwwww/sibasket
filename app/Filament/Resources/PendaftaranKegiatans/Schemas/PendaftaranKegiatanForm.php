<?php

namespace App\Filament\Resources\PendaftaranKegiatans\Schemas;

use App\Models\PendaftaranKegiatan;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Get;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rule;

class PendaftaranKegiatanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pendaftaran')
                    ->description('Pilih anggota dan kegiatan untuk membuat pendaftaran baru')
                    ->schema([
                        Select::make('anggota_id')
                            ->label('Nama Anggota')
                            ->relationship('anggota', 'nama')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->helperText('Pilih anggota yang ingin mendaftar'),

                        Select::make('kegiatan_id')
                            ->label('Judul Kegiatan')
                            ->relationship('kegiatan', 'judul')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->helperText('Pilih kegiatan yang ingin diikuti')
                            ->rules([
                                // Custom rule: cek kegiatan harus status 'published' dan kuota belum penuh
                                function () {
                                    return function (string $attribute, mixed $value, \Closure $fail) {
                                        if (!$value) {
                                            return;
                                        }

                                        $kegiatan = \App\Models\Kegiatan::find($value);

                                        if (!$kegiatan) {
                                            $fail('Kegiatan tidak ditemukan.');
                                            return;
                                        }

                                        if (!$kegiatan->isMenerimaPendaftaran()) {
                                            $fail('Kegiatan ini tidak menerima pendaftaran baru (status: ' . $kegiatan->status . ').');
                                        }

                                        if ($kegiatan->isKuotaPenuh()) {
                                            $fail('Kegiatan ini sudah penuh. Kuota: ' . $kegiatan->kuota . '.');
                                        }
                                    };
                                },
                            ]),
                    ])
                    ->columns(2),

                Section::make('Status Pendaftaran')
                    ->description('Tentukan status anggota dalam kegiatan ini')
                    ->schema([
                        Select::make('status')
                            ->options([
                                'terdaftar' => 'Terdaftar',
                                'dibatalkan' => 'Dibatalkan',
                            ])
                            ->default('terdaftar')
                            ->required()
                            ->helperText('Terdaftar = anggota aktif ikut kegiatan, Dibatalkan = membatalkan pendaftaran'),
                    ]),
            ]);
    }
}
