<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Profile\Entities\Profile;
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

        User::factory(3)->create()->each(function ($user) {
            Profile::factory()->create([
                'user_id' => $user->id
            ]);
        });

        User::factory(1)->create([
            'first_name' => 'Haytam',
            'last_name' => 'Bakouane',
            'full_name' => 'Haytam Bakouane',
            'email' => 'hbakouane@gmail.com'
        ])->each(function ($user) {
            Profile::factory()->create([
                'user_id' => $user->id
            ]);
        });
    }
}
