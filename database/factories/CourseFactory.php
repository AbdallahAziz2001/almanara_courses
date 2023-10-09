<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course' => substr($this->faker->unique()->sentence(), rand(0, 5), 1) . substr($this->faker->unique()->sentence(), rand(0, 5), 2) . substr($this->faker->unique()->sentence(), rand(0, 5), 1) . $this->faker->randomFloat(0, 1000, 9999),
        ];
    }
}
