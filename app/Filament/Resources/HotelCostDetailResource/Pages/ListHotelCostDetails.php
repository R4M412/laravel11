<?php

namespace App\Filament\Resources\HotelCostDetailResource\Pages;

use App\Filament\Resources\HotelCostDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHotelCostDetails extends ListRecords
{
    protected static string $resource = HotelCostDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
