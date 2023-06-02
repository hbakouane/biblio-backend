<?php

namespace Modules\Address\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Address\Database\factories\AddressFactory;
use Modules\Address\Entities\Address;

class AddressDatabaseSeeder extends Seeder
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
            $factory = app(AddressFactory::class)->definition();

            Address::createAddress(
                $factory['owner_type']::find($factory['owner_id']),
                $factory['address_line_1'],
                $factory['state'],
                $factory['city'],
                $factory['zip'],
                $factory['country_id']
            );
        }
    }
}
