<?php

namespace Modules\Order\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Book\Entities\Book;
use Modules\Order\Database\factories\OrderItemFactory;
use Modules\Order\Database\factories\OrderFactory;
use Modules\Order\Entities\Order;
use Modules\Order\Entities\OrderItem;

class OrderDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        for ($i = 0; $i < 3; $i++) {
            $this->createOrder(
                app(OrderFactory::class)->definition(), $i
            );
            $this->createOrderItem(
                app(OrderItemFactory::class)->definition(), $i
            );
        }
    }

    /**
     * Create a new order
     *
     * @param array $definition
     * @param int $i
     * @return mixed
     */
    protected function createOrder(array $definition, int $i)
    {
        $order = Order::createOrder(
            $definition['customer_id'],
            $definition['total']
        );

        if (isset($definition['note'])) {
            $order->update([
                'note' => $definition['note']
            ]);
        }

        return $order;
    }

    /**
     * Create a new order item
     *
     * @param array $definition
     * @param int $i
     * @return mixed
     */
    protected function createOrderItem(array $definition, int $i)
    {
        return OrderItem::createOrderItem(
            $definition['item'],
            $definition['order_id'],
            $definition['price'],
            $definition['quantity']
        );
    }
}
