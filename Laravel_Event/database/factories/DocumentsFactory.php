<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Documents;

class DocumentsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Documents::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            [
                'id' => 1,
                'name' => 'PAN Card'
            ],
            [
                'id' => 2,
                'name' => 'Voter Id'
            ],
            [
                'id' => 3,
                'name' => 'Aadhar Card'
            ]
        ];
    }
}
