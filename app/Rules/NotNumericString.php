<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class NotNumericString implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Use a regular expression to check if the value contains only numeric characters.
        return !preg_match('/^\d+$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ' :attribute သည် စာသားထည့်ရန်လိုအပ်ပါသည်။';
    }
}
