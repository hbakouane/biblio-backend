<?php

namespace Modules\Book\Http\Traits;

use Modules\Book\Entities\Book;
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
            Book::STATUS_ACTIVE,
            Book::STATUS_INACTIVE
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
     * Create a new book
     *
     * @param string $title
     * @param string $author
     * @param Category|string $category
     * @param int $price
     * @param int $quantity
     * @param Profile|string $publisher
     * @return mixed
     */
    public static function createBook(
        string              $title,
        string              $author,
        Category|string     $category,
        int                 $price,
        int                 $quantity,
        Profile|string      $publisher
    )
    {
        return Book::create([
            'title' => $title,
            'author' => $author,
            'category' => $category instanceof Category ? $category->id : $category,
            'price' => $price,
            'quantity' => $quantity,
            'published_by' => $publisher instanceof Profile ? $publisher->id : $publisher
        ]);
    }
}
