<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Time;
use App\Calendar\TimeEntries;
use App\Calendar\CalendarFormatter;
use App\Validation\UserTimesheetValidator;

class UserTimesheetService
{

    /**
     * Make the user calendar.
     *
     * @param integer $user_id
     * @param integer $month
     * @param integer $year
     * @return array
     */
    public function calendar($user_id, $month, $year)
    {
        $calendarFormatter = new CalendarFormatter;
        $calendar = $calendarFormatter->create($month, $year);
        $time = new Time();
        $calendar['time'] = (new TimeEntries($time->getByUserMonthAndYear($user_id, $calendarFormatter->getMonth(), $calendarFormatter->getYear())->get()))->handle();
        return $calendar;
    }

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