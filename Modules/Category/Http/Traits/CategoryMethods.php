<?php

namespace Modules\Category\Http\Traits;

use Modules\Profile\Entities\Profile;

trait CategoryMethods
{
    /**
     * Get all the statuses of the categories
     *
     * @return array
     */
    public static function getStatuses()
    {
        return [
            self::STATUS_ACTIVE,
            self::STATUS_INACTIVE
        ];
    }

    /**
     * Get random category
     *
     * @return mixed
     */
    public static function random()
    {
        return self::inRandomOrder()
            ->first();
    }

    /**
     * Create a new category
     *
     * @param string $category
     * @param string $description
     * @param string|null $createdBy
     * @return void
     */
    public function createCategory(
        string $category,
        string $description,
        ? string $createdBy
    )
    {
        return self::create([
            'category' => $category,
            'description' => $description,
            'created_by' => $createdBy
        ]);
    }
}
