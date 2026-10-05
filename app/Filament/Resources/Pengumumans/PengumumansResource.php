<?php

namespace App\Filament\Resources\Pengumumans;

use App\Filament\Resources\Pengumumans\Pages\CreatePengumumans;
use App\Filament\Resources\Pengumumans\Pages\EditPengumumans;
use App\Filament\Resources\Pengumumans\Pages\ListPengumumans;
use App\Filament\Resources\Pengumumans\Schemas\PengumumansForm;
use App\Filament\Resources\Pengumumans\Tables\PengumumansTable;
use App\Models\Pengumumans;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengumumansResource extends Resource
{
    protected static ?string $model = Pengumumans::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'judul';

    public static function form(Schema $schema): Schema
    {
        return PengumumansForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PengumumansTable::configure($table);
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
            'index' => ListPengumumans::route('/'),
            'create' => CreatePengumumans::route('/create'),
            'edit' => EditPengumumans::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
