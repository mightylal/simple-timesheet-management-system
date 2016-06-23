<?php

namespace App\Exceptions;

use Exception;

class ValidationException extends Exception
{
    /**
     * @var $message
     */
    protected $errors;

    /**
     * Start new ValidatorException
     *
     * @param array $errors
     * @param integer $code
     * @param Exception $previous
     * @return void
     */
    public function __construct($errors, $message = '', $code = 0, Exception $previous = null)
    {
        $this->errors = $errors;
        parent::__construct($message, $code, $previous);
    }

    /**
     * Format the message.
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}