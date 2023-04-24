<?php

namespace Modules\User\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Profile\Transformers\ProfileResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];

        if ($this->relationLoaded('profile')) {
            $data['profile'] = $this->getProfile();
        }

        return $data;
    }

    /**
     * Get the associated profile of the user
     *
     * @return ProfileResource|null
     */
    private function getProfile()
    {
        $profile = $this->profile;

        if (! $profile) return null;

        return new ProfileResource($this->profile);
    }
}
