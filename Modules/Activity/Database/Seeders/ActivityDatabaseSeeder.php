<?php

namespace Modules\Activity\Database\Seeders;

use Modules\User\Entities\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\Activity\Database\factories\ActivityFactory;
use Modules\Activity\Entities\Activity;

class ActivityDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $keys = app(Activity::class)->getAllNonDynamicActivitiesKeys();

        for ($i = 0; $i < count($keys); $i++) {
            Activity::createActivity(
                User::random(),
                $keys[$i]
            );
        }

        // Create a dynamic activity
        Activity::createActivity(
            User::random(),
            Activity::ACTIVITY_KEY_USER_EMAIL_CHANGED,
            [
                'old' => 'old@email.com',
                'new' => 'new@email.com'
            ]
        );
    }
}
