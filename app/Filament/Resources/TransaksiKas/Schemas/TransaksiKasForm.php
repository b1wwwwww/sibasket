<?php

namespace App\Filament\Resources\TransaksiKas\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TransaksiKasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('anggota_id')
                    ->relationship('anggota', 'nama')
                    ->label('anggota')
                    ->searchable()
                    ->preload()
                    ->helperText('Kosongkan ruang untuk pengeluaran yang tidak terkait 1 anggota tertentu (misal beli alat). '),

                // ->prefix('Rp') nambah teks "Rp" di depan kotak input, jadi
                // Admin ketik "50000" tapi yang kelihatan di layar "Rp 50000"

                TextInput::make('nominal')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),

                Select::make('jenis')
                    ->options(['pemasukan' => 'Pemasukan',
                            'pengeluaran' => 'Pengeluaran'
                            ])
                    -> native(false)
                    ->required(),

                
                TextInput::make('kategori')
                    ->required()
                    ->placeholder('Contoh: Kas Mingguan, Iuran Event, Alat'),

                Select::make('status')
                    ->options(['lunas' => 'Lunas',
                            'nunggak' => 'Nunggak',
                            'pending' => 'Pending'
                            ])
                    ->default('pending')
                    ->native(false)
                    ->required(),

                DatePicker::make('tanggal_bayar')
                    ->native(false) // tidak ->required(), sesuai migration -- boleh kosong kalau belum lunas
                    ->required(),
                Textarea::make('keterangan')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
