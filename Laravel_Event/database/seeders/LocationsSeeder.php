<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tbl_locations')->insert([
            [
                'id' => 1,
                'name' => 'IND'
            ],
            [
                'id' => 2,
                'name' => 'VIC'
            ],
            [
                'id' => 3,
                'name' => 'NSW'
            ]
        ]);
    }
}
