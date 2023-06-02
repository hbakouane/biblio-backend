<?php

namespace Modules\Category\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Database\factories\CategoryFactory;
use Modules\Category\Entities\Category;
use Modules\User\Entities\User;

class CategoryDatabaseSeeder extends Seeder
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
            $factory = app(CategoryFactory::class)->definition();

            Category::createCategory(
                $factory['category'],
                $factory['description'],
                $factory['created_by'] ? User::find($factory['created_by']) : null
            );
        }
    }
}
