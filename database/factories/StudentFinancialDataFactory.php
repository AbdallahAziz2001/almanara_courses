<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentFinancialData>
 */
class StudentFinancialDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement(['Deposit', 'Withdraw']),
            'message' => $this->faker->sentence(),
            'semester' => $this->faker->year() . $this->faker->randomElement(['1', '2', '3']),
            'total_amount_required' => $this->faker->randomFloat(2, 0, 99999.99),
            'total_amount_paid' => $this->faker->randomFloat(2, 0, 99999.99),
            'total_amount_payable' => $this->faker->randomFloat(2, 0, 99999.99),
        ];
    }
}
