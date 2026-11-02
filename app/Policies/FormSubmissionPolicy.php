<?php

namespace App\Policies;

use App\Models\FormSubmission;
use App\Models\User;

class FormSubmissionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Administrator', 'Communications editor'])
            || in_array($user->role, ['admin', 'supervisor'], true);
    }

    public function view(User $user, FormSubmission $submission): bool
    {
        if ($submission->type === 'grievance') {
            return ($user->hasRole('Administrator') || $user->role === 'admin')
                && $user->hasPermissionTo('view-grievance-reports');
        }

        return $this->viewAny($user);
    }

    public function update(User $user, FormSubmission $submission): bool
    {
        if ($submission->type === 'grievance') {
            return ($user->hasRole('Administrator') || $user->role === 'admin')
                && $user->hasPermissionTo('view-grievance-reports');
        }

        return $this->viewAny($user);
    }

    public function delete(User $user, FormSubmission $submission): bool
    {
        return $user->hasRole('Administrator') || $user->role === 'admin';
    }
}

