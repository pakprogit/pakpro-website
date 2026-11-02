<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('Administrator') || $user->role === 'admin';
    }

    public function view(User $user, User $model): bool
    {
        return $this->viewAny($user);
    }

    public function create(User $user): bool
    {
        return $this->viewAny($user);
    }

    public function invite(User $user): bool
    {
        return $this->viewAny($user);
    }

    public function update(User $user, User $model): bool
    {
        return $this->viewAny($user);
    }

    public function delete(User $user, User $model): bool
    {
        if (!$this->viewAny($user)) {
            return false;
        }

        // If target is an administrator, enforce minimum 2 active administrators rule
        if ($model->hasRole('Administrator') || $model->role === 'admin') {
            if (User::countActiveAdministrators() <= 2) {
                return false;
            }
        }

        return true;
    }

    public function deactivate(User $user, User $model): bool
    {
        return $this->delete($user, $model);
    }
}

