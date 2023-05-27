<?php

namespace Modules\Category\Http\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Book\Entities\Book;
use Modules\Profile\Entities\Profile;
use Modules\User\Entities\User;

trait CategoryRelationship
{
    /**
     * Get the creator of this category
     *
     * @return HasOne
     */
    public function creator()
    {
        return $this->hasOne(
            User::class,
            'id',
            'created_by'
        );
    }

    /**
     * Get the books of a category
     *
     * @return HasMany
     */
    public function books()
    {
        return $this->hasMany(
            Book::class,
            'category',
            'category'
        );
    }
}
