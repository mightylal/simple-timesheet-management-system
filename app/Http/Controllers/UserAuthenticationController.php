<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Exceptions\ValidationException;
use App\Services\UserAuthenticationService;

class UserAuthenticationController extends Controller
{
    /**
     * @var UserAuthenticationService
     */
    private $userAuthenticationService;

    /**
     * Start new UserAuthenticationController.
     *
     * @param UserAuthenticationService $userAuthenticationService
     */
    public function __construct(UserAuthenticationService $userAuthenticationService)
    {
        $this->userAuthenticationService = $userAuthenticationService;
    }

    /**
     * Show the login screen.
     *
     * @return view
     */
    public function index()
    {
        return view('login');
    }

    /**
     * User attempts to login.
     *
     * @param Request $request
     * @return response
     */
    public function login(Request $request)
    {
        try {
            $this->userAuthenticationService->login(array_map('trim', $request->only('username', 'password')));
            return redirect()->route('dashboard');
        } catch (ValidationException $error) {
            return redirect()->route('login')->withErrors($error->getErrors());
        }
    }

    /**
     * User signs out.
     *
     * @return reponse
     */
    public function logout()
    {
        $this->userAuthenticationService->logout();
        return redirect()->route('login');
    }
}
