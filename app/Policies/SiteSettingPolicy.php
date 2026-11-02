<?php

namespace App\Policies;

use App\Models\SiteSetting;
use App\Models\User;

class SiteSettingPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Administrator', 'Communications editor'])
            || in_array($user->role, ['admin', 'supervisor'], true);
    }

    public function view(User $user, SiteSetting $setting): bool
    {
        return $this->viewAny($user);
    }

    public function update(User $user, SiteSetting $setting): bool
    {
        return $this->viewAny($user);
    }
}

