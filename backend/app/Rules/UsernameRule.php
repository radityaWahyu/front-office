<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\User;

class UsernameRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $row = User::where('username', $value)->first();

        return empty($row);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Username sudah terdaftar dalam sistem';
    }
}
