<?php

namespace Database\Factories;

use App\Models\Courier;
use App\Models\Company;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $courier_id = Courier::pluck('id')->toArray();
        $company_id = Company::pluck('id')->toArray();
        $status = 'pending';
        $randomNumber = random_int(0, 3);
        if ($randomNumber == 1) {
            $status = 'on delivery';
        } else if ($randomNumber == 2) {
            $status = 'delivered';
        } else if ($randomNumber == 3) {
            $status = 'cancelled';
        }
        return [
            'courier_id' => $status == 'pending' || $status == 'cancelled' ? null : $this->faker->randomElement($courier_id),
            'company_id' => $this->faker->randomElement($company_id),
            'start_latitude' => $this->faker->latitude,
            'start_longitude' => $this->faker->longitude,
            'delivery_address' => $this->faker->address,
            'delivery_provider_name' => $this->faker->company,
            'delivery_provider_mobile' => $this->faker->phoneNumber,
            'destination_address' => $this->faker->address,
            'destination_longitude' => $this->faker->longitude,
            'destination_latitude' => $this->faker->latitude,
            'recipient_name' => $this->faker->name,
            'recipient_mobile' => $this->faker->name,
            'status' => $status,
        ];
    }
}
