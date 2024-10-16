<?php

namespace App\Filament\Resources\Location\ProvinceResource\Pages;

use App\Filament\Resources\Location\ProvinceResource;
use Filament\Forms;
use Filament\Resources\Pages\CreateRecord;

class CreateProvince extends CreateRecord
{
    protected static string $resource = ProvinceResource::class;

    public static function schema(): array
    {
        return [
            Forms\Components\TextInput::make('name')->label(__('Name'))->required(),
            Forms\Components\TextInput::make('name_en')->label(__('Latin name'))->required(),
            Forms\Components\TextInput::make('latitude')->label(__('Latitude')),
            Forms\Components\TextInput::make('longitude')->label(__('Longitude')),
            Forms\Components\Toggle::make('status')->label(__('Status'))->inline(false),
        ];
    }
}
