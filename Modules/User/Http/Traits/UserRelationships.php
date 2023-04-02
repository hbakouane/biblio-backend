<?php

namespace Modules\User\Http\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Profile\Entities\Profile;

trait UserRelationships
{
    /**
     * Get the related profile object
     *
     * @return BelongsTo
     */
    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id');
    }
}
