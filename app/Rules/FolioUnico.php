<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Folio;

class FolioUnico implements ValidationRule
{
    protected $libroId;

    /**
     * Constructor para recibir el libro_id.
     */
    public function __construct($libroId)
    {
        $this->libroId = $libroId;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Verificar si el folio ya está relacionado con un acta dentro del mismo libro
        $folioExistente = Folio::where('id', $value)
            ->where('libro_id', $this->libroId) // Validar dentro del mismo libro
            ->whereHas('acta') // Verificar si tiene un acta asociada
            ->exists();

        if ($folioExistente) {
            $fail('El folio ya está relacionado con un acta en este libro.');
        }
    }
}
