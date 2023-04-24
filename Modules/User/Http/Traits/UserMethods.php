<?php

namespace Modules\User\Http\Traits;

use Illuminate\Mail\SentMessage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Modules\Core\Jobs\SendWelcomeEmailToUser;
use Modules\Profile\Entities\Profile;
use Modules\User\Emails\WelcomeEmail;

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
            'password' => Hash::make($password)
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
}
