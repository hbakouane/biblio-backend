<?php

namespace Modules\User\Http\Controllers\Auth\Login;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\User\Http\Requests\Auth\Login\LoginRequest;
use Modules\Core\Http\Controllers\CoreController as Controller;

class LoginController extends Controller
{
    /**
     * Try to login with the given credentials
     *
     * @param LoginRequest $request
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function login(LoginRequest $request)
    {
        $attempt = $this->attempt($request);

        if (!$attempt) return $this->invalid(__('app.auth.login.failure'));
        // TODO: return a Bearer token
        return $this->success(
            __('app.auth.login.success')
        );
    }

    /**
     * Process the login with the given credentials
     *
     * @param LoginRequest $request
     * @return bool
     */
    private function attempt(LoginRequest $request)
    {
        $data = $request->validated();

        return Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password']
        ], $request->remember_me);
    }
}