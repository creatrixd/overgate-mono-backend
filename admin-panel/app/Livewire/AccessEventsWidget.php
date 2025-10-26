<?php

namespace App\Livewire;

use App\Models\AccessEvent;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class AccessEventsWidget extends TableWidget
{
    protected int | string | array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => AccessEvent::query()->with('car')->orderBy('created_at', 'desc'))
            ->columns([
                TextColumn::make('kind')
                    ->color(fn (string $state): string => match ($state) {
                        'car_detected' => 'warning',
                        default => 'gray',
                    })
                    ->searchable(),
                TextColumn::make('car_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('car.plate_number')
                    ->formatStateUsing(fn (AccessEvent $record) => $record->car?->plate_number ?? '—')
                    ->copyable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ])
            ->poll('3s');
    }
}
