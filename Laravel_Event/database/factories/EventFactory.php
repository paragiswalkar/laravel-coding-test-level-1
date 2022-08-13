<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Event;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->uuid(),
            'name' => $this->faker->name,
            'slug' => $this->faker->name,
            'start_date' => date('d-m-Y H:i', strtotime('+ 30 days')),
            'end_date' => date('d-m-Y H:i', strtotime('+ 60 days')),
        ];
    }
}
