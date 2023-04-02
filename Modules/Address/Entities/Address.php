<?php

namespace Modules\Address\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuids;
use Modules\Address\Http\Traits\AddressMethods;
use Modules\Address\Http\Traits\AddressRelationships;

class Address extends Model
{
    use HasFactory, Uuids, AddressRelationships,
        AddressMethods;

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

    protected static function newFactory()
    {
        return \Modules\Address\Database\factories\AddressFactory::new();
    }
}
