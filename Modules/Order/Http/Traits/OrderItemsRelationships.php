<?php

namespace Modules\Order\Http\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Book\Entities\Book;
use Modules\Order\Entities\Order;

trait OrderItemsRelationships
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
     * Get the associated item
     *
     * @return BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Get the associated order
     *
     * @return mixed
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
