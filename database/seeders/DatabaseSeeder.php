<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Address\Database\Seeders\AddressDatabaseSeeder;
use Modules\Book\Database\Seeders\BookDatabaseSeeder;
use Modules\Category\Database\Seeders\CategoryDatabaseSeeder;
use Modules\Country\Database\Seeders\CountryTableSeeder;
use Modules\Order\Database\Seeders\OrderDatabaseSeeder;
use Modules\Profile\Database\Seeders\ProfileDatabaseSeeder;
use Modules\User\Database\Seeders\UserDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CountryTableSeeder::class);

        $this->call(UserDatabaseSeeder::class);

        $this->call(AddressDatabaseSeeder::class);

        $this->call(CategoryDatabaseSeeder::class);

        $this->call(BookDatabaseSeeder::class);

        $this->call(OrderDatabaseSeeder::class);
    }
}
