<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// 他のモデルをインポート
use App\Models\User;

class WeightTarget extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'target_weight',
    ];

    /**
     * Userとの逆の1対1のリレーション
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

