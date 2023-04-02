<?php

namespace Modules\Book\Http\Traits;

use Modules\Book\Entities\Book;

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
}
