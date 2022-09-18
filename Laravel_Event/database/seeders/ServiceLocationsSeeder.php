<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceLocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tbl_service_locations')->insert([
            [
                'id' => 1,
                'service_id' => 1,
                'location_id' => 1
            ],
            [
                'id' => 2,
                'service_id' => 1,
                'location_id' => 2
            ],
            [
                'id' => 3,
                'service_id' => 2,
                'location_id' => 2
            ],
            [
                'id' => 4,
                'service_id' => 2,
                'location_id' => 3
            ]
        ]);
    }
}
