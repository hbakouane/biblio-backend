<?php

namespace Modules\Activity\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Modules\Activity\Entities\Activity;
use Modules\Activity\Http\Requests\ListActivitiesRequest;
use Modules\Activity\Transformers\ActivityResource;
use Modules\Core\Http\Controllers\CoreController as Controller;

class ListActivitiesController extends Controller
{
    /**
     * List all the activities that we have in the DB
     *
     * @param ListActivitiesRequest $request
     * @return mixed
     */
    public function list(ListActivitiesRequest $request)
    {
        $activities = $this->getActivities();

        return $this->data([
            'activities' => ActivityResource::collection($activities)
        ]);
    }

    /**
     * Process getting all the activities
     *
     * @return Builder
     */
    private function getActivities()
    {
        return Activity::query()
            ->get();
    }
}
