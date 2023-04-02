<?php

namespace Modules\Order\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Profile\Entities\Profile;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Order\Entities\Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer' => Profile::random()->id, // TODO: Get the profile of a customer
            'total' => $this->faker->numberBetween(6, 199), // TODO: Adjust the total of the order
        ];
    }
}

