<?php

namespace Modules\User\Http\Traits;

trait UserMethods
{
    /**
     * Get all the possible statuses for
     * the user model
     *
     * @return array
     */
    public static function getStatuses()
    {
        return [
            self::STATUS_ACTIVE,
            self::STATUS_INACTIVE
        ];
    }

    /**
     * Get a random user
     *
     * @return mixed
     */
    public static function random()
    {
        return self::inRandomOrder()
            ->first();
    }
}
