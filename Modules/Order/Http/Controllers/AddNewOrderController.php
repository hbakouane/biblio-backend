<?php

namespace Modules\Order\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Core\Http\Controllers\CoreController as Controller;
use Modules\Order\Entities\Order;
use Modules\Order\Http\Requests\AddNewOrderRequest;
use Modules\Order\Transformers\OrderResource;

class AddNewOrderController extends Controller
{
    /**
     * Add a new order
     *
     * @param AddNewOrderRequest $request
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function add(AddNewOrderRequest $request)
    {
        $order = $this->addOrder($request);

        return $this->success(
            __('app.order.add.added'),
            new OrderResource($order)
        );
    }

    /**
     * Process creating a new order
     *
     * @param AddNewOrderRequest $request
     * @return mixed
     */
    private function addOrder(AddNewOrderRequest $request)
    {
        DB::transaction(function () use (&$order, $request) {
            $order = Order::createOrder(
                $request->get('customer_id'),
                0
            );

            $order->update([
                'note' => $request->get('note')
            ]);

            $order->setupQueueJobs();
        });

        $order->load([
            'items',
            'customer.user',
            'customer.address'
        ]);

        return $order;
    }
}
