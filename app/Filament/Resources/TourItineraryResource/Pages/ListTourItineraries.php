<?php

namespace App\Filament\Resources\TourItineraryResource\Pages;

use App\Filament\Resources\TourItineraryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTourItineraries extends ListRecords
{
    protected static string $resource = TourItineraryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
