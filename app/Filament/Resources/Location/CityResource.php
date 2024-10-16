<?php

namespace App\Filament\Resources\Location;

use App\Filament\Resources\Location\CityResource\Pages;
use App\Models\Location\City;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class CityResource extends Resource
{
    protected static ?string $model          = City::class;
    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    public static function getNavigationLabel(): string
    {
        return __('Cities');
    }

    public static function getModelLabel(): string
    {
        return __('City');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Cities');
    }

    public static function form(Form $form): Form
    {
        return $form->schema(Pages\CreateCity::schema())->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(Pages\ListCities::list())
            ->actions(Pages\ListCities::actions())
            ->bulkActions(Pages\ListCities::bulkActions())
            ->emptyStateActions(Pages\ListCities::emptyStateActions())
            ;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCities::route('/'),
            // 'create' => Pages\CreateCity::route('/create'),
            // 'edit'   => Pages\EditCity::route('/{record}/edit'),
        ];
    }

}
