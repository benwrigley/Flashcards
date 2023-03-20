<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class SpecialCharacters implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $pattern = "/^[a-zA-Z0-9\s\-\_\,\(\)\.\']+$/i";
        if(!preg_match($pattern,$value)){
            $fail(":attribute can only contain -_,().'");
        }
    }
}
