<?php

namespace Modules\Category\Http\Traits;

use Modules\User\Entities\User;

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
     * @param User|null $createdBy
     * @return void
     */
    public static function createCategory(
        string $category,
        string $description,
        ?User $createdBy
    )
    {
        return self::create([
            'category' => $category,
            'description' => $description,
            'status' => self::STATUS_ACTIVE,
            'created_by' => $createdBy?->id
        ]);
    }
}
