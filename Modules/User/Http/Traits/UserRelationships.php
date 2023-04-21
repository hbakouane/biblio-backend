<?php

namespace Modules\User\Http\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Profile\Entities\Profile;

trait UserRelationships
{
    /**
     * Get the related profile object
     *
     * @return HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id');
    }
}
