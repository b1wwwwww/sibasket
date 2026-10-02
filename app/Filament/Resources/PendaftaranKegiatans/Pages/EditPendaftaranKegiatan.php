<?php

namespace App\Filament\Resources\PendaftaranKegiatans\Pages;

use App\Filament\Resources\PendaftaranKegiatans\PendaftaranKegiatanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPendaftaranKegiatan extends EditRecord
{
    protected static string $resource = PendaftaranKegiatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
