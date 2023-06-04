<?php

namespace Modules\Profile\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Address\Transformers\AddressResource;
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
            'id' => $this->id,
            'dob' => $this->dob,
            'note' => $this->note,
            'website' => $this->website,
            'phone_country_id' => $this->phone_country_id,
            'phone_number' => $this->phone_number,
            'status' => $this->status,
            'last_logged_in' => $this->last_logged_in,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];

        if ($this->relationLoaded('user')) {
            $data['user'] = $this->getUser();
        }

        if ($this->relationLoaded('country')) {
            $data['country'] = $this->getCountry();
        }

        if ($this->relationLoaded('address')) {
            $data['address'] = $this->getAddress();
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

    /**
     * Get the associated address of the profile
     *
     * @return AddressResource|null
     */
    private function getAddress()
    {
        $address = $this->address;

        if (! $address) return null;

        return new AddressResource($address);
    }
}
