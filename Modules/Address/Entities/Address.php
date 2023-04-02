<?php

namespace Modules\Address\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuids;
use Modules\Address\Http\Traits\AddressRelationships;

class Address extends Model
{
    use HasFactory, Uuids, AddressRelationships;


    /**
     * Mass-assignable attributes
     *
     * @var array[]
     */
    protected $fillable = [
        'owner',
        'owner_id',
        'address_line_1',
        'address_line_2',
        'state',
        'city',
        'zip',
        'country_id'
    ];

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

    protected static function newFactory()
    {
        return \Modules\Address\Database\factories\AddressFactory::new();
    }
}
