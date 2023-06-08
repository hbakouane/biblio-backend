<?php

namespace Modules\Book\Http\Traits;

use Modules\Book\Database\factories\BookFactory;
use Modules\Book\Entities\Book;
use Modules\Book\Jobs\RemindPublisherOfLowQuantity;
use Modules\Category\Entities\Category;
use Modules\Profile\Entities\Profile;

trait BookMethods
{
    /**
     * Get the book statuses
     *
     * @return array
     */
    public static function getStatuses()
    {
        return [
            self::STATUS_PUBLISHED,
            self::STATUS_UNPUBLISHED,
            self::STATUS_OUT_OF_STOCK
        ];
    }

    /**
     * Get a random book object
     *
     * @return mixed
     */
    public static function random()
    {
        return self::inRandomOrder()
            ->first();
    }

    /**
     * Get a unique cache key for the book reminder, so
     * we can be based on it, and we don't send the reminder
     * more than one time
     *
     * @return string
     */
    public function getQuantityReminderCacheKey()
    {
        return "book_$this->id:quantity_reminder_notification_sent";
    }

    /**
     * Remind the publisher of the low quantity of their book
     *
     * @return void
     */
    public function remindPublisherOfLowQuantity()
    {
        RemindPublisherOfLowQuantity::dispatch($this)
            ->delay(now()->addMinute());
    }

    /**
     * Update quantity of a book
     *
     * @param $quantity
     * @return bool
     */
    public function updateQuantity($quantity)
    {
        $data = [
            'quantity' => (int) $this->quantity - $quantity
        ];

        if ($this->quantity === 0) $data['status'] = self::STATUS_OUT_OF_STOCK;

        return $this->update($data);
    }

    /**
     * Create a new book
     *
     * @param string $title
     * @param string $author
     * @param Category|string $category
     * @param float $price
     * @param int $quantity
     * @param Profile|string $publisher
     * @return mixed
     */
    public static function createBook(
        string                  $title,
        string                  $author,
        Category|string         $category,
        float                   $price,
        int                     $quantity,
        Profile|string          $publisher
    )
    {
        return Book::create([
            'title' => $title,
            'author' => $author,
            'category_id' => $category instanceof Category ? $category->id : $category,
            'price' => $price,
            'quantity' => $quantity,
            'published_by' => $publisher instanceof Profile ? $publisher->id : $publisher
        ]);
    }
}
