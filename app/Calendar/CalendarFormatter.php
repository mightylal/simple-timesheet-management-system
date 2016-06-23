<?php

namespace App\Calendar;

class CalendarFormatter
{
    /**
     * @var $month
     */
    private $month = 0;

    /**
     * @var $year
     */
    private $year = 0;

    /**
     * Create the calendar.
     *
     * @param string $month
     * @param string $year
     * @return string
     */
    public function create($month, $year)
    {
        $this->verifyDate($month, $year);
        $totalLoop = $this->daysInMonth() + $this->dayOfTheWeek();
        $next = $this->next();
        $previous = $this->previous();
        return [
            'dayOfTheWeek' => $this->dayOfTheWeek(),
            'loop' => $totalLoop,
            'month' => $this->month,
            'year' => $this->year,
            'monthAndYear' => $this->monthAndYear(),
            'nextMonth' => $next['month'],
            'prevMonth' => $previous['month'],
            'nextYear' => $next['year'],
            'prevYear' => $previous['year']
        ];
    }

    /**
     * Get the month.
     *
     * @return integer
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Get the year.
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Get the month and year.
     *
     * @return string
     */
    private function monthAndYear()
    {
        return date('F Y', mktime(0, 0, 0, $this->month, 1, $this->year));
    }

    /**
     * Verify that the date is valid.
     *
     * @param string $month
     * @param string $year
     * @return void
     */
    private function verifyDate($month, $year)
    {
        if (!checkdate($month, 1, $year)) {
            $month = date('n');
            $year = date('Y');
        }
        $this->month = $month;
        $this->year = $year;
    }

    /**
     * Return the number of days in the month.
     *
     * @return integer
     */
    private function daysInMonth()
    {
        return date("t",mktime(0,0,0,$this->month, 1,$this->year));
    }

    /**
     * Return the day of the week.
     *
     * @return integer
     */
    private function dayOfTheWeek()
    {
        return date("w",mktime(0,0,0,$this->month, 1,$this->year));
    }

    /**
     * Retrieve the next month and year.
     *
     * @return array
     */
    private function next()
    {
        $nextMonth = $this->month + 1;
        $time = mktime(0, 0, 0, $nextMonth, 1, $this->year);
        return [
            'month' => date('n', $time),
            'year' => date('Y', $time)
        ];
    }

    /**
     * Retrieve the previous month and year.
     *
     * @return array
     */
    private function previous()
    {
        $prevMonth = $this->month - 1;
        $time = mktime(0, 0, 0, $prevMonth, 1, $this->year);
        return [
            'month' => date('n', $time),
            'year' => date('Y', $time)
        ];
    }
}