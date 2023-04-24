<?php

namespace Modules\Profile\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Country\Transformers\CountryResource;
use Modules\User\Transformers\UserResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'dob' => $this->dob,
            'note' => $this->note,
            'website' => $this->website,
            'phone_country_id' => $this->phone_country_id,
            'phone_number' => $this->phone_number,
            'status' => $this->status,
            'last_logged_in' => $this->last_logged_in
        ];

        if ($this->relationLoaded('user')) {
            $data['user'] = $this->getUser();
        }

        if ($this->relationLoaded('country')) {
            $data['country'] = $this->getCountry();
        }

        return $data;
    }

    /**
     * Get the associated profile to the user
     *
     * @return void
     */
    private function getUser()
    {
        $user = $this->user;

        if (! $user) return null;

        return new UserResource($user);
    }

    /**
     * Get the associated country
     *
     * @return void
     */
    private function getCountry()
    {
        $country = $this->country;

        if (! $country) return null;

        return new CountryResource($this->country);
    }
}
