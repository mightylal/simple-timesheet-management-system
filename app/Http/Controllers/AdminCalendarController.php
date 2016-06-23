<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Calendar\TimeEntries;
use App\Calendar\CalendarFormatter;
use App\Calendar\AdminCalendarQuery;

class AdminCalendarController extends Controller
{
    /**
     * @var AdminCalendarQuery
     */
    private $adminCalendarQuery;

    /**
     * Start new AdminCalendarController.
     *
     * @param AdminCalendarQuery $adminCalendarQuery
     */
    public function __construct(AdminCalendarQuery $adminCalendarQuery)
    {
        $this->adminCalendarQuery = $adminCalendarQuery;
    }

    /**
     * Display the calendar of the times for each user.
     *
     * @param integer $month
     * @param integer $year
     * @return view
     */
    public function index($month = 0, $year = 0)
    {
        $calendarFormatter = new CalendarFormatter;
        $calendar = $calendarFormatter->create($month, $year);
        $entries = $this->adminCalendarQuery->get($calendarFormatter->getMonth(), $calendarFormatter->getYear());
        $calendar['time'] = (new TimeEntries($entries))->handle();
        return view('dashboard.adminCalendar', compact('calendar'));
    }
}
