<?php

namespace Modules\Order\Http\Traits;

use Modules\Order\Entities\Order;
use Modules\Profile\Entities\Profile;

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

    /**
     * Create a new order
     *
     * @param Profile|int $customer
     * @param int $total
     * @param string $status
     * @return mixed
     */
    public static function createOrder(
        Profile|string      $customer,
        int                 $total,
        string              $status = Order::STATUS_PENDING
    )
    {
        return Order::create([
            'customer' => $customer instanceof Profile ? $customer->id : $customer,
            'total' => $total,
            'status' => $status
        ]);
    }
}
