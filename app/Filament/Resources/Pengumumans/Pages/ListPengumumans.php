<?php

namespace App\Filament\Resources\Pengumumans\Pages;

use App\Filament\Resources\Pengumumans\PengumumansResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPengumumans extends ListRecords
{
    protected static string $resource = PengumumansResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
