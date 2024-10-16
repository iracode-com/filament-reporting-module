<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon                  = 'heroicon-o-users';

    public static function getLabel(): ?string
    {
        return __('User');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Users');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make(__('Login information'))->schema([
                Forms\Components\Split::make([
                    Forms\Components\Group::make([
                        Forms\Components\FileUpload::make('avatar_url')->inlineLabel()->avatar()->image()->imageEditor(),
                        Forms\Components\TextInput::make('name')->inlineLabel()->required(),
                        Forms\Components\TextInput::make('national_code')->required()->inlineLabel()->numeric(),
                        Forms\Components\TextInput::make('email')->inlineLabel()->nullable()->email()->unique('users', 'email', ignoreRecord: true),
                         Forms\Components\TextInput::make('password')
                            ->inlineLabel()
                            ->live()
                            ->password()
                            ->revealable()
                            ->confirmed()->required(),
                        Forms\Components\TextInput::make('password_confirmation')
                            ->inlineLabel()
                            ->live()
                            ->password()
                            ->revealable()->required()
                    ]),
                    Forms\Components\Group::make([
                        Forms\Components\Placeholder::make('ip')->inlineLabel()->content(fn(?User $record) => $record?->ip ?? request()->ip()),
                        Forms\Components\Placeholder::make('agent')->inlineLabel()->content(fn(?User $record) => $record?->agent ?? request()->userAgent()),
                        Forms\Components\Placeholder::make('last_login')->inlineLabel()->content(fn(?User $record) => verta($record?->last_login)),
                        Forms\Components\Checkbox::make('must_password_reset')->reactive()->afterStateUpdated(function (Forms\Set $set) {
                            $set('can_password_reset', false);
                            $set('password_never_expires', false);
                        })->hint(new HtmlString(Blade::render('<x-filament::loading-indicator wire:loading wire:target="data.must_password_reset, data.can_password_reset, data.can_password_never_expires" class="h-5 w-5"/>'))),
                        Forms\Components\Checkbox::make('can_password_reset')->reactive()->afterStateUpdated(fn(Forms\Set $set, $state) => $set('must_password_reset', false)),
                        Forms\Components\Checkbox::make('password_never_expires')->reactive()
                    ])
                ])
            ])->collapsible(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(Pages\ListUsers::schema())
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
