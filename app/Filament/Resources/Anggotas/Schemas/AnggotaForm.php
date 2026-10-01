<?php

namespace App\Filament\Resources\Anggotas\Schemas;

use App\Enums\Jurusan;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AnggotaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Akun User')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('nis')
                    ->label('NIS')
                    ->required()
                    ->maxLength(255),

                TextInput::make('nama')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255),

                TextInput::make('kelas')
                    ->required()
                    ->maxLength(255),

                // ->options(Jurusan::class) otomatis baca semua case di Enum
                // dan pakai getLabel() sebagai teks pilihannya -- nggak perlu
                // nulis ulang daftar 7 jurusan secara manual di sini.
                Select::make('jurusan')
                    ->options(Jurusan::class)
                    ->native(false)
                    ->required(),

                Select::make('posisi')
                    ->label('Posisi')
                    ->options([
                        'PG' => 'Point Guard (PG)',
                        'SG' => 'Shooting Guard (SG)',
                        'SF' => 'Small Forward (SF)',
                        'PF' => 'Power Forward (PF)',
                        'C'  => 'Center (C)',
                    ])
                    ->native(false)
                    ->default(null),

                Select::make('status')
                    ->options([
                        'aktif' => 'Aktif',
                        'nonaktif' => 'Nonaktif',
                    ])
                    ->default('aktif')
                    ->native(false)
                    ->required(),

                DatePicker::make('tanggal_bergabung')
                    ->label('Tanggal Bergabung')
                    ->required()
                    ->default(now()),
            ]);
    }
}