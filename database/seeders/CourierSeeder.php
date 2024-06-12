<?php

namespace Database\Seeders;

use App\Models\Courier;
use Database\Factories\CourierFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Courier::factory()->count(5)->create();
    }
}
