<?php

namespace App\Filament\Resources\PulauDestinasiResource\Pages;

use App\Filament\Resources\PulauDestinasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPulauDestinasi extends EditRecord
{
    protected static string $resource = PulauDestinasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
