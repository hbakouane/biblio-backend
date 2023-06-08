<?php

namespace Modules\Book\Http\Observers;

use Illuminate\Support\Facades\Cache;
use Modules\Book\Entities\Book;

class BookObserver
{
    /**
     * Handle the Book "created" event.
     */
    public function created(Book $book): void
    {
        // ...
    }

    /**
     * Handle the Book "updated" event.
     */
    public function updated(Book $book): void
    {
        /*
         * Remind publisher that their book is at a low quantity so that they
         * will be aware of it, then they can increase it
         *
         * we will cache the key related to this book, so we make sure
         * that we have sent the reminder just one time
         */

        $quantityReminderCacheKey = $book->getQuantityReminderCacheKey();

        $quantity = $book->quantity;

        if ((! Cache::get($quantityReminderCacheKey)) && $quantity < 10) {
                $book->remindPublisherOfLowQuantity();

                Cache::put($quantityReminderCacheKey, true);
        }

        if ($quantity === 0) {
            // TODO: Remind the publisher that their book has been out of stock
        }

        if ($book->quantity >= 10 && Cache::get($quantityReminderCacheKey)) {
            Cache::forget($quantityReminderCacheKey);
        }
    }

    /**
     * Handle the Book "deleted" event.
     */
    public function deleted(Book $book): void
    {
        // ...
    }

    /**
     * Handle the Book "restored" event.
     */
    public function restored(Book $book): void
    {
        // ...
    }

    /**
     * Handle the Book "forceDeleted" event.
     */
    public function forceDeleted(Book $book): void
    {
        // ...
    }
}
