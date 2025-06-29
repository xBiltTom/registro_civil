<?php

namespace App\Policies;

use App\Models\ActaDefuncion;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ActaDefuncionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('ver actas');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ActaDefuncion $actaDefuncion): bool
    {
        return $user->can('ver actas');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ActaDefuncion $actaDefuncion): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ActaDefuncion $actaDefuncion): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ActaDefuncion $actaDefuncion): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ActaDefuncion $actaDefuncion): bool
    {
        return false;
    }
}
