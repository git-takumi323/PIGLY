<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\WeightTargetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

//  **アカウント登録**
Route::get('/register/step1', [RegistrationController::class, 'showStep1'])->name('register.step1');
Route::post('/register/step1', [RegistrationController::class, 'handleStep1'])->name('register.step1.post');

Route::get('/register/step2', [RegistrationController::class, 'showStep2'])->name('register.step2');
Route::post('/register/step2', [RegistrationController::class, 'handleStep2'])->name('register.step2.post');

//  **認証が必要なルート**
Route::middleware('auth')->group(function () {
    // 体重管理画面表示
    Route::get('/weight_logs', [WeightLogController::class, 'index'])->name('weight-logs.index');

    // 目標体重変更画面
    Route::get('/weight_logs/goal_setting', [WeightTargetController::class, 'target'])->name('weight-target.edit');

    // 目標体重変更
    Route::post('/weight_logs/goal_setting', [WeightTargetController::class, 'update'])->name('weight-target.update');

    // 体重検索（ミドルウェア適用）
    Route::get('/weight_logs/search', [WeightLogController::class, 'search'])->name('weight-logs.search');

    //  **体重データの登録**
    Route::post('/weight_logs/store', [WeightLogController::class, 'store'])->name('weight-logs.store');

    //  **体重詳細へ移動**
    Route::get('/weight_logs/{weightLogId}', [WeightLogController::class, 'edit'])->name('weight-logs.edit');

    //  **体重データの更新**
    Route::post('/weight_logs/{weightLogId}/update', [WeightLogController::class, 'update'])->name('weight-logs.update');

    //  **体重データの削除**
    Route::delete('/weight_logs/{weightLogId}/delete', [WeightLogController::class, 'destroy'])->name('weight-logs.destroy');
});

//  **ログアウト**
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');
