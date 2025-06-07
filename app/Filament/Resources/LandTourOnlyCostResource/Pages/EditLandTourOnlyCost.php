<?php

namespace App\Filament\Resources\LandTourOnlyCostResource\Pages;

use App\Filament\Resources\LandTourOnlyCostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLandTourOnlyCost extends EditRecord
{
    protected static string $resource = LandTourOnlyCostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
