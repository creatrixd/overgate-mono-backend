<?php

namespace App\Filament\Resources\AccessEvents\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AccessEventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kind')
                    ->required(),
                TextInput::make('car_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
