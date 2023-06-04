<?php

namespace Modules\Book\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuids;
use Modules\Book\Http\Traits\BookMethods;
use Modules\Book\Http\Traits\BookRelationships;

class Book extends Model
{
    use HasFactory, Uuids, BookMethods,
        BookRelationships;

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
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    protected static function newFactory()
    {
        return \Modules\Book\Database\factories\BookFactory::new();
    }
}
