<?php

namespace Modules\Category\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Category\Entities\Category;
use Modules\User\Entities\User;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Category\Entities\Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category' => $this->faker->name,
            'description' => $this->faker->text,
            'status' => rand(0, 10) > 5 ? Category::STATUS_ACTIVE : Category::STATUS_INACTIVE,
            'created_by' => User::random()->id
        ];
    }
}

