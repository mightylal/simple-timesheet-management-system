<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Calendar\CalendarFormatter;

class CalendarFormatterTest extends TestCase
{
    /**
     * @test
     */
    public function it_returns_an_array_with_the_correct_keys()
    {
        $formatter = new CalendarFormatter;
        $calendar = $formatter->create(0, 0);
        $this->assertArrayHasKey('dayOfTheWeek', $calendar);
        $this->assertArrayHasKey('loop', $calendar);
        $this->assertArrayHasKey('month', $calendar);
        $this->assertArrayHasKey('year', $calendar);
        $this->assertArrayHasKey('monthAndYear', $calendar);
    }

    /**
     * @test
     */
    public function it_returns_the_correct_values_for_the_default_month()
    {
        $formatter = new CalendarFormatter;
        $calendar = $formatter->create(0, 0);
        $dayOfTheWeek = date('w', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $loop = $dayOfTheWeek + date('t');
        $nextTime = $this->nextTime(date('n'), date('Y'));
        $prevTime = $this->previousTime(date('n'), date('Y'));
        $this->assertEquals($dayOfTheWeek, $calendar['dayOfTheWeek']);
        $this->assertEquals($loop, $calendar['loop']);
        $this->assertEquals(date('n'), $calendar['month']);
        $this->assertEquals(date('Y'), $calendar['year']);
        $this->assertEquals(date('F Y'), $calendar['monthAndYear']);
        $this->assertEquals(date('n', $nextTime), $calendar['nextMonth']);
        $this->assertEquals(date('Y', $nextTime), $calendar['nextYear']);
        $this->assertEquals(date('n', $prevTime), $calendar['prevMonth']);
        $this->assertEquals(date('Y', $prevTime), $calendar['prevYear']);
    }

    /**
     * @test
     */
    public function it_returns_the_correct_values_for_may_2016()
    {
        $formatter = new CalendarFormatter;
        $calendar = $formatter->create(5, 2016);
        $time = mktime(0, 0, 0, 5, 1, 2016);
        $dayOfTheWeek = date('w', $time);
        $loop = $dayOfTheWeek + date('t', $time);
        $this->assertEquals($dayOfTheWeek, $calendar['dayOfTheWeek']);
        $this->assertEquals($loop, $calendar['loop']);
        $this->assertEquals(5, $calendar['month']);
        $this->assertEquals(2016, $calendar['year']);
        $this->assertEquals('May 2016', $calendar['monthAndYear']);
    }

    /**
     * @test
     */
    public function it_returns_the_correct_values_for_october_2019()
    {
        $formatter = new CalendarFormatter;
        $calendar = $formatter->create(10, 2019);
        $time = mktime(0, 0, 0, 10, 1, 2019);
        $dayOfTheWeek = date('w', $time);
        $loop = $dayOfTheWeek + date('t', $time);
        $this->assertEquals($dayOfTheWeek, $calendar['dayOfTheWeek']);
        $this->assertEquals($loop, $calendar['loop']);
        $this->assertEquals(10, $calendar['month']);
        $this->assertEquals(2019, $calendar['year']);
        $this->assertEquals('October 2019', $calendar['monthAndYear']);
    }

    /**
     * @test
     */
    public function it_returns_the_correct_values_for_december_2017()
    {
        $formatter = new CalendarFormatter;
        $calendar = $formatter->create(12, 2017);
        $time = mktime(0, 0, 0, 12, 1, 2017);
        $dayOfTheWeek = date('w', $time);
        $loop = $dayOfTheWeek + date('t', $time);
        $this->assertEquals($dayOfTheWeek, $calendar['dayOfTheWeek']);
        $this->assertEquals($loop, $calendar['loop']);
        $this->assertEquals(12, $calendar['month']);
        $this->assertEquals(2017, $calendar['year']);
        $this->assertEquals('December 2017', $calendar['monthAndYear']);
        $this->assertEquals(1, $calendar['nextMonth']);
        $this->assertEquals(2018, $calendar['nextYear']);
        $this->assertEquals(11, $calendar['prevMonth']);
        $this->assertEquals(2017, $calendar['prevYear']);
    }

    /**
     * @test
     */
    public function it_returns_the_correct_values_for_january_2020()
    {
        $formatter = new CalendarFormatter;
        $calendar = $formatter->create(1, 2020);
        $time = mktime(0, 0, 0, 1, 1, 2020);
        $dayOfTheWeek = date('w', $time);
        $loop = $dayOfTheWeek + date('t', $time);
        $this->assertEquals($dayOfTheWeek, $calendar['dayOfTheWeek']);
        $this->assertEquals($loop, $calendar['loop']);
        $this->assertEquals(1, $calendar['month']);
        $this->assertEquals(2020, $calendar['year']);
        $this->assertEquals('January 2020', $calendar['monthAndYear']);
        $this->assertEquals(2, $calendar['nextMonth']);
        $this->assertEquals(2020, $calendar['nextYear']);
        $this->assertEquals(12, $calendar['prevMonth']);
        $this->assertEquals(2019, $calendar['prevYear']);
    }

    /**
     * Determine the next time.
     *
     * @param integer $month
     * @param integer $year
     * @return integer
     */
    private function nextTime($month, $year)
    {
        return mktime(0, 0, 0, $month + 1, 1, $year);
    }

    /**
     * Determine the previous time.
     *
     * @param integer $month
     * @param integer $year
     * @return integer
     */
    private function previousTime($month, $year)
    {
        return mktime(0, 0, 0, $month - 1, 1, $year);
    }

}
