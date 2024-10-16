<?php

namespace App\Filament\Resources\Location;

use App\Filament\Resources\Location;
use App\Models\Location\Country;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CountryResource extends Resource
{
    protected static ?string $model          = Country::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-americas';

    public static function getNavigationLabel(): string
    {
        return __('Countries');
    }

    public static function getModelLabel(): string
    {
        return __('Country');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Countries');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('fa_name')
                    ->label(__('Name'))
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('en_name')
                    ->label(__('Latin name'))
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('fips')
                    ->label(__("Fips code"))
                    ->required(),
                Forms\Components\TextInput::make('iso')
                    ->label(__("Iso code"))
                    ->required(),
                Forms\Components\TextInput::make('domain')
                    ->label(__("Domain"))
                    ->required(),
                Forms\Components\Toggle::make('status')
                    ->label(__('Status'))
                    ->required()
                    ->default(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fa_name')
                    ->label(__('Name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('en_name')
                    ->label(__('Latin name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('fips')
                    ->label(__("Fips code"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('iso')
                    ->label(__("Iso code"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('domain')
                    ->label(__("Domain"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->label(__('Status')),
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
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

   

    public static function getPages(): array
    {
        return [
            'index'  => Location\CountryResource\Pages\ListCountries::route('/'),
            'create' => Location\CountryResource\Pages\CreateCountry::route('/create'),
            'edit'   => Location\CountryResource\Pages\EditCountry::route('/{record}/edit'),
        ];
    }
}
