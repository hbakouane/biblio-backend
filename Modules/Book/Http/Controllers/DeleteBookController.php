<?php

namespace Modules\Book\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Modules\Book\Emails\NotifyCustomersBookHasBeenDeleted as NotifyCustomersBookHasBeenDeletedMail;
use Modules\Book\Entities\Book;
use Modules\Book\Http\Requests\DeleteBookRequest;
use Modules\Book\Jobs\NotifyCustomersBookHasBeenDeleted;
use Modules\Core\Entities\Core;
use Modules\Core\Http\Controllers\CoreController as Controller;
use Modules\Order\Entities\Order;
use Modules\Order\Entities\OrderItem;

class DeleteBookController extends Controller
{
    /**
     * Delete a book
     *
     * @param DeleteBookRequest $request
     * @param Book $book
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function delete(DeleteBookRequest $request, Book $book)
    {
        $this->process($book);

        return $this->success(
            status: 204
        );
    }

    /**
     * Delete the book and its relationships and notify users
     *
     * @param $book
     * @return void
     */
    private function process($book)
    {
        DB::transaction(function () use ($book) {
            $orders = $this->getOrders($book);

            $emails = $this->getCustomersEmails($orders);

            $this->destroy($book);

            $this->updateOrdersPrices($orders);

            $this->notifyDeletionOfBook($book, $emails);
        });
    }

    /**
     * Process deleting a book
     *
     * @param $book
     * @return mixed
     */
    private function destroy($book)
    {
        // Let's delete the book from the order_items table so that it will not belong
        // to any order anymore
        $book->ordersItems()->delete();

        return $book->delete();
    }

    /**
     * Notify that the book has been deleted
     *
     * @param Book $book
     * @param array $emails
     * @return void
     */
    private function notifyDeletionOfBook(Book $book, array $emails)
    {
        NotifyCustomersBookHasBeenDeleted::dispatch($book, $emails)
            ->onQueue(Core::QUEUE_BOOK);
    }

    /**
     * Get all the orders that the book belong to
     *
     *
     * @param Book $book
     * @return array
     */
    private function getOrders(Book $book)
    {
        $ordersItems = $book->ordersItems;

        $orders = [];

        foreach ($ordersItems as $orderItem) {
            if (!in_array($orderItem->order_id, $orders) && $orderItem->order->status === Order::STATUS_PENDING) {
                $orders []= $orderItem->order;
            }
        }

        return $orders;
    }

    /**
     * @param $orders
     * @return array
     */
    private function getCustomersEmails($orders)
    {
        $emails = [];

        foreach ($orders as $order) {
            if (!in_array($order->customer->user->email, $emails)) {
                $emails []= $order->customer->user->email;
            }
        }

        return $emails;
    }

    /**
     * Update the total price of the orders since we deleted
     * an item from the cart
     *
     * @param array $orders
     * @return void
     */
    private function updateOrdersPrices(array $orders)
    {
        foreach ($orders as $order) {
            $order->updateTotal();

            if ($order->total === 0.0) {
                $order->items()->delete();

                $order->delete();
            }
        }
    }
}
