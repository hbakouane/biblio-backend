<?php

namespace Modules\Book\Http\Traits;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Profile\Entities\Profile;

trait BookRelationships
{
    /**
     * Get the publisher of the book
     *
     * @return HasOne
     */
    public function publisher()
    {
        return $this->hasOne(
            Profile::class,
            'id',
            'published_by'
        );
    }
}
