<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Modules\Activity\Database\Seeders\ActivityDatabaseSeeder;
use Modules\Address\Database\Seeders\AddressDatabaseSeeder;
use Modules\Book\Database\Seeders\BookDatabaseSeeder;
use Modules\Category\Database\Seeders\CategoryDatabaseSeeder;
use Modules\Country\Database\Seeders\CountryTableSeeder;
use Modules\Order\Database\Seeders\OrderDatabaseSeeder;
use Modules\User\Database\Seeders\UserDatabaseSeeder;
use Modules\Core\Entities\Roles;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class Refresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'module:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refreshes the database and seeds data.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Refresh the database
        $this->refreshDatabase();

        // Seed the data
        $this->prepareSeeding();
    }

    /**
     * Drop all the tables and migrate again
     *
     * @return void
     */
    private function refreshDatabase()
    {
        $now = Carbon::now();

        $this->alert('Refreshing the database ...');

        Artisan::call('module:migrate-fresh');

        $time = $this->getTimeDiff($now);

        $this->info("Database refreshed. ($time)" . PHP_EOL);
    }

    /**
     * Prepare all the seeders and track how much time each one took
     *
     * @return void
     */
    private function prepareSeeding()
    {
        $now = Carbon::now();

        $this->alert("Seeding data ...");

        $this->seedData();

        $time = $this->getTimeDiff($now);

        $this->info("Data seeded successfully. ($time)");
    }

    /**
     * Process seeding data
     *
     * @return void
     */
    private function seedData()
    {
        $this->seed(CountryTableSeeder::class, 'Country');

        $this->seed(UserDatabaseSeeder::class, 'User');

        $this->seed(AddressDatabaseSeeder::class, 'Address');

        $this->seed(CategoryDatabaseSeeder::class, 'Category');

        $this->seed(BookDatabaseSeeder::class, 'Book');

        $this->seed(OrderDatabaseSeeder::class, 'Order');

        $this->seed(ActivityDatabaseSeeder::class, 'Activity');
    }

    /**
     * Run a seeder and track the time it took
     *
     * @param Seeder|string $class
     * @param string $name
     * @return void
     */
    private function seed(Seeder|string $class, string $name)
    {
        $time = Carbon::now();

        $this->alert("Seeding data for the $name module.");

        $this->call($class);

        $time = $this->getTimeDiff($time);

        $this->info("Data seeder for the $name module. ($time)" . PHP_EOL);
    }

    /**
     * Get the time difference between a given time and now
     *
     * @param Carbon $time
     * @return string
     */
    private function getTimeDiff(Carbon $time): string
    {
        $diff = Carbon::parse($time)->diffInMilliseconds();

        if ($diff > 1000) return Carbon::parse($time)->diffInSeconds() . 's';

        return $diff . 'ms';
    }
}
