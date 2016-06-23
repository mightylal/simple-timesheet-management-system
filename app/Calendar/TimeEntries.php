<?php

namespace App\Calendar;

class TimeEntries
{
    
    /**
     * @var $entries
     */
    private $entries;
    
    /**
     * Start new TimeEntries.
     * 
     * @param array $entries
     */
    public function __construct($entries)
    {
        $this->entries = $entries;
    }
    
    /**
     * Process the time entries so that they can be viewed on calendar.
     * 
     * @return array
     */
    public function handle()
    {
        $time = [];
        foreach ($this->entries as $entry) {
            $date = date_parse($entry->workDate);
            $values = ['regularHours' => $entry->regularHours, 'overtimeHours' => $entry->overtimeHours];
            if (isset($entry->username)) {
                $values = array_merge(['username' => $entry->username], $values);
            }
            $time[$date['day']][] = $values;
        }
        return $time;
    }
    
}