<?php

use App\Calendar\TimeEntries;

class CalendarTimeEntriesTest extends TestCase
{
    /**
     * @test
     */
    public function formats_time_entries_for_calendar_without_username()
    {
        $entries = [
            0 => (object) ['workDate' => '2016-06-17', 'regularHours' => 5, 'overtimeHours' => 10],
            1 => (object) ['workDate' => '2016-06-24', 'regularHours' => 12, 'overtimeHours' => 2],
            2 => (object) ['workDate' => '2016-06-25', 'regularHours' => 2, 'overtimeHours' => 10],
        ];
        $time = (new TimeEntries($entries))->handle();
        $expected = [
            17 => [['regularHours' => 5, 'overtimeHours' => 10]],
            24 => [['regularHours' => 12, 'overtimeHours' => 2]],
            25 => [['regularHours' => 2, 'overtimeHours' => 10]],
        ];
        $this->assertEquals($expected, $time);
    }

    /**
     * @test
     */
    public function formats_time_entries_for_calendar_with_username()
    {
        $entries = [
            0 => (object) ['username' => 'userone', 'workDate' => '2016-06-17', 'regularHours' => 5, 'overtimeHours' => 10],
            1 => (object) ['username' => 'usertwo', 'workDate' => '2016-06-17', 'regularHours' => 7, 'overtimeHours' => 5],
            2 => (object) ['username' => 'usertwo', 'workDate' => '2016-06-24', 'regularHours' => 12, 'overtimeHours' => 2],
            3 => (object) ['username' => 'usertwo', 'workDate' => '2016-06-25', 'regularHours' => 2, 'overtimeHours' => 10],
        ];
        $time = (new TimeEntries($entries))->handle();
        $expected = [
            17 => [
                ['username' => 'userone', 'regularHours' => 5, 'overtimeHours' => 10],
                ['username' => 'usertwo', 'regularHours' => 7, 'overtimeHours' => 5],
            ],
            24 => [
                ['username' => 'usertwo', 'regularHours' => 12, 'overtimeHours' => 2],
            ],
            25 => [
                ['username' => 'usertwo', 'regularHours' => 2, 'overtimeHours' => 10],
            ],
        ];
        $this->assertEquals($expected, $time);
    }
}
