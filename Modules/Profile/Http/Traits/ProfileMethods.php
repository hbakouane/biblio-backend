<?php

namespace Modules\Profile\Http\Traits;

use Modules\User\Entities\User;

trait ProfileMethods
{
    /**
     * Get the active users
     *
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status', User::STATUS_ACTIVE);
    }

    /**
     * Get the inactive users
     *
     * @param $query
     * @return mixed
     */
    public function scopeInactive($query)
    {
        return $query->where('status', User::STATUS_INACTIVE);
    }

    /**
     * Get a random profile
     *
     * @return mixed
     */
    public function random()
    {
        return self::inRandomOrder()
            ->first();
    }

    /**
     * Get the profile's phone number in a good
     * readable format
     *
     * @return string
     */
    public function getPhoneNumberForHumans()
    {
        return $this->country->calling_code . $this->phone_number;
    }
}
