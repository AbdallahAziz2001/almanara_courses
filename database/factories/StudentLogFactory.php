<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentLog>
 */
class StudentLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'report' => $this->faker->randomElement([
                'The student opened his grades page', 'The student opened his log page',
                'The student opened his personal information page',
                'The student opened the page to edit his personal information',
                'The student modified his personal information',
                'The student modified his accomplishments',
                'The student opened the page for editing his accomplishments',
                'The student requested to view all his personal and financial information, grades, and log history',
                'The student opened the page to change his password',
                'The student Changed his password',
                'The student logged in to his account',
                'The student has logged out of his account',
                'The user has opened the home page',
                'The student opened his financial file page',
                'The student opened our team page',
            ]),
        ];
    }
}
