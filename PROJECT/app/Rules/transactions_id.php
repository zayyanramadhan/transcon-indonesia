<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Transactions;

class transactions_id implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!empty($value)) {
            try {
                $cek = Transactions::find($value)->count();
                if ($cek<1) {
                    $fail('The :transactions_id not found.');
                }
            } catch (\Throwable $th) {
                $fail('The :transactions_id not found.');
            }
        }
    }
}
