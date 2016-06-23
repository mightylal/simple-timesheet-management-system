<?php

namespace App\Validation;

use Validator as ValidatorFacade;
use App\Exceptions\ValidationException;

abstract class Validator
{

    /**
     * Rules for validation.
     */
    protected static $rules = [];

    /**
     * Custom validation messages.
     */
    protected static $messages = [];

    /**
     * Validate the data by the rules.
     *
     * @param array $data
     * @throws ValidationException if validation fails
     * @return void
     */
    public function validate($data)
    {
        $validate = ValidatorFacade::make($data, static::$rules, static::$messages);
        if ($validate->fails()) {
            throw new ValidationException($validate->getMessageBag());
        }
    }

}