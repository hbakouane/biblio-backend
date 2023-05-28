<?php

namespace Modules\Activity\Http\Controllers;

use Modules\Activity\Transformers\ActivityResource;
use Modules\User\Entities\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Activity\Entities\Activity;
use Modules\Activity\Http\Requests\AddActivityRequest;
use Modules\Core\Http\Controllers\CoreController as Controller;

class AddActivityController extends Controller
{
    /**
     * Add a new activity
     *
     * @param AddActivityRequest $request
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function add(AddActivityRequest $request)
    {
        $activity = $this->addActivity($request);

        return $this->success(
            __('app.activity.add.added'),
            new ActivityResource($activity)
        );
    }

    /**
     * Process adding a new activity
     *
     * @param $request
     * @return mixed
     */
    private function addActivity($request)
    {
        $user = User::find($request->get('user_id'));

        return Activity::createActivity(
            $user,
            $request->get('key'),
            $request->get('extra') ?? []
        );
    }
}
