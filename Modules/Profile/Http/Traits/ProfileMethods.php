<?php

namespace Modules\Profile\Http\Traits;

use Carbon\Carbon;
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
    public static function random()
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

    /**
     * Get the age of the profile's owner
     *
     * @return int
     */
    public function getAge()
    {
        return Carbon::parse($this->dob)
            ->diffInYears();
    }

    public function getLastLoginDate()
    {
        return Carbon::parse($this->last_logged_in)
            ->diffForHumans();
    }

    /**
     * Create a new profile
     *
     * @param string $userId
     * @return mixed
     */
    public static function createProfile(
        string $userId
    )
    {
        return self::create([
            'user_id' => $userId
        ]);
    }
}
