<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tbl_services')->insert([
            [
                'id' => 1,
                'name' => 'Master Services'
            ],
            [
                'id' => 2,
                'name' => 'MA Services'
            ],
            [
                'id' => 3,
                'name' => 'Test Services'
            ]
        ]);
    }
}
