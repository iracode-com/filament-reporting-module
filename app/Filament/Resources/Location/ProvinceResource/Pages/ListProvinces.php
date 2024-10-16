<?php

namespace App\Filament\Resources\Location\ProvinceResource\Pages;

use App\Filament\Resources\Location\ProvinceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;

class ListProvinces extends ListRecords
{
    protected static string $resource = ProvinceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public static function list(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')->label(__('Name')),
            Tables\Columns\TextColumn::make('name_en')->label(__('Latin name')),
            Tables\Columns\TextColumn::make('status')->badge()->label(__('Status')),
            Tables\Columns\TextColumn::make('latitude')->label(__('Latitude'))->searchable(),
            Tables\Columns\TextColumn::make('longitude')->label(__('Longitude'))->searchable(),

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
