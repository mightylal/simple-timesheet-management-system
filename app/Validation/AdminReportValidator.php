<?php

namespace App\Validation;

class AdminReportValidator extends Validator
{

    /**
     * Validate generating a new report.
     *
     * @param array $data
     */
    public function validateReport($data)
    {
        self::$rules = [
            'employee' => 'required',
            'startDate' => 'required|date_format:Y-m-d',
            'endDate' => 'required|date_format:Y-m-d'
        ];
        if ($data['employee'] != 0) {
            self::$rules['employee'] = 'required|exists:appUser,id';
        }
        $this->validate($data);
    }

}