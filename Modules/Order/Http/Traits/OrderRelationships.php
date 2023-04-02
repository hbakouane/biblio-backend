<?php

namespace Modules\Order\Http\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Order\Entities\OrderBook;

trait OrderRelationships
{
    /**
     * Get the order's books
     *
     * @return HasMany
     */
    public function books()
    {
        return $this->hasMany(OrderBook::class);
    }
}
