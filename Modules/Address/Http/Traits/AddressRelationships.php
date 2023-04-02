<?php

namespace Modules\Address\Http\Traits;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Modules\Country\Entities\Country;

trait AddressRelationships
{
    /**
     * Associate the address to a model
     *
     * @return MorphTo
     */
    public function owner()
    {
        return $this->morphTo();
    }


    /**
     * Get the associated country
     *
     * @return HasOne
     */
    public function country()
    {
        return $this->hasOne(
            Country::class,
            'code',
            'country_id'
        );
    }
}
