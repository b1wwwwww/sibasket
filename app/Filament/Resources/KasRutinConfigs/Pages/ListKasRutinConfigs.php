<?php

namespace App\Filament\Resources\KasRutinConfigs\Pages;

use App\Filament\Resources\KasRutinConfigs\KasRutinConfigResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKasRutinConfigs extends ListRecords
{
    protected static string $resource = KasRutinConfigResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
