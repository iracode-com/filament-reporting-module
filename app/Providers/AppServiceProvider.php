<?php

namespace App\Providers;

use Filament\Actions\MountableAction;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\Column;
use Filament\Tables\Filters\BaseFilter;
use Filament\Tables\Filters\QueryBuilder\Constraints\Constraint;
use Filament\Tables\Table;
use Illuminate\Support\ServiceProvider;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        require_once(app_path('Support/HtmlString.php'));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        HeadingRowFormatter::default('none');

        foreach ([Field::class, BaseFilter::class, Placeholder::class, Column::class, MountableAction::class, Constraint::class] as $component) {
            $component::configureUsing(fn($c) => $c->translateLabel());
        }

        Column::configureUsing(fn($c) => $c->placeholder(__('No Data')));
        Table::configureUsing(fn($component) => $component->striped());
        Section::configureUsing(fn($component) => $component->compact());
    }
}
