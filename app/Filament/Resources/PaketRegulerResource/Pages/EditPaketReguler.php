<?php

namespace App\Filament\Resources\PaketRegulerResource\Pages;

use App\Filament\Resources\PaketRegulerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPaketReguler extends EditRecord
{
    protected static string $resource = PaketRegulerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
