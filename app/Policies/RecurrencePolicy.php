<?php

namespace App\Policies;

use App\Models\Recurrence;
use App\Models\User;

class RecurrencePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Recurrence $recurrence): bool
    {
        return $recurrence->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Recurrence $recurrence): bool
    {
        return $recurrence->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Recurrence $recurrence): bool
    {
        return $recurrence->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Recurrence $recurrence): bool
    {
        return $recurrence->user_id === $user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Recurrence $recurrence): bool
    {
        return $recurrence->user_id === $user->id;
    }
}
