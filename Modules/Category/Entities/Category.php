<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuids;
use Modules\Category\Http\Traits\CategoryMethods;
use Modules\Category\Http\Traits\CategoryRelationship;

class Category extends Model
{
    use HasFactory, Uuids, CategoryMethods,
        CategoryRelationship;

    /**
     * Mass-assignable attributes
     *
     * @var array[]
    */
    protected $fillable = [
        'category',
        'description',
        'status',
        'created_by'
    ];

    /**
     * Category's possible statuses
     */
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    protected static function newFactory()
    {
        return \Modules\Category\Database\factories\CategoryFactory::new();
    }
}
