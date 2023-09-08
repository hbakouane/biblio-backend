<?php

namespace Modules\Order\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Modules\Book\Entities\Book;
use Modules\Core\Http\Controllers\CoreController as Controller;
use Modules\Order\Entities\Order;
use Modules\Order\Http\Requests\AttachItemsToOrderRequest;
use Modules\Order\Transformers\OrderResource;

class AttachItemsToOrderController extends Controller
{
    /**
     * Attach the given items to the given order
     *
     * @param AttachItemsToOrderRequest $request
     * @param Order $order
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function attach(AttachItemsToOrderRequest $request, Order $order)
    {
        $order = $this->attachItemsToOrder($order, $request);

        return $this->success(
            __('app.order.add.items.attach.attached'),
            new OrderResource($order)
        );
    }

    /**
     * Process attaching items to order
     *
     * @param $order
     * @param $request
     * @return mixed
     */
    private function attachItemsToOrder($order, $request)
    {
        $items = $request->get('items');

        DB::transaction(function () use ($items, $order) {
            foreach ($items as $item) {
                $book = Book::find($item['item_id']);

                $this->checkIfQuantityIsAvailable($item, $book);

                $order->attachItem($item, $book);

                $book->updateQuantity($item['quantity']);
            }

            $order->updateTotal();
        });

        $order->load('items');

        return $order;
    }

    /**
     * Check if the given quantity is available
     *
     * @param mixed $item
     * @param Book $book
     * @return bool
     * @throws ValidationException
     */
    private function checkIfQuantityIsAvailable(mixed $item, Book $book)
    {
        if (!($item['quantity'] <= $book->quantity)) {
            throw ValidationException::withMessages([
                'quantity' => __('app.order.add.items.attach.quantity_not_available'),
                'book_id' => $book->id
            ]);
        }
    }
}
