<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Services\AdminReportsService;
use App\Models\User;
use App\Exceptions\ValidationException;

class AdminReportsController extends Controller
{
    /**
     * @var AdminReportsService
     */
    private $adminReportsService;

    /**
     * Start new AdminReportsController.
     *
     * @param AdminReportsService $adminReportsService
     */
    public function __construct(AdminReportsService $adminReportsService)
    {
        $this->adminReportsService = $adminReportsService;
    }

    /**
     * Admin can generate a report.
     *
     * @return view
     */
    public function index()
    {
        $employees = (new User)->all(['id', 'username']);
        return view('dashboard.adminReports', compact('employees'));
    }

    /**
     * Admin generates a report.
     *
     * @param Request $request
     * @return mixed
     */
    public function generate(Request $request)
    {
        try {
            $results = $this->adminReportsService->generate(array_map('trim', $request->only('employee', 'startDate', 'endDate')));
            $employees = (new User)->all(['id', 'username']);
            return view('dashboard.adminReports', compact('results', 'employees'));
        } catch (ValidationException $error) {
            return redirect()->route('admin.reports')->withErrors($error->getErrors());
        }
    }
}
