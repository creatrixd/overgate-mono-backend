<?php

namespace App\Filament\Resources\AccessEvents;

use App\Filament\Resources\AccessEvents\Pages\CreateAccessEvent;
use App\Filament\Resources\AccessEvents\Pages\EditAccessEvent;
use App\Filament\Resources\AccessEvents\Pages\ListAccessEvents;
use App\Filament\Resources\AccessEvents\Schemas\AccessEventForm;
use App\Filament\Resources\AccessEvents\Tables\AccessEventsTable;
use App\Models\AccessEvent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AccessEventResource extends Resource
{
    protected static ?string $model = AccessEvent::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'События доступа';

    public static function form(Schema $schema): Schema
    {
        return AccessEventForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AccessEventsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAccessEvents::route('/'),
            'create' => CreateAccessEvent::route('/create'),
            'edit' => EditAccessEvent::route('/{record}/edit'),
        ];
    }
}
