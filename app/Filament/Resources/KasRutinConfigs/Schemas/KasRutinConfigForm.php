<?php

namespace App\Filament\Resources\KasRutinConfigs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class KasRutinConfigForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nominal_wajib')
                    ->label('Nominal wajib')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),

                Select::make('frekuensi')
                    ->options([
                        'mingguan' => 'Mingguan',
                        'bulanan' => 'Bulanan',
                    ])
                    ->native(false)
                    ->required(),
            ]);
    }
}
