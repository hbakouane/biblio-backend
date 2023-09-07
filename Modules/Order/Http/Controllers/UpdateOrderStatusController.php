<?php

namespace Modules\Order\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\CoreController as Controller;
use Modules\Order\Entities\Order;
use Modules\Order\Http\Requests\UpdateOrderStatusRequest;
use Modules\Order\Transformers\OrderResource;

class UpdateOrderStatusController extends Controller
{
    /**
     * Update status of order
     *
     * @param Order $order
     * @param UpdateOrderStatusRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    public function update(Order $order, UpdateOrderStatusRequest $request)
    {
        $this->updateStatus($order, $request);

        return $this->success(
            __('app.order.update.status.updated'),
            new OrderResource($order)
        );
    }

    /**
     * Process updating the status of the order
     *
     * @param $order
     * @param $request
     * @return void
     */
    private function updateStatus($order, $request)
    {
        $order->updateStatus($request->get('status'));
    }
}
