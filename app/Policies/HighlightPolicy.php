<?php

namespace App\Policies;

use App\Models\Highlight;
use App\Models\User;

class HighlightPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Administrator', 'Communications editor'])
            || in_array($user->role, ['admin', 'supervisor'], true);
    }

    public function view(User $user, Highlight $highlight): bool
    {
        return $this->viewAny($user);
    }

    public function create(User $user): bool
    {
        return $this->viewAny($user);
    }

    public function update(User $user, Highlight $highlight): bool
    {
        return $this->viewAny($user);
    }

    public function delete(User $user, Highlight $highlight): bool
    {
        return $this->viewAny($user);
    }
}

