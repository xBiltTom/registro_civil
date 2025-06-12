<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Folio;

class FolioUnico implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $folioExistente = Folio::where('id', $value)->whereHas('acta')->exists();

        if ($folioExistente) {
            $fail('El folio ya está relacionado con un acta.');
        }
    }
}
