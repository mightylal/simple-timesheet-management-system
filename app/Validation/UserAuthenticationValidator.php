<?php

namespace App\Validation;

class UserAuthenticationValidator extends Validator
{
    /**
     * Validate the login form.
     *
     * @param array $data
     */
    public function validateLoginForm($data)
    {
        self::$rules = [
            'username' => 'required',
            'password' => 'required'
        ];
        $this->validate($data);
    }
}