<?php

namespace App\Reports;

use Illuminate\Database\DatabaseManager;

class AdminReportQuery
{

    /**
     * @var DatabaseManager
     */
    private $db;

    /**
     * Start new AdminReportQuery.
     *
     * @param DatabaseManager $db
     */
    public function __construct(DatabaseManager $db)
    {
        $this->db = $db->connection('mysql');
    }

    /**
     * Retrieve the entered time for the given user, start date, and end date.
     *
     * @param integer $user_id
     * @param string $startDate
     * @param string $endDate
     * @return array
     */
    public function get($user_id, $startDate, $endDate)
    {
        $query = $this->db->table('appTime')
                        ->join('appUser', 'appTime.user_id', '=', 'appUser.id')
                        ->select('appUser.username AS username', 'appUser.regularRate AS regularRate', 'appUser.overtimeRate AS overtimeRate', 'appTime.workDate AS workDate', 'appTime.regularHours AS regularHours', 'appTime.overtimeHours AS overtimeHours')
                        ->selectRaw('(regularHours * regularRate) AS regularWage, (overtimeHours * overtimeRate) AS overtimeWage, (regularHours * regularRate) + (overtimeHours * overtimeRate) AS totalWage')
                        ->whereBetween('appTime.workDate', [$startDate, $endDate])
                        ->orderBy('appTime.workDate', 'asc');
        if ($user_id != 0) {
            $query->where('appUser.id', $user_id);
        }
        return $query->get();
    }

}