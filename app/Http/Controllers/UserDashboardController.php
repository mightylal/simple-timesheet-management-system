<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Time;
use App\Calendar\TimeEntries;
use App\Calendar\CalendarFormatter;
use App\Services\UserTimesheetService;
use App\Exceptions\ValidationException;

class UserDashboardController extends Controller
{
    /**
     * @var UserTimesheetService
     */
    private $timesheetService;

    /**
     * Start new UserDashboardController.
     *
     * @param UserTimesheetService $timesheetService
     */
    public function __construct(UserTimesheetService $timesheetService)
    {
        $this->timesheetService = $timesheetService;
    }

    /**
     * User arrives to the dashboard.
     *
     * @param integer $month
     * @param integer $year
     * @return view
     */
    public function index($month = 0, $year = 0)
    {
        $calendarFormatter = new CalendarFormatter;
        $calendar = $calendarFormatter->create($month, $year);
        $calendar['time'] = (new TimeEntries((new Time)->getByUserMonthAndYear($this->userId(), $calendarFormatter->getMonth(), $calendarFormatter->getYear())->get()))->handle();
        return view('dashboard.timesheet', compact('calendar'));
    }

    /**
     * User enters in time.
     *
     * @param Request $request
     * @return response
     */
    public function enterTime(Request $request)
    {
        try {
            $this->timesheetService->enterTime($this->userId(), array_map('trim', $request->only('id', 'regularHours', 'overtimeHours', 'month', 'day', 'year')));
            return json_encode($request->all());
        } catch (ValidationException $error) {
            return json_encode(['errors' => $error->getErrors()]);
        }
    }
}
