<?php

namespace App\Filament\Resources\Location\CityResource\Pages;

use App\Filament\Resources\Location\CityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;

class ListCities extends ListRecords
{
    protected static string $resource = CityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public static function list(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\TextColumn::make('name_en')->searchable(),
            Tables\Columns\TextColumn::make('province.name')->searchable(),
            Tables\Columns\TextColumn::make('status')->badge(),
            Tables\Columns\TextColumn::make('latitude')->searchable()->searchable(),
            Tables\Columns\TextColumn::make('longitude')->searchable()->searchable(),

            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('deleted_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }

    public static function actions(): array
    {
        return [
            Tables\Actions\EditAction::make(),
        ];
    }

    public static function bulkActions(): array
    {
        return [
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ];
    }

    public static function emptyStateActions(): array
    {
        return [
            Tables\Actions\CreateAction::make(),
        ];
    }
}
