<?php

namespace App\Filament\Resources\LandTourOnlyCostResource\Pages;

use App\Filament\Resources\LandTourOnlyCostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLandTourOnlyCosts extends ListRecords
{
    protected static string $resource = LandTourOnlyCostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
