<?php

namespace App\Filament\Resources\KotaDestinasiResource\Pages;

use App\Filament\Resources\KotaDestinasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKotaDestinasis extends ListRecords
{
    protected static string $resource = KotaDestinasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
