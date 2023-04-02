<?php

namespace Modules\Order\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Book\Entities\Book;
use Modules\Order\Entities\Order;

class OrderBookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Order\Entities\OrderBook::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $book = Book::random();

        return [
            'order_id' => Order::random()->id,
            'book_id' => $book->id,
            'price' => $book->price,
            'quantity' => number_format($book->quantity * 0.1)
        ];
    }
}

