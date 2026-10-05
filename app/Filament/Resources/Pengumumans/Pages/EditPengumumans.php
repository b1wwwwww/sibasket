<?php

namespace App\Filament\Resources\Pengumumans\Pages;

use App\Filament\Resources\Pengumumans\PengumumansResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditPengumumans extends EditRecord
{
    protected static string $resource = PengumumansResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
