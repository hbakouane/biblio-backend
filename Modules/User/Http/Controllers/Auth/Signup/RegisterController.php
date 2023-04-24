<?php

namespace Modules\User\Http\Controllers\Auth\Signup;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Modules\Core\Http\Controllers\CoreController as Controller;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\Auth\Signup\RegisterRequest;
use Modules\User\Transformers\UserResource;

class RegisterController extends Controller
{
    /**
     * Register a new user
     *
     * @param RegisterRequest $request
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function register(RegisterRequest $request)
    {
        $user = $this->process($request);

        return $this->success(
            __('app.auth.register.success'),
            new UserResource($user)
        );
    }

    /**
     * Process registering a new user
     *
     * @param RegisterRequest $request
     * @return mixed
     */
    private function process($request)
    {
        $data = $request->validated();

        return User::createUser(
            $data['first_name'],
            $data['last_name'],
            $data['full_name'],
            $data['email'],
            $data['password']
        );
    }
}
