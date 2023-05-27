<?php

namespace Modules\Activity\Http\Traits;

use Illuminate\Database\Eloquent\Relations\MorphTo;

trait ActivityRelationships
{
    /**
     * Get the associated user
     *
     * @return MorphTo
     */
    public function user()
    {
        return $this->morphTo();
    }
}
