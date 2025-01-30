<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User; // Userモデルをインポート

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WeightLog>
 */
class WeightLogFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => 1, // 関連するユーザーIDを生成
            'date' => $this->faker->date(), // ダミーの日付
            'weight' => $this->faker->randomFloat(1, 50, 120), // 50kgから120kgの範囲で小数点1桁までの体重
            'calories' => $this->faker->numberBetween(1000, 4000), // 1000〜4000カロリー
            'exercise_time' => $this->faker->time(), // 運動時間
            'exercise_content' => $this->faker->sentence(), // ダミーの運動内容
            'created_at' => now(), // 現在時刻
            'updated_at' => now(), // 現在時刻
        ];
    }
}
