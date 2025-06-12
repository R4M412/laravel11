<?php

namespace App\Filament\Resources\PaketRegulerResource\Pages;

use App\Filament\Resources\PaketRegulerResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPaketReguler extends ViewRecord
{
    protected static string $resource = PaketRegulerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}