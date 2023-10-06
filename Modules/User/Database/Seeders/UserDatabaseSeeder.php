<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Profile\Entities\Profile;
use Modules\User\Database\factories\UserFactory;
use Modules\User\Entities\User;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        for ($i = 0; $i < 3; $i++) {
            $factory = app(UserFactory::class)->definition();
            User::createUser(
                $first = $factory['first_name'],
                $last = $factory['last_name'],
                $first . ' ' . $last,
                $factory['email'],
                123456
            );
        }

        // Create a default user if they do not exist
        if (!User::where('email', 'hbakouane@gmail.com')->first()) {
            User::createUser(
                $first = 'Haytam',
                $last = 'Bakouane',
                $first . ' ' . $last,
                'hbakouane@gmail.com',
                123456
            );
        }
    }
}
