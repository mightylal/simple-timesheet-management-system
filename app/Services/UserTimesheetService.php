<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Time;
use App\Validation\UserTimesheetValidator;

class UserTimesheetService
{
    /**
     * User enters time.
     *
     * @param integer $user_id
     * @param array $input
     */
    public function enterTime($user_id, $input)
    {
        (new UserTimesheetValidator)->validateEnterTime($input);
        $date = Carbon::createFromDate($input['year'], $input['month'], $input['day']);
        $time = (new Time)->firstOrNew(['user_id' => $user_id, 'workDate' => $date->toDateString()]);
        $time->regularHours = $input['regularHours'];
        $time->overtimeHours = $input['overtimeHours'];
        $time->save();
    }

}