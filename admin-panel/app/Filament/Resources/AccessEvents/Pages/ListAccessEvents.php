<?php

namespace App\Filament\Resources\AccessEvents\Pages;

use App\Filament\Resources\AccessEvents\AccessEventResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAccessEvents extends ListRecords
{
    protected static string $resource = AccessEventResource::class;
    protected  ?string $pollingInterval = '3s';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

}
