<?php

namespace App\Filament\Pages\Auth;

use AbanoubNassem\FilamentGRecaptchaField\Forms\Components\GRecaptcha;
use App\Models\User;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Models\Contracts\FilamentUser;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Validation\ValidationException;

class Login extends BaseLogin
{
    public function form(Form $form): Form
    {
        return $form->schema([
            // $this->getEmailFormComponent(),
            $this->getLoginFormComponent(),
            $this->getPasswordFormComponent(),
            $this->getRememberFormComponent(),
            // $this->getRecaptchaFormComponent(),
        ])
            ->statePath('data');
    }

    public function getRecaptchaFormComponent()
    {
        return GRecaptcha::make('captcha');
    }

    public function authenticate(): ?LoginResponse
    {
        $data = $this->form->getState();

        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {

            if ($user = User::query()->where('email', $data['email'])->first()) {
                $user->update(['banned_until' => now()->addDay()]);
                $this->getRateLimitedBannedNotification(1)->send();
            } else {
                $this->getRateLimitedNotification($exception)?->send();
            }

            return null;
        }

        if (! Filament::auth()->attempt($this->getCredentialsFromFormData($data), $data['remember'] ?? false)) {
            $this->throwFailureValidationException();
        }

        $user = Filament::auth()->user();

        if (
            ($user instanceof FilamentUser) &&
            (! $user->canAccessPanel(Filament::getCurrentPanel()))
        ) {
            Filament::auth()->logout();

            $this->throwFailureValidationException();
        }

        session()->regenerate();

        return app(LoginResponse::class);
    }

    public function getRateLimitedBannedNotification($exception)
    {
        return Notification::make()
            ->title(__('Your account has banned !'))
            ->body(__('Sorry your account has been banned for :days days.', ['days' => $exception]))
            ->danger();
    }

    public function getLoginFormComponent()
    {
        return TextInput::make('login')
            ->helperText(__('Login via email or national code'))
            ->required()
            ->autocomplete(false)
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        $loginType = filter_var($data['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'national_code';

        return [
            $loginType => $data['login'],
            'password' => $data['password'],
        ];
    }

    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.login' => __('filament-panels::pages/auth/login.messages.failed'),
        ]);
    }
}
