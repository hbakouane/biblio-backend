<?php

namespace Modules\Order\Http\Traits;

trait OrderMethods
{
    /**
     * Get order statuses
     *
     * @return array
     */
    public static function getStatuses()
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_PAID,
            self::STATUS_CANCELLED
        ];
    }


    /**
     * Get a random order object
     *
     * @return mixed
     */
    public static function random()
    {
        return self::inRandomOrder()
            ->first();
    }
}
