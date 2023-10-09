<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentRequest>
 */
class StudentRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        while (true) {
            $expiredAt = $this->faker->dateTimeBetween(now(), '+1 day');
            if ($expiredAt->format('H') != '00') {
                $expiredAt = $expiredAt->format('Y-m-d H:i:s');
                break;
            }
        }

        return [
            'request' => $this->faker->randomElement(['Pending', 'Accepted', 'Canceled']),
            'expired_at' => $expiredAt,
        ];
    }
}
