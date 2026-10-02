<?php

namespace App\Filament\Resources\PendaftaranKegiatans;

use App\Filament\Resources\PendaftaranKegiatans\Pages\CreatePendaftaranKegiatan;
use App\Filament\Resources\PendaftaranKegiatans\Pages\EditPendaftaranKegiatan;
use App\Filament\Resources\PendaftaranKegiatans\Pages\ListPendaftaranKegiatans;
use App\Filament\Resources\PendaftaranKegiatans\Schemas\PendaftaranKegiatanForm;
use App\Filament\Resources\PendaftaranKegiatans\Tables\PendaftaranKegiatansTable;
use App\Models\PendaftaranKegiatan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PendaftaranKegiatanResource extends Resource
{
    protected static ?string $model = PendaftaranKegiatan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PendaftaranKegiatanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PendaftaranKegiatansTable::configure($table);
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
            'index' => ListPendaftaranKegiatans::route('/'),
            'create' => CreatePendaftaranKegiatan::route('/create'),
            'edit' => EditPendaftaranKegiatan::route('/{record}/edit'),
        ];
    }
}
