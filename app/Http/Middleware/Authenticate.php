<?php

namespace App\Http\Middleware;

use Closure;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Filament::auth()->user();
        if (Filament::auth()->check() && $user->banned_until && now()->lessThan($user->banned_until)) {

            Filament::auth()->logout();

            Notification::make()
                ->title(__('Your account has banned !'))
                ->body(__('Sorry your account has been banned for :days days.', ['days' => 1]))
                ->danger()->send();

            return redirect()->intended('/');
        }

        return $next($request);
    }
}
