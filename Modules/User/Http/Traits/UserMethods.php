<?php

namespace Modules\User\Http\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Modules\Core\Entities\Core;
use Modules\Core\Jobs\SendWelcomeEmailToUser;
use Modules\Profile\Entities\Profile;
use Modules\User\Entities\User;

trait UserMethods
{
    /**
     * Get all the possible statuses for
     * the user model
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
     * Get a random user
     *
     * @return mixed
     */
    public static function random()
    {
        return self::inRandomOrder()
            ->first();
    }

    /**
     * Create a new user
     *
     * @param $firstName
     * @param $lastName
     * @param $fullName
     * @param $email
     * @param $password
     * @return mixed
     */
    public static function createUser(
        $firstName,
        $lastName,
        $fullName,
        $email,
        $password
    )
    {
        $user = self::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'full_name' => $fullName ?? ($firstName . ' ' . $lastName),
            'email' => $email,
            'password' => Hash::make(User::TEMP_PASSWORD) // Hash::make($password)
        ]);

        self::sendWelcomeEmail($user);

        // Create a profile for the created user
        Profile::createProfile($user->id);

        return $user;
    }

    /**
     * Send welcome email to the new created user
     *
     * @param $user
     * @return void
     */
    protected static function sendWelcomeEmail($user)
    {
        SendWelcomeEmailToUser::dispatch($user)
            ->delay(now()->addMinute());
    }

    /**
     * Return a caching key for the user's profile image
     *
     * @return string
     */
    public function getProfileImageCachingKey()
    {
        return "user:profile_image";
    }

    /**
     * Reset the cached profile image temporary URL
     *
     * @return bool
     */
    public function resetCachedProfileImageUrl()
    {
        return Cache::forget($this->getProfileImageCachingKey());
    }

    /**
     * Get the profile image URL after caching it for 2 days
     *
     * @return mixed
     */
    public function getProfileImage()
    {
        $this->resetCachedProfileImageUrl();

        return Cache::remember($this->getProfileImageCachingKey(), 3600 * 48, function () {
            $profileImage = auth()->user()
                ->getMedia(Core::COLLECTION_PROFILE_IMAGES)[0];

            // TODO: Return temporary url when we deploy the app to AWS
            // Local disk doesn't support temporary urls
            // $url = $profileImage->getTemporaryUrl(now()->addDay(1));

            return url($profileImage->getUrl());
        });
    }
}
