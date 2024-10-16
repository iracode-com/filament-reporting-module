<?php

namespace App\Models;

use App\Enums\UserRole;
use App\Observers\UserObserver;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

#[ObservedBy(UserObserver::class)]
class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_url',
        'national_code',
        'role',
        'ip',
        'agent',
        'last_login',
        'banned_until',
        'must_password_reset',
        'can_password_reset',
        'password_never_expires',
        'status',
        'prefers_bale',
        'prefers_telegram',
        'prefers_sms',
        'telegram_chat_id',
        'bale_chat_id',
        'phone'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'banned_until'      => 'datetime',
            'password'          => 'hashed',
            'role'              => UserRole::class
        ];
    }


    public function isAdmin(): bool
    {
        return $this->role == UserRole::ADMIN;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isAdmin() && $this->status == 1;
    }

    public function canResetUsersPassword(): bool
    {
        return $this->isAdmin();
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url ? Storage::url($this->avatar_url) : null;
    }
}
