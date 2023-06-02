<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Core\Http\Controllers\CoreController as Controller;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\ShowUserRequest;
use Modules\User\Transformers\UserResource;

class ShowUserController extends Controller
{
    /**
     * Fetch user information
     *
     * @param ShowUserRequest $request
     * @param User $user
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function show(ShowUserRequest $request, User $user)
    {
        $user = $this->fetchUser($user);

        return $this->data([
            'user' => new UserResource($user)
        ]);
    }

    /**
     * Load user's relationships
     *
     * @param User $user
     * @return User
     */
    private function fetchUser(User $user)
    {
        return $user->load(['profile.address']);
    }
}
