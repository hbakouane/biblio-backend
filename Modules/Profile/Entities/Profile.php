<?php

namespace Modules\Profile\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuids;
use Modules\Address\Http\Traits\HasAddress;
use Modules\Profile\Http\Traits\ProfileMethods;
use Modules\Profile\Http\Traits\ProfileRelationships;

class Profile extends Model
{
    use HasFactory, Uuids, HasAddress, ProfileMethods, ProfileRelationships;

    /**
     * Mass-assignable attributes
     *
     * @var array[]
     */
    protected $fillable = [
        'country_id',
        'dob',
        'note',
        'website',
        'phone_country_id',
        'phone_number',
        'status',
        'last_logged_in'
    ];

    protected static function newFactory()
    {
        return \Modules\Profile\Database\factories\ProfileFactory::new();
    }
}
