<?php

namespace Modules\Book\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuids;
use Modules\Book\Database\factories\BookFactory;
use Modules\Book\Http\Observers\BookObserver;
use Modules\Book\Http\Traits\BookMethods;
use Modules\Book\Http\Traits\BookRelationships;
use Modules\Core\Traits\Updatable;

class Book extends Model
{
    use HasFactory, Uuids, BookMethods,
        BookRelationships, Updatable;

    /**
     * Mass-assignable attributes
     *
     * @var array[]
    */
    protected $fillable = [
        'title',
        'excerpt',
        'author',
        'description',
        'category_id',
        'price',
        'quantity',
        'status',
        'published_by'
    ];

    /**
     * Possible book statuses
     */
    const STATUS_PUBLISHED = 'published';
    const STATUS_UNPUBLISHED = 'unpublished';
    const STATUS_OUT_OF_STOCK = 'out_of_stock';

    /**
     * Get the factory class of the Book Model
     *
     * @return BookFactory
     */
    protected static function newFactory()
    {
        return \Modules\Book\Database\factories\BookFactory::new();
    }
}
