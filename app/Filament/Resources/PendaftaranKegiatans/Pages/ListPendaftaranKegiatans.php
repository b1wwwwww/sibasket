<?php

namespace App\Filament\Resources\PendaftaranKegiatans\Pages;

use App\Filament\Resources\PendaftaranKegiatans\PendaftaranKegiatanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPendaftaranKegiatans extends ListRecords
{
    protected static string $resource = PendaftaranKegiatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
