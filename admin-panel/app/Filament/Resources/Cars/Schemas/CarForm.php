<?php

namespace App\Filament\Resources\Cars\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('plate_number'),
                TextInput::make('status')
                    ->required(),
            ]);
    }
}
