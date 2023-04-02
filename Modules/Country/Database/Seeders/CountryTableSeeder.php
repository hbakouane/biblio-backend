<?php

namespace Modules\Country\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Country\Entities\Country;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $countries = file_get_contents(__DIR__ . '/countries.json');
        $countries = json_decode($countries, true);

        if (Country::get()->count() === count($countries)) {
            return;
        }

        DB::transaction(function () use ($countries) {
            foreach ($countries as $country) {
                Country::createCountry(
                    $country['iso_3166_2'] ?? null,
                    $country['name'] ?? null,
                    $country['full_name'] ?? null,
                    $country['calling_code'] ?? null,
                    $country['capital'] ?? null,
                    $country['currency_code'] ?? null,
                    $country['citizenship'] ?? null,
                    $country['flag'] ?? null
                );
            }
        });
    }
}
