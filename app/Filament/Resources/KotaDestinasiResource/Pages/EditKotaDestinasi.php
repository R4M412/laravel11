<?php

namespace App\Filament\Resources\KotaDestinasiResource\Pages;

use App\Filament\Resources\KotaDestinasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKotaDestinasi extends EditRecord
{
    protected static string $resource = KotaDestinasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
