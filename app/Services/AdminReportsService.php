<?php

namespace App\Services;

use App\Reports\Totals;
use App\Reports\AdminReportQuery;
use App\Validation\AdminReportValidator;

class AdminReportsService
{

    /**
     * @var AdminReportQuery
     */
    private $adminReportQuery;

    /**
     * Start new AdminReportsService.
     *
     * @param AdminReportQuery $adminReportQuery
     */
    public function __construct(AdminReportQuery $adminReportQuery)
    {
        $this->adminReportQuery = $adminReportQuery;
    }

    /**
     * Generate a report for the given user and time period.
     *
     * @param array $input
     * @return array
     */
    public function generate($input)
    {
        (new AdminReportValidator)->validateReport($input);
        $entries = $this->adminReportQuery->get($input['employee'], $input['startDate'], $input['endDate']);
        $totals = (new Totals($entries))->handle();
        return ['entries' => $entries, 'totals' => $totals];
    }
}