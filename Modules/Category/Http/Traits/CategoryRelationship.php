<?php

namespace Modules\Category\Http\Traits;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Profile\Entities\Profile;

trait CategoryRelationship
{
    /**
     * Get the creator of this category
     *
     * @return HasOne
     */
    public function profile()
    {
        return $this->hasOne(
            Profile::class,
            'id',
            'created_by'
        );
    }
}
