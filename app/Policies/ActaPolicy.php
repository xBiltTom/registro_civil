<?php

namespace App\Policies;

use App\Models\Acta;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ActaPolicy
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
    public function view(User $user, Acta $acta): bool
    {
        if($acta->tipo_id === 1) { // Defuncion
            return $acta->actaNacimiento->padre_id === $user->persona_id ||
                $acta->actaNacimiento->madre_id === $user->persona_id;
        } elseif($acta->tipo_id === 2) { // Matrimonio
            return  $acta->actaMatrimonio->novio_id === $user->persona_id ||
                    $acta->actaMatrimonio->novia_id === $user->persona_id ||
                    $acta->actaMatrimonio->testigo1_id === $user->persona_id ||
                    $acta->actaMatrimonio->testigo2_id === $user->persona_id;
        } elseif($acta->tipo_id === 3) { // Nacimiento
            return $acta->actaDefuncion->declarante_id === $user->persona_id;
        }
        return false; // No tiene acceso a otros tipos de actas
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
    public function update(User $user, Acta $acta): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Acta $acta): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Acta $acta): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Acta $acta): bool
    {
        return false;
    }
}
