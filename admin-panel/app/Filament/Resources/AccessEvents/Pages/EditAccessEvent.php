<?php

namespace App\Filament\Resources\AccessEvents\Pages;

use App\Filament\Resources\AccessEvents\AccessEventResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAccessEvent extends EditRecord
{
    protected static string $resource = AccessEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
