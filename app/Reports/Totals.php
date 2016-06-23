<?php

namespace App\Reports;

class Totals
{
    /**
     * @var $entries;
     */
    private $entries;

    /**
     * @var $totals
     */
    private $totals = [
        'regularHoursTotal' => 0,
        'overtimeHoursTotal' => 0,
        'regularWageTotal' => 0,
        'overtimeWageTotal' => 0,
        'totalWageTotal' => 0,
    ];
    
    /**
     * Start new Totals.
     *
     * @var array $entries
     */
    public function __construct($entries)
    {
        $this->entries = $entries;
    }

    /**
     * Total the entries.
     *
     * @return array
     */
    public function handle()
    {
        if (is_array($this->entries)) {
            foreach ($this->entries as $entry) {
                $this->totals['regularHoursTotal'] += $entry->regularHours;
                $this->totals['overtimeHoursTotal'] += $entry->overtimeHours;
                $this->totals['regularWageTotal'] += $entry->regularWage;
                $this->totals['overtimeWageTotal'] += $entry->overtimeWage;
                $this->totals['totalWageTotal'] += $entry->totalWage;
            }
        }
        return $this->totals;
    }

}