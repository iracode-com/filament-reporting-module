<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource    = UserResource::class;
    public ?array           $permissions = [];

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
