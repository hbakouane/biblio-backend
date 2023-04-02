<?php

namespace Modules\Profile\Database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Country\Entities\Country;
use Modules\User\Entities\User;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Profile\Entities\Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $country = Country::random();

        return [
            'country_id' => $country->code,
            'dob' => Carbon::now()->subYears(rand(0, 50)),
            'note' => rand(0, 5) > 2 ? null : $this->faker->text,
            'website' => rand(0, 5) > 2 ? null : $this->faker->url,
            'phone_country_id' => $country->code,
            'phone_number' => rand(11111111, 999999999),
            'status' => rand(0, 5) > 2 ? User::STATUS_ACTIVE : User::STATUS_INACTIVE
        ];
    }
}

