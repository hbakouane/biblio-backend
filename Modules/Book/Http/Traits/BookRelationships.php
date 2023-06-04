<?php

namespace Modules\Book\Http\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Category\Entities\Category;
use Modules\Profile\Entities\Profile;

trait BookRelationships
{
    /**
     * Get the publisher of the book
     *
     * @return HasOne
     */
    public function publisher()
    {
        return $this->hasOne(
            Profile::class,
            'id',
            'published_by'
        );
    }

    /**
     * Get the associated category to the book
     *
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
