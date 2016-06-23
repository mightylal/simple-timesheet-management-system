<?php

namespace App\Validation;

class AdminValidator extends Validator
{

    /**
     * Admin creates new user.
     *
     * @param array $data
     */
    public function validateCreateUser($data)
    {
        self::$rules = [
            'username' => 'required',
            'password' => 'required',
            'regularRate' => 'required|numeric',
            'overtimeRate' => 'required|numeric'
        ];
        $this->validate($data);
    }

    /**
     * Admin updates employee rates.
     *
     * @param array $data
     */
    public function validateUpdateRates($data)
    {
        self::$rules = [
            'employee' => 'required|exists:appUser,id',
            'regularRate' => 'required|numeric',
            'overtimeRate' => 'required|numeric'
        ];
        $this->validate($data);
    }

    /**
     * Admin selects the employee and date to retrieve hour info.
     *
     * @param array $data
     */
    public function validateEmployeeHours($data)
    {
        self::$rules = [
            'user_id' => 'required|exists:appTime,user_id,workDate,' . $data['workDate'],
            'workDate' => 'required|date_format:Y-m-d'
        ];
        self::$messages['user_id.exists'] = 'There is no time entered by the user for the given time.';
        $this->validate($data);
    }

    /**
     * Admin updates the employee hours.
     *
     * @param array $data
     */
    public function validateUpdateEmployeeHours($data)
    {
        self::$rules = [
            'employee' => 'required|exists:appTime,user_id,workDate,' . $data['workDate'],
            'workDate' => 'required|date_format:Y-m-d',
            'regularHours' => 'required|numeric',
            'overtimeHours' => 'required|numeric'
        ];
        self::$messages['employee.exists'] = 'There is no time entered by the user for the given time.';
        $this->validate($data);
    }

}