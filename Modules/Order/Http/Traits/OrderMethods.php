<?php

namespace Modules\Order\Http\Traits;

use Modules\Book\Entities\Book;
use Modules\Order\Entities\Order;
use Modules\Order\Entities\OrderItem;
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
     * Attach an item to an order
     *
     * @param $item
     * @param $book
     * @return mixed
     */
    public function attachItem($item, $book)
    {
        return OrderItem::createOrderItem(
            $book,
            $this,
            $book->price, // Save the current price of the item
            $item['quantity']
        );
    }

    /**
     * Update the total price of an order
     *
     * @param float $total
     * @return bool
     */
    public function updateTotal()
    {
        return $this->update([
            'total' => $this->items->sum('price')
        ]);
    }

    /**
     * Create a new order
     *
     * @param Profile|string $customer
     * @param float $total
     * @param string $status
     * @return mixed
     */
    public static function createOrder(
        Profile|string          $customer,
        float                   $total,
        string                  $status = Order::STATUS_PENDING
    )
    {
        return Order::create([
            'customer_id' => $customer instanceof Profile ? $customer->id : $customer,
            'total' => $total,
            'status' => $status
        ]);
    }
}
