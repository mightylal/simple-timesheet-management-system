<?php

namespace App\Services;

use App\Models\User;
use App\Models\Time;
use App\Validation\AdminValidator;

class AdminService
{

    /**
     * Create a new user.
     *
     * @param array $input
     */
    public function createUser($input)
    {
        (new AdminValidator)->validateCreateUser($input);
        $input['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
        (new User)->create($input);
    }

    /**
     * Update the employee rates.
     *
     * @param array $input
     */
    public function updateRates($input)
    {
        (new AdminValidator)->validateUpdateRates($input);
        $user = (new User)->find($input['employee']);
        $user->regularRate = $input['regularRate'];
        $user->overtimeRate = $input['overtimeRate'];
        $user->save();
    }

    /**
     * Retrieve the employee hours.
     *
     * @param array $input
     * @return array
     */
    public function employeeHours($input)
    {
        (new AdminValidator)->validateEmployeeHours($input);
        return (new Time)->getByUserAndDate($input['user_id'], $input['workDate'])->first()->toArray();
    }

    /**
     * Admin updates employee hours.
     *
     * @param array $input
     */
    public function updateHours($input)
    {
        (new AdminValidator)->validateUpdateEmployeeHours($input);
        $time = (new Time)->where('user_id', $input['employee'])->whereDate('workDate', '=', $input['workDate'])->first();
        $time->regularHours = $input['regularHours'];
        $time->overtimeHours = $input['overtimeHours'];
        $time->save();
    }

}