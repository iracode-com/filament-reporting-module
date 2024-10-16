<?php

namespace App\Filament\Resources\Location\CityResource\Pages;

use App\Filament\Resources\Location\CityResource;
use Filament\Forms;
use Filament\Resources\Pages\CreateRecord;

class CreateCity extends CreateRecord
{
    protected static string $resource = CityResource::class;

    public static function schema(): array
    {
        return [
            Forms\Components\TextInput::make('name')->label(__('Name'))->required(),
            Forms\Components\TextInput::make('name_en')->label(__('Latin name'))->required(),
            Forms\Components\Select::make('province_id')
                ->relationship('province', 'name')->label(__('Province'))
                ->required()
                ->searchable()
                ->preload(),
            Forms\Components\TextInput::make('latitude')->label(__('Latitude')),
            Forms\Components\TextInput::make('longitude')->label(__('Longitude')),
            Forms\Components\Toggle::make('status')->label(__('Status'))->inline(false),
        ];
    }
}
