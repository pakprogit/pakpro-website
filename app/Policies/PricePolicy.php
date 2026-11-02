<?php

namespace App\Policies;

use App\Models\Price;
use App\Models\User;

class PricePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Administrator', 'Communications editor', 'Price editor'])
            || in_array($user->role, ['admin', 'supervisor'], true);
    }

    public function view(User $user, Price $price): bool
    {
        return $this->viewAny($user);
    }

    public function create(User $user): bool
    {
        return $this->viewAny($user);
    }

    public function update(User $user, Price $price): bool
    {
        return $this->viewAny($user);
    }

    public function delete(User $user, Price $price): bool
    {
        return $user->hasRole('Administrator') || $user->role === 'admin';
    }

    public function publish(User $user): bool
    {
        return $this->viewAny($user);
    }

    public function restore(User $user): bool
    {
        return $this->viewAny($user);
    }
}

