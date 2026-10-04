<?php

namespace App\Filament\Resources\KasRutinConfigs;

use App\Filament\Resources\KasRutinConfigs\Pages\CreateKasRutinConfig;
use App\Filament\Resources\KasRutinConfigs\Pages\EditKasRutinConfig;
use App\Filament\Resources\KasRutinConfigs\Pages\ListKasRutinConfigs;
use App\Filament\Resources\KasRutinConfigs\Schemas\KasRutinConfigForm;
use App\Filament\Resources\KasRutinConfigs\Tables\KasRutinConfigsTable;
use App\Models\KasRutinConfig;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class KasRutinConfigResource extends Resource
{
    protected static ?string $model = KasRutinConfig::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return KasRutinConfigForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KasRutinConfigsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListKasRutinConfigs::route('/'),
            'create' => CreateKasRutinConfig::route('/create'),
            'edit' => EditKasRutinConfig::route('/{record}/edit'),
        ];
    }
}
