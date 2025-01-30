<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WeightLog;

class WeightLogSeeder extends Seeder
{
    public function run(): void
    {
        // user_id = 1 のデータを35件作成
        WeightLog::factory()->count(35)->create([
            'user_id' => 1,
        ]);
    }
}
