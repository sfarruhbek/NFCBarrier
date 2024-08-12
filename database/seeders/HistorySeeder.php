<?php

namespace Database\Seeders;

use App\Models\History;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        History::query()->create([
            'car_id' => '1',
            'entered_date' => now(),
        ]);
        History::query()->create([
            'car_id' => '2',
            'entered_date' => now(),
        ]);
    }
}
