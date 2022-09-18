<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DocumentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tbl_documents')->insert([
            [
                'id' => 1,
                'name' => 'Pan Card'
            ],
            [
                'id' => 2,
                'name' => 'Aadhar Card'
            ],
            [
                'id' => 3,
                'name' => 'Voter Card'
            ]
        ]);
    }
}
