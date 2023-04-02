<?php

namespace Modules\Profile\Http\Traits;

use Modules\Address\Entities\Address;
use Modules\User\Entities\User;

trait ProfileRelationships
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the related address
     *
     * @return void
     */
    public function address()
    {
        return $this->morphOne(Address::class, 'owner');
    }
}
