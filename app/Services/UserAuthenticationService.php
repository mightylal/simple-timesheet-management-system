<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use App\Exceptions\ValidationException;
use App\Validation\UserAuthenticationValidator;

class UserAuthenticationService
{

    /**
     * @var Guard
     */
    private $auth;

    /**
     * Start new UserAuthenticationService.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Try to log in the user given the input.
     *
     * @param array $input
     * @throws ValidationException if login attempt fails
     */
    public function login($input)
    {
        (new UserAuthenticationValidator)->validateLoginForm($input);
        if ($this->auth->attempt(['username' => $input['username'], 'password' => $input['password']])) {
            $this->checkIfPasswordNeedsRehash($input['password']);
            return;
        }
        throw new ValidationException('Login attempt failed.');
    }

    /**
     * Check to see if the user password needs to be rehashed.
     *
     * @param string $password
     */
    private function checkIfPasswordNeedsRehash($password)
    {
        if (password_needs_rehash($password, PASSWORD_DEFAULT)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $user = (new User)->find($this->auth->id());
            $user->password = $hash;
            $user->save();
        }
    }

    /**
     * User logs out.
     */
    public function logout()
    {
        $this->auth->logout();
    }

}