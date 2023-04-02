<?php

namespace Modules\User\Http\Traits;

use Illuminate\Support\Facades\Hash;
use Modules\Profile\Entities\Profile;

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

        // Create a profile for the created user
        Profile::createProfile($user->id);

        return $user;
    }
}
