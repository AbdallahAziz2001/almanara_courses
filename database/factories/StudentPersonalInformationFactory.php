<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentPersonalInformation>
 */
class StudentPersonalInformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        while (true) {
            $birthday = $this->faker->dateTimeBetween('-38 years', '-18 years');
            if ($birthday->format('H') != '00') {
                $birthday = $birthday->format('Y-m-d H:i:s');
                break;
            }
        }

        return [
            'nid' => $this->faker->numberBetween(10000000, 99999999),
            'address' => $this->faker->streetAddress(),
            'mobile' => $this->faker->unique()->phoneNumber(),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'birthday' => $birthday,
            'accomplishments' => $this->faker->sentence(120),
            'study_level' => $this->faker->randomElement(['1', '2', '3', '4']),
        ];
    }
}
