<?php

namespace Modules\Order\Http\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Order\Entities\OrderItem;
use Modules\Profile\Entities\Profile;

trait OrderRelationships
{
    /**
     * Get the order's books
     *
     * @return HasMany
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the associated customer
     *
     * @return BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Profile::class);
    }
}
