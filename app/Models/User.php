<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasName
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'password_hash',
        'role',
        'is_active',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
        'invitation_token',
        'invitation_expires_at',
        'deactivated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'password_hash',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'is_active' => 'boolean',
            'two_factor_confirmed_at' => 'datetime',
            'invitation_expires_at' => 'datetime',
            'deactivated_at' => 'datetime',
        ];
    }

    /**
     * Get the password for the user, supporting both Laravel password and legacy password_hash.
     */
    public function getAuthPassword(): string
    {
        return $this->password ?: ($this->password_hash ?: '');
    }

    /**
     * Set password attribute mutator to maintain compatibility with legacy password_hash.
     */
    public function setPasswordAttribute(?string $value): void
    {
        if ($value) {
            $hashed = \Illuminate\Support\Facades\Hash::needsRehash($value)
                ? bcrypt($value)
                : $value;
            $this->attributes['password'] = $hashed;
            $this->attributes['password_hash'] = $hashed;
        }
    }

    /**
     * Get user display name.
     */
    public function getFilamentName(): string
    {
        return $this->display_name;
    }

    public function getDisplayNameAttribute(): string
    {
        if (!empty($this->name)) {
            return $this->name;
        }

        $employee = Employee::where('user_id', $this->id)->first();
        if ($employee && (!empty($employee->first_name) || !empty($employee->last_name))) {
            return trim(($employee->first_name ?? '') . ' ' . ($employee->last_name ?? ''));
        }

        return $this->username ?: $this->email;
    }

    public function getShortNameAttribute(): string
    {
        $fullName = $this->display_name;
        $parts = explode(' ', $fullName);
        if (count($parts) >= 2) {
            return $parts[0] . ' ' . strtoupper(substr($parts[1], 0, 1)) . '.';
        }
        return $fullName;
    }

    /**
     * Determine if user can access the Filament panel.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        if (!$this->is_active || $this->deactivated_at !== null) {
            return false;
        }

        if ($this->hasAnyRole(['Administrator', 'Communications editor', 'Price editor'])) {
            return true;
        }

        // Backwards compatibility with existing 'admin' role in users table
        return in_array($this->role, ['admin', 'administrator'], true);
    }

    public function employee()
    {
        return $this->hasOne(Employee::class, 'user_id');
    }

    public function hasTwoFactorEnabled(): bool
    {
        return !empty($this->two_factor_secret) && $this->two_factor_confirmed_at !== null;
    }

    /**
     * Prevent deactivating or demoting the last active administrator.
     */
    public static function countActiveAdministrators(): int
    {
        return static::where('is_active', true)
            ->whereNull('deactivated_at')
            ->where(function ($q) {
                $q->whereHas('roles', function ($rq) {
                    $rq->where('name', 'Administrator');
                })->orWhere('role', 'admin');
            })
            ->count();
    }
}
