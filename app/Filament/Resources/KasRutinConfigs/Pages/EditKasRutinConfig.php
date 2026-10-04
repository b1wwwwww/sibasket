<?php

namespace App\Filament\Resources\KasRutinConfigs\Pages;

use App\Filament\Resources\KasRutinConfigs\KasRutinConfigResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditKasRutinConfig extends EditRecord
{
    protected static string $resource = KasRutinConfigResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
