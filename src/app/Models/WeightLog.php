<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// 他のモデルをインポート
use App\Models\User;

class WeightLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'weight',
        'calories',
        'exercise_time',
        'exercise_content',
    ];

    /**
     * Userとの逆の1対多のリレーション
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

