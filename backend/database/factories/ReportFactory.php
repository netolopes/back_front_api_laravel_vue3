<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->catchPhrase(),
            'category' => $this->faker->jobTitle(),
            'description' => $this->faker->realText(100),
            'user_id' => User::factory(1)->create()->first(),
        ];
    }
}
