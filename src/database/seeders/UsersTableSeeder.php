<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ユーザーがいなければデフォルトの2人を作成
        if (User::count() === 0) {
            User::insert([
                [
                    'id' => 1, // `id=1` を固定
                    'name' => 'John Doe',
                    'email' => 'john@example.com',
                    'password' => Hash::make('password123'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => 2, // `id=2` も追加
                    'name' => 'Jane Doe',
                    'email' => 'jane@example.com',
                    'password' => Hash::make('password456'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
