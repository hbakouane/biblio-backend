<?php

namespace Modules\Profile\Http\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Address\Entities\Address;
use Modules\User\Entities\User;

trait ProfileRelationships
{
    /**
     * Get the associated user
     *
     * @return BelongsTo
     */
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
