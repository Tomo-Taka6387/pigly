<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class WeightLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'date' => $this->faker->date(),
            'weight' => 46.5,
            'calories' => 1200,
            'exercise_time' => 15,
        ];
    }
}
