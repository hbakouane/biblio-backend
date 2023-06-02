<?php

namespace Modules\Order\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Book\Entities\Book;
use Modules\Order\Entities\Order;

class OrderItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Order\Entities\OrderItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $item = Book::random();

        return [
            'item_type' => $item::class,
            'item_id' => $item->id,
            'item' => $item,
            'order_id' => Order::random()->id,
            'price' => $item->price,
            'quantity' => number_format($item->quantity * 0.1)
        ];
    }
}

