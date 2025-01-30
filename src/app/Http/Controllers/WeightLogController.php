<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightTarget;
use App\Models\WeightLog;

class WeightLogController extends Controller
{
    /**
     * ユーザーの体重データを取得する共通メソッド
     */
    private function getUserWeightData()
    {
        $userId = auth()->id();
        $targetWeight = WeightTarget::where('user_id', $userId)->first();
        $latestWeight = WeightLog::where('user_id', $userId)->latest('date')->first();

        $diff = ($targetWeight && $latestWeight)
            ? $latestWeight->weight - $targetWeight->target_weight
            : null;

        return compact('targetWeight', 'latestWeight', 'diff');
    }

    /**
     * 体重ログの一覧表示
     */
    public function index()
    {
        if (!auth()->check()) {
            abort(403, 'ログインしていません');
        }

        $logs = WeightLog::where('user_id', auth()->id())
            ->orderBy('date', 'desc')
            ->paginate(8);

        return view('index', array_merge($this->getUserWeightData(), ['logs' => $logs ?? collect([])]));
    }

    /**
     * 体重ログの検索
     */
    public function search(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $start = $request->input('start_date');
        $end = $request->input('end_date');

        $logs = WeightLog::where('user_id', auth()->id())
            ->whereBetween('date', [$start, $end])
            ->orderBy('date', 'desc')
            ->paginate(8);

        return view('index', array_merge($this->getUserWeightData(), [
            'logs' => $logs,
            'start_date' => $start,
            'end_date' => $end,
        ]));
    }

    /**
     * 体重ログの登録
     */
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'date' => 'required|date',
            'weight' => 'required|numeric|min:0|max:300',
            'calories' => 'required|integer|min:0|max:10000',
            'exercise_time' => 'required',
            'exercise_content' => 'nullable|string|max:120',
        ]);

        // データ保存
        WeightLog::create([
            'user_id' => auth()->id(), // ユーザーIDを紐づけ
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);

        // 登録後、一覧ページへリダイレクト
        return redirect()->route('weight-logs.index')->with('success', 'データを登録しました！');
    }

    /**
     * 体重ログの編集画面表示
     */
    public function edit($weightLogId)
    {
        // 指定されたIDのログを取得（ログインユーザーのデータのみ）
        $log = WeightLog::where('id', $weightLogId)->where('user_id', auth()->id())->first();

        // データがない or 他のユーザーのデータなら403エラー
        if (!$log) {
            abort(403, '編集権限がありません');
        }

        return view('edit', ['log' => $log]);
    }
    /**
     * 体重ログの更新
     */
    public function update(Request $request, $weightLogId)
    {
        // バリデーション
        $request->validate([
            'date' => 'required|date',
            'weight' => 'required|numeric|min:0|max:300',
            'calories' => 'required|integer|min:0|max:10000',
            'exercise_time' => 'required',
            'exercise_content' => 'nullable|string|max:120',
        ]);

        // 指定されたIDのログを取得（ログインユーザーのデータのみ）
        $log = WeightLog::where('id', $weightLogId)->where('user_id', auth()->id())->first();

        // データがない or 他のユーザーのデータなら403エラー
        if (!$log) {
            abort(403, '更新権限がありません');
        }

        // データ更新
        $log->fill([
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ])->save();

        // 更新後、一覧ページへリダイレクト
        return redirect()->route('weight-logs.index')->with('success', 'データを更新しました！');
    }

    /**
     * 体重ログの削除
     */
    public function destroy($weightLogId)
    {
        // 指定されたIDのログを取得（ログインユーザーのデータのみ）
        $log = WeightLog::where('id', $weightLogId)->where('user_id', auth()->id())->first();

        // データがない or 他のユーザーのデータなら403エラー
        if (!$log) {
            abort(403, '削除権限がありません');
        }

        // 削除実行
        $log->delete();

        // 削除後、一覧ページへリダイレクト
        return redirect()->route('weight-logs.index')->with('success', 'データを削除しました！');
    }
}
