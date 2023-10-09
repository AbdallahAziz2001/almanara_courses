<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentGrades>
 */
class StudentGradesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $courses = Course::select('id')->get();

        return [
            'courses_id' => $courses[rand(0, (count($courses) - 1))]->id,
            'semester' => $this->faker->year() . $this->faker->randomElement(['1', '2', '3']),
            'course_grade' => $this->faker->randomFloat(0, 0, 100),
            'course_grade' => $this->faker->boolean(75) ? $this->faker->randomFloat(0, 50, 100) : $this->faker->randomFloat(0, 0, 100),
        ];
    }
}
