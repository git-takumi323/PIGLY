<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\WeightTarget; // 追加: WeightTargetモデルの読み込み
use App\Models\WeightLog; // 追加: WeightLogモデルの読み込み
use Illuminate\Support\Facades\Auth; // 追加: Authファサードの読み込み
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterStep1Request;
use App\Http\Requests\RegisterStep2Request;

class RegistrationController extends Controller
{
    // STEP1: ユーザー登録フォームの表示
    public function showStep1()
    {
        return view('auth.register-step1');
    }

    // STEP1: ユーザー登録処理
    public function handleStep1(RegisterStep1Request $request)
    {
        // バリデーション済みデータを取得
        $validated = $request->validated();

        // Usersテーブルにデータを保存
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), // パスワードをハッシュ化
        ]);

        // 作成したユーザーのIDをセッションに保存（Step2で使うため）
        Session::put('user_id', $user->id);

        return redirect()->route('register.step2'); // Step2へリダイレクト
    }

    // STEP2: 体重目標登録フォームの表示
    public function showStep2()
    {
        // セッションにユーザーIDがない場合はStep1にリダイレクト
        if (!Session::has('user_id')) {
            return redirect()->route('register.step1');
        }

        return view('auth.register-step2');
    }

    // STEP2: 体重目標登録処理
    public function handleStep2(RegisterStep2Request $request)
    {
        // バリデーション済みデータを取得
        $validated = $request->validated();

        // セッションからユーザーIDを取得
        $userId = Session::get('user_id');

        // ユーザー取得（失敗した場合はエラーハンドリング）
        $user = User::find($userId);
        if (!$user) {
            return redirect()->route('register.step1')->withErrors('ユーザーが見つかりませんでした');
        }

        // 📌 自動ログイン
        Auth::login($user);

        // WeightTargetテーブルにデータを保存
        WeightTarget::create([
            'user_id' => $userId,
            'target_weight' => $validated['target_weight'],
        ]);

        // WeightLogテーブルにデータを保存
        WeightLog::create([
            'user_id' => $userId,
            'weight' => $validated['current_weight'],
            'date' => now(),
        ]);

        // セッションをクリア
        Session::forget('user_id');

        // 📌 認証済みのままダッシュボードにリダイレクト
        return redirect()->route('weight-logs.index')->with('success', 'アカウントが作成されました！');
    }

}
