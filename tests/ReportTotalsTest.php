<?php

use App\Reports\Totals;

class ReportTotalsTest extends TestCase
{
    /**
     * @test
     */
    public function total_up_the_entries()
    {
        $entries = [
            0 => (object) ['regularHours' => 5, 'overtimeHours' => 3, 'regularWage' => 300, 'overtimeWage' => 250, 'totalWage' => 550],
            1 => (object) ['regularHours' => 7, 'overtimeHours' => 2, 'regularWage' => 400, 'overtimeWage' => 175, 'totalWage' => 575],
            2 => (object) ['regularHours' => 2, 'overtimeHours' => 5, 'regularWage' => 500, 'overtimeWage' => 1005, 'totalWage' => 1505],
        ];
        $totals = (new Totals($entries))->handle();
        $expected = [
            'regularHoursTotal' => 14,
            'overtimeHoursTotal' => 10,
            'regularWageTotal' => 1200,
            'overtimeWageTotal' => 1430,
            'totalWageTotal' => 2630,
        ];
        $this->assertEquals($expected, $totals);
    }

    /**
     * @test
     */
    public function there_are_no_entries()
    {
        $entries = [];
        $totals = (new Totals($entries))->handle();
        $expected = [
            'regularHoursTotal' => 0,
            'overtimeHoursTotal' => 0,
            'regularWageTotal' => 0,
            'overtimeWageTotal' => 0,
            'totalWageTotal' => 0,
        ];
        $this->assertEquals($expected, $totals);
    }
}
