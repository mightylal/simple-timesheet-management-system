<?php

namespace App\Validation;

class UserTimesheetValidator extends Validator
{
    /**
     * User enters in time on calendar.
     *
     * @param array $data
     */
    public function validateEnterTime($data)
    {
        static::$rules = [
            'regularHours' => 'required|numeric',
            'overtimeHours' => 'required|numeric'
        ];
        $this->validate($data);
    }
}