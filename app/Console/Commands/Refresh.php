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
        $this->info('Database refreshed');

        // Register the roles and permissions
        app(Roles::class)->registerRolesAndPermissionsAndAssignPermissionsToRoles();

        // Seed the data
        $this->info('Seeding data ...');
        Artisan::call('db:seed');
        $this->info('Data seeded successfully.');
    }
}
