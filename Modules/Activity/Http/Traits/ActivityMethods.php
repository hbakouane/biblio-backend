<?php

namespace Modules\Activity\Http\Traits;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Modules\Activity\Entities\Activity;
use Modules\User\Entities\User;

trait ActivityMethods
{
    /**
     * Get a random activity record
     *
     * @return mixed
     */
    public function random()
    {
        return self::inRandomOrder()
            ->first();
    }

    /**
     * Get all the possible activity keys
     *
     * @return array
     */
    public static function getAllActivityKeys()
    {
        return [
            self::ACTIVITY_KEY_USER_SIGNED_UP,
            self::ACTIVITY_KEY_USER_LOGGED_IN,
            self::ACTIVITY_KEY_USER_LOGGED_OUT,
            self::ACTIVITY_KEY_USER_EMAIL_CHANGED
        ];
    }

    /**
     * Get all the dynamic activities that need to bind variables
     *
     * @return array
     */
    public function getAllDynamicActivitiesKeys()
    {
        return [
            self::ACTIVITY_KEY_USER_EMAIL_CHANGED
        ];
    }

    /**
     * Get all the non-dynamic activities that don't need
     * any variables
     *
     * @return void
     */
    public function getAllNonDynamicActivitiesKeys()
    {
        $keys = self::getAllActivityKeys();
        $dynamicKeys = $this->getAllDynamicActivitiesKeys();

        $keys = array_filter($keys, fn ($key) => !in_array($key, $dynamicKeys));

        return $keys;
    }

    /**
     * Print dynamic activities
     *
     * @return array|Application|Translator|\Illuminate\Foundation\Application|string|null
     */
    public function printDynamicActivity()
    {
        return __('activities.' . $this->key, $this->extra);
    }

    /**
     * Create a new activity
     *
     * @param User $user
     * @param string|null $key
     * @param string $description
     * @param array|null $extra
     * @return mixed
     */
    public static function createActivity(
        User            $user,
        string|null     $key,
        array|null      $extra = []
    )
    {
        return Activity::create([
            'user_type' => User::class,
            'user_id' => $user->id,
            'key' => $key,
            'extra' => $extra
        ]);
    }
}
