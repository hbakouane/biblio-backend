<?php

namespace Modules\Book\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Category\Entities\Category;
use Modules\Profile\Entities\Profile;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Book\Entities\Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'excerpt' => $this->faker->sentence,
            'author' => $this->faker->name,
            'description' => $this->faker->text,
            'category' => Category::random()->category,
            'price' => rand(5, 199),
            'quantity' => rand(10, 1000),
            'status' => rand(0, 10) > 5 ? Category::STATUS_ACTIVE : Category::STATUS_INACTIVE,
            'published_by' => Profile::random()->id
        ];
    }
}

