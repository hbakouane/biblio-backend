<?php

namespace Modules\Activity\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\User\Transformers\UserResource;

class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user' => $this->getUser(),
            'key' => $this->key,
            'description' => filled($this->extra) ? $this->printDynamicActivity() : __('activities.' . $this->key),
            'extra' => $this->extra
        ];
    }

    /**
     * Get the associated user to the activity
     *
     * @return UserResource
     */
    private function getUser()
    {
        return new UserResource($this->user);
    }
}
