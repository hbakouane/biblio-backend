<?php

namespace Modules\Address\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Country\Entities\Country;
use Modules\User\Entities\User;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Address\Entities\Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::random();

        return [
            'owner_type' => $user::class,
            'owner_id' => $user->id,
            'address_line_1' => $this->faker->address,
            'state' => $this->faker->randomElement(['Alaska', 'Georgia', 'California']),
            'city' => $this->faker->city,
            'zip' => rand(11111, 999999),
            'country_id' => Country::whereNotNull('code')
                ->inRandomOrder()
                ->first()
                ?->code
        ];
    }
}

