<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceLocationDocumentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tbl_service_location_documents')->insert([
            [
                'id' => 1,
                'service_id' => 1,
                'location_id' => 1,
                'document_id' => 1
            ],
            [
                'id' => 2,
                'service_id' => 1,
                'location_id' => 2,
                'document_id' => 2
            ],
            [
                'id' => 3,
                'service_id' => 2,
                'location_id' => 2,
                'document_id' => 3
            ],
            [
                'id' => 4,
                'service_id' => 2,
                'location_id' => 3,
                'document_id' => 2
            ],
            [
                'id' => 5,
                'service_id' => 1,
                'location_id' => 2,
                'document_id' => 1
            ],
            [
                'id' => 6,
                'service_id' => 1,
                'location_id' => 3,
                'document_id' => 2
            ]
        ]);
    }
}
