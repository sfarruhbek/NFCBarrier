<?php

namespace Database\Seeders;

use App\Models\Cars;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cars::query()->create([
            'model' => 'Nexia 2',
            'car_number' => "90A777SS",
            'car_color' => "Oq",
        ]);
        Cars::query()->create([
            'model' => 'Malibu',
            'car_number' => "90A777ZZ",
            'car_color' => "Qora",
        ]);
    }
}
