<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WeightTarget;
use App\Models\WeightLog;

class WeightTargetController extends Controller
{
    public function target()
    {
        // 現在のユーザーIDを取得
        $userId = auth()->id();

        // 目標体重を取得
        $targetWeight = WeightTarget::where('user_id', $userId)->first();

        // ビューにデータを渡す
        return view('target', [
            'targetWeight' => $targetWeight, // WeightTargetのレコード
        ]);
    }

    public function update(Request $request)
    {
        // バリデーション
        $request->validate([
            'target_weight' => 'required|numeric|min:0',
        ]);

        // 現在のユーザーIDを取得
        $userId = auth()->id();

        // 目標体重を取得
        $targetWeight = WeightTarget::where('user_id', $userId)->first();

        // 目標体重が存在しない場合は新規作成
        if (!$targetWeight) {
            $targetWeight = new WeightTarget();
            $targetWeight->user_id = $userId;
        }

        // リクエストの目標体重を保存
        $targetWeight->target_weight = $request->input('target_weight');
        $targetWeight->save();

        // リダイレクト
        return redirect()->route('weight-logs.index');
    }
}

