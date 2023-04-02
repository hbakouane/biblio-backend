<?php

namespace Modules\Order\Http\Traits;

use Modules\Book\Entities\Book;
use Modules\Order\Entities\Order;

trait OrderBooksRelationships
{
    /**
     * Get the associated book
     *
     * @return mixed
     */
    public function book()
    {
        return $this->hasOne(Book::class);
    }

    /**
     * Get the associated order
     *
     * @return mixed
     */
    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
