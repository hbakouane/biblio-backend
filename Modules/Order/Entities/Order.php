<?php

namespace Modules\Order\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuids;
use Modules\Order\Http\Traits\OrderMethods;
use Modules\Order\Http\Traits\OrderRelationships;

class Order extends Model
{
    use HasFactory, Uuids, OrderMethods,
        OrderRelationships;

    /**
     * Mass-assignable attributes
     *
     * @var array[]
    */
    protected $fillable = [
        'customer_id',
        'status',
        'times_customer_has_been_reminded',
        'total',
        'note'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = [
        'times_customer_has_been_reminded' => 'int',
        'total' => 'float'
    ];

    /**
     * Possible order statuses
     */
    const STATUS_PENDING = 'pending';
    const STATUS_PAID = 'paid';
    const STATUS_CANCELLED = 'cancelled';

    protected static function newFactory()
    {
        return \Modules\Order\Database\factories\OrderFactory::new();
    }
}
