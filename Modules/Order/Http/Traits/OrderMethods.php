<?php

namespace Modules\Order\Http\Traits;

use Modules\Book\Entities\Book;
use Modules\Order\Entities\Order;
use Modules\Order\Entities\OrderItem;
use Modules\Order\Jobs\RemindCustomerToCheckoutOrder;
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
     * @return bool
     */
    public function updateTotal()
    {
        return $this->update([
            'total' => $this->items->sum('price')
        ]);
    }

    /**
     * Set up the necessary queue jobs and reminders
     * for the customer
     *
     * @return void
     */
    public function setupQueueJobs()
    {
        // Remind the customer that they have a pending order after 1 day
        // of adding a new item to the order
        for ($i = 1; $i < 3; $i++) {
            RemindCustomerToCheckoutOrder::dispatch($this)
                ->delay(now()->addMinutes($i)); // TODO: Make it addDays
        }
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
            'total' => $total ?? 0,
            'status' => $status
        ]);
    }

    /**
     * Update status of order
     *
     * @param string $status
     * @return void
     */
    public function updateStatus(string $status)
    {
        $this->update([
            'status' => $status
        ]);
    }
}
