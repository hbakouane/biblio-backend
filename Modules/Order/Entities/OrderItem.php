<?php

namespace Modules\Order\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuids;
use Modules\Order\Http\Traits\OrderItemsMethods;
use Modules\Order\Http\Traits\OrderItemsRelationships;

class OrderItem extends Model
{
    use HasFactory, Uuids, OrderItemsMethods,
        OrderItemsRelationships;

    /**
     * Mass-assignable attributes
     *
     * @var array[]
    */
    protected $fillable = [
        'book_id',
        'order_id',
        'price',
        'quantity'
    ];

    protected static function newFactory()
    {
        return \Modules\Order\Database\factories\OrderItemFactory::new();
    }
}
