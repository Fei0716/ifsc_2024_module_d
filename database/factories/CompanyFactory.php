<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $company = $this->faker->company;
        return [
            'name' => $company,
            'webhook_address' => "https://$company.com/webhook",
            'api_key' => hash('sha256', $company),
        ];
    }
}
