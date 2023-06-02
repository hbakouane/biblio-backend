<?php

namespace Modules\Address\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Country\Entities\Country;
use Modules\Country\Transformers\CountryResource;

class AddressResource extends JsonResource
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
            'address_line_1' => $this->address_line_1,
            'address_line_2' => $this->address_line_2,
            'state' => $this->state,
            'city' => $this->city,
            'zip' => $this->zip
        ];

        $data['full_address'] = $this->print();

        if ($this->country_id) {
            $this->load('country');
        }

        if ($this->relationLoaded('country')) {
            $data['country'] = $this->getCountry();
        }

        return $data;
    }

    /**
     * Get the associated country
     *
     * @return CountryResource|null
     */
    private function getCountry()
    {
        $country = $this->country;

        if (! $country) return null;

        return new CountryResource($country);
    }
}
