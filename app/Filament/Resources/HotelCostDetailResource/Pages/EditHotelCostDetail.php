<?php

namespace App\Filament\Resources\HotelCostDetailResource\Pages;

use App\Filament\Resources\HotelCostDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHotelCostDetail extends EditRecord
{
    protected static string $resource = HotelCostDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
