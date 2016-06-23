<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Services\AdminService;
use App\Exceptions\ValidationException;
use App\Models\User;

class AdminDashboardController extends Controller
{
    /**
     * @var AdminService
     */
    private $adminService;

    /**
     * Start new AdminDashboardController.
     *
     * @param AdminService $adminService
     * @return void
     */
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    /**
     * Display the admin view.
     *
     * @return view
     */
    public function index()
    {
        $employees = (new User)->all(['id', 'username']);
        return view('dashboard.admin', compact('employees'));
    }

    /**
     * Admin creates a user.
     *
     * @param Request $request
     * @return response
     */
    public function createUser(Request $request)
    {
        try {
            $this->adminService->createUser(array_map('trim', $request->only('username', 'password', 'regularRate', 'overtimeRate')));
            return redirect()->route('admin')->with('message', 'User created successfully.');
        } catch (ValidationException $error) {
            return redirect()->route('admin')->withErrors($error->getErrors());
        }
    }

    /**
     * Update the user rates.
     *
     * @param Request $request
     * @return response
     */
    public function updateRates(Request $request)
    {
        try {
            $this->adminService->updateRates(array_map('trim', $request->only('employee', 'regularRate', 'overtimeRate')));
            return redirect()->route('admin')->with('message', 'Employee rates updated successfully.');
        } catch (ValidationException $error) {
            return redirect()->route('admin')->withErrors($error->getErrors());
        }
    }

    /**
     * Get the employee rate info.
     *
     * @param Request $request
     * @return json
     */
    public function employeeRates(Request $request)
    {
        $user = (new User)->find($request->only('id'), ['regularRate', 'overtimeRate']);
        return json_encode($user);
    }

    /**
     * Get the employee hours.
     *
     * @param Request $request
     * @return json
     */
    public function getEmployeeTime(Request $request)
    {
        try {
            return json_encode($this->adminService->employeeHours(array_map('trim', $request->only('user_id', 'workDate'))));
        } catch (ValidationException $error) {
            return json_encode(['errors' => $error->getErrors()]);
        }
    }

    /**
     * Update the employee hours.
     *
     * @param Request $request
     * @return response
     */
    public function updateHours(Request $request)
    {
        try {
            $this->adminService->updateHours(array_map('trim', $request->only('employee', 'workDate', 'regularHours', 'overtimeHours')));
            return redirect()->route('admin')->with('message', 'Employee hours updated successfully!');
        } catch (ValidationException $error) {
            return redirect()->route('admin')->withErrors($error->getErrors());
        }
    }
}
