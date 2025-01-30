<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiGLy - 目標体重設定</title>
    <link rel="stylesheet" href="{{ asset('css/target.css') }}">
</head>
<body>
    <header class="header">
        <h1 class="logo">PiGLy</h1>
        <div class="header-actions">
            <button class="btn">目標体重設定</button>
            <button class="btn">ログアウト</button>
        </div>
    </header>

    <main class="main-content">
        <div class="form-container">
            <h2 class="form-title">目標体重設定</h2>

            <!-- 修正: フォームを追加 -->
            <form action="{{ route('weight-target.update') }}" method="POST">
                @csrf
                @method('POST') <!-- 更新処理なのでPUTを指定 -->

                <div class="form-group">
                    <label for="target_weight">目標体重</label>
                    <div class="input-wrapper">
                        <input
                            type="number"
                            id="target_weight"
                            name="target_weight"
                            value="{{ $targetWeight->target_weight ?? '' }}"
                            step="0.1"
                            required
                        />
                        <span class="unit">kg</span>
                    </div>
                </div>

                <div class="form-actions">
                    <!-- 修正: `</>` を `<button>` に変更 -->
                    <button type="button" class="btn btn-back" onclick="history.back()">戻る</button>
                    <button type="submit" class="btn btn-update">更新</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
