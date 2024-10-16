<?php

namespace App\Filament\Resources\Location;

use App\Filament\Resources\Location\ProvinceResource\Pages;
use App\Models\Location\Province;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class ProvinceResource extends Resource
{
    protected static ?string $model          = Province::class;
    protected static ?string $navigationIcon = 'heroicon-o-map';


    public static function getNavigationLabel(): string
    {
        return __('Provinces');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Provinces');
    }

    public static function getModelLabel(): string
    {
        return __('Province');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(Pages\CreateProvince::schema())->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(Pages\ListProvinces::list())
            ->actions(Pages\ListProvinces::actions())
            ->bulkActions(Pages\ListProvinces::bulkActions())
            ->emptyStateActions(Pages\ListProvinces::emptyStateActions())
            ;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProvinces::route('/'),
            // 'create' => Pages\CreateProvince::route('/create'),
            // 'edit'   => Pages\EditProvince::route('/{record}/edit'),
        ];
    }
}
