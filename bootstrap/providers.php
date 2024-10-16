<?php

use IracodeCom\FilamentNotification\FilamentNotificationServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\Filament\AdminPanelProvider::class,
    FilamentNotificationServiceProvider::class
];
