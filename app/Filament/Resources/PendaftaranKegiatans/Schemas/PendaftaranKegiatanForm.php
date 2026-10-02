<?php

namespace App\Filament\Resources\PendaftaranKegiatans\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class PendaftaranKegiatanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('anggota_id')
                    ->relationship('anggota', 'id')
                    ->required(),
                Select::make('kegiatan_id')
                    ->relationship('kegiatan', 'id')
                    ->required(),
                Select::make('status')
                    ->options(['terdaftar' => 'Terdaftar', 'dibatalkan' => 'Dibatalkan'])
                    ->default('terdaftar')
                    ->required(),
            ]);
    }
}
