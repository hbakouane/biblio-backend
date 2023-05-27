<?php

namespace Modules\User\Http\Traits;

use Illuminate\Support\Carbon;
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
    public function getProfileImage($image = null)
    {
        $this->resetCachedProfileImageUrl();

        return Cache::remember($this->getProfileImageCachingKey(), 3600 * 48, function () use ($image) {

            if ($image) return $image->getUrl();

            $profileImagesCollection = auth()->user()
                ->getMedia(Core::COLLECTION_PROFILE_IMAGES);

            // TODO: Return temporary url when we deploy the app to AWS
            // Local disk doesn't support temporary urls
            // $url = $profileImage->getTemporaryUrl(now()->addDay(1));

            return $profileImagesCollection[0]->getUrl();
        });
    }

    /**
     * Register the time when the user was logged in
     *
     * @return Carbon
     */
    public function registerLoginIn()
    {
        return $this->profile->last_logged_in ??= now();
    }


    /**
     * Check if the user is allowed to login
     *
     * @return void
     */
    public function allowedToLogin()
    {
        return $this->profile->status === self::STATUS_ACTIVE;
    }
}
