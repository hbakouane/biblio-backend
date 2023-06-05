<?php

namespace Modules\Order\Http\Traits;

use Illuminate\Database\Eloquent\Model;
use Modules\Book\Entities\Book;
use Modules\Order\Entities\Order;
use Modules\Order\Entities\OrderItem;

trait OrderItemsMethods
{
    /**
     * Create a new order item
     *
     * @param Book|Model $item
     * @param string|Order $order
     * @param int $price
     * @param int $quantity
     * @return mixed
     */
    public static function createOrderItem(
        Book|Model              $item,
        string|Order            $order,
        int                     $price,
        int                     $quantity
    )
    {
        return OrderItem::create([
            'item_type' => $item::class,
            'item_id' => $item->id,
            'order_id' => $order instanceof Order ? $order->id : $order,
            'price' => $price,
            'quantity' => $quantity
        ]);
    }
}
