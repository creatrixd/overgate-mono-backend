<?php

namespace App\Filament\Resources\AccessEvents\Pages;

use App\Filament\Resources\AccessEvents\AccessEventResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAccessEvent extends CreateRecord
{
    protected static string $resource = AccessEventResource::class;
}
