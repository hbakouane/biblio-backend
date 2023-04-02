<?php

namespace Modules\Address\Http\Traits;

use Illuminate\Database\Eloquent\Model;

trait AddressMethods
{
    /**
     * Create a new address
     *
     * @param Model $model
     * @param $addressLine1
     * @param $state
     * @param $city
     * @param $zip
     * @param $countryId
     * @return void
     */
    public static function createAddress(
        Model $model,
              $addressLine1,
              $state,
              $city,
              $zip,
              $countryId
    )
    {
        return self::create([
            'owner_type' => $model::class,
            'owner_id' => $model->id,
            'address_line_1' => $addressLine1,
            'state' => $state,
            'city' => $city,
            'zip' => $zip,
            'country_id' => $countryId
        ]);
    }
}
