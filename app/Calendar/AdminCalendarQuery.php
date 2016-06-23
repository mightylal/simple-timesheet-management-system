<?php

namespace App\Calendar;

use Illuminate\Database\DatabaseManager;

class AdminCalendarQuery
{

    /**
     * @var DatabaseManager
     */
    private $db;

    /**
     * Start new AdminCalendarQuery.
     *
     * @param DatabaseManager $db
     * @return void
     */
    public function __construct(DatabaseManager $db)
    {
        $this->db = $db->connection('mysql');
    }

    /**
     * Retrieve all the time entries given the month and year.
     *
     * @param integer $month
     * @param integer $year
     * @return array
     */
    public function get($month, $year)
    {
        return $this->db->table('appTime')
                        ->join('appUser', 'appTime.user_id', '=', 'appUser.id')
                        ->select('appUser.username AS username', 'appTime.regularHours AS regularHours', 'appTime.overtimeHours AS overtimeHours', 'appTime.workDate AS workDate')
                        ->whereMonth('appTime.workDate', '=', $month)
                        ->whereYear('appTime.workDate', '=', $year)
                        ->get();
    }

}