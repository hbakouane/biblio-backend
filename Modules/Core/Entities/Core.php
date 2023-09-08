<?php

namespace Modules\Core\Entities;

/**
 * Holds all the important variables used on the project
 */
class Core
{
    /**
     * Items to return per page in a pagination
     */
    const ITEMS_PER_PAGE = 10;

    /**
     * Allowed image extensions
     *
     * @var array|string[]
     */
    public static array $allowedImageExtension = ['png', 'jpg', 'jpeg', 'svg'];

    /**
     * All media collections
     */
    const COLLECTION_PROFILE_IMAGES = 'profile_images';

    /**
     * All possible queues names
     */
    CONST QUEUE_USER = 'user';
    CONST QUEUE_BOOK = 'book';
    CONST QUEUE_ORDER = 'order';

    /**
     * Get a list of all media collections
     *
     * @return string[]
     */
    public static function getAllMediaCollections()
    {
        return [
            self::COLLECTION_PROFILE_IMAGES
        ];
    }

    /**
     * Get a list of all the possible queues
     *
     * @return string[]
     */
    public static function getAllQueues()
    {
        return [
            self::QUEUE_USER,
            self::QUEUE_BOOK,
            self::QUEUE_ORDER
        ];
    }
}
