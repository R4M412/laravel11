<?php

namespace App\Filament\Resources\PulauDestinasiResource\Pages;

use App\Filament\Resources\PulauDestinasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPulauDestinasis extends ListRecords
{
    protected static string $resource = PulauDestinasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
