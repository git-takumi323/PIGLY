<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiGLy - ダッシュボード</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>
    <header class="header">
        <h1 class="logo">PiGLy</h1>
        <div class="header-actions">
            <form action="{{ route('weight-target.edit') }}" method="GET">
                @csrf
                <button type="submit" class="btn">目標体重設定</button>
            </form>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn">ログアウト</button>
            </form>
        </div>
    </header>

    <main class="main-content">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
        <!-- 統計情報 -->
        <div class="stats-container">
            <div class="stat">
                <div class="stat-title">目標体重</div>
                <div class="stat-value">{{ $targetWeight->target_weight ?? '未設定' }}<span>kg</span></div>
            </div>
            <div class="stat">
                <div class="stat-title">目標まで</div>
                <div class="stat-value">{{ $diff ?? '未設定' }}<span>kg</span></div>
            </div>
            <div class="stat">
                <div class="stat-title">最新体重</div>
                <div class="stat-value">{{ $latestWeight->weight ?? '未設定' }}<span>kg</span></div>
            </div>
        </div>

        <!-- データ管理 -->
        <div class="data-container">
            <div class="data-header">
                <div class="filter">
                    <form action="{{ route('weight-logs.search') }}" method="GET">
                        <input type="date" class="date-input" name="start_date" value="{{ request('start_date') }}" required>
                        ～
                        <input type="date" class="date-input" name="end_date" value="{{ request('end_date') }}" required>
                        <button type="submit" class="btn">検索</button>
                    </form>
                </div>
                @if(request('start_date') && request('end_date'))
                    <p>{{ request('start_date') }}～{{ request('end_date') }}の検索結果 {{ $logs->total() }}件</p>
                    <a href="{{ route('weight-logs.index') }}" class="btn-reset">リセット</a>
                @endif
                <button type="button" id="open-modal" class="btn btn-add">データ追加</button>
            </div>

            <!-- データテーブル -->
            <table class="data-table">
                <thead>
                    <tr>
                        <th>日付</th>
                        <th>体重</th>
                        <th>食事摂取カロリー</th>
                        <th>運動時間</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $log)
                    <tr>
                        <td>{{ $log->date ?? '未設定' }}</td>
                        <td>{{ $log->weight ?? '未設定' }}kg</td>
                        <td>{{ $log->calories ?? '未設定' }}cal</td>
                        <td>{{ $log->exercise_time ?? '未設定' }}</td>
                        <td>
                            <form action="{{ route('weight-logs.edit', ['weightLogId' => $log->id]) }}" method="GET" style="display:inline;">
                                @csrf
                                @method('GET')
                                <button type="submit" class="edit-icon">✏️</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $logs->links() }}
            @if($logs->isEmpty())
                <p class="no-data">該当するデータがありません。</p>
            @endif
        </div>
    </main>

    <!-- モーダルウィンドウ -->
        <div id="modal" class="modal">
            <div class="modal-content">
                <h2>データの追加</h2>
                <form action="{{ route('weight-logs.store') }}" method="POST">
                    @csrf
                    <label for="date">日付</label>
                    <input type="date" id="date" name="date" value="{{ now()->format('Y-m-d') }}" required>

                    <label for="weight">体重</label>
                    <input type="number" id="weight" name="weight" placeholder="50.0 (kg)" step="0.1" required>

                    <label for="calories">摂取カロリー</label>
                    <input type="number" id="calories" name="calories" placeholder="1200 (cal)" required>

                    <label for="exercise_time">運動時間</label>
                    <input type="time" id="exercise_time" name="exercise_time" required>

                    <label for="exercise_content">運動内容</label>
                    <textarea id="exercise_content" name="exercise_content" maxlength="120"></textarea>

                    <div style="display: flex; justify-content: space-between;">
                        <button type="button" id="close-modal" class="btn btn-secondary">戻る</button>
                        <button type="submit" class="btn btn-primary">登録</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById("modal");
            const openModalButton = document.getElementById("open-modal");
            const closeModalButton = document.getElementById("close-modal");

            // 初期状態で display: none を強制適用
            modal.style.display = "none";

            // モーダルを開く
            openModalButton.addEventListener("click", function() {
                console.log("モーダルを開く処理");
                modal.style.display = "flex";
            });

            // モーダルを閉じる
            closeModalButton.addEventListener("click", function() {
                console.log("モーダルを閉じる処理");
                modal.style.display = "none";
            });

            // モーダル外をクリックしたら閉じる
            window.addEventListener("click", function(event) {
                if (event.target === modal) {
                    console.log("モーダル外をクリックして閉じる処理");
                    modal.style.display = "none";
                }
            });

            // デバッグ用：ページが読み込まれたときの display 状態を確認
            console.log("モーダルの初期 display:", modal.style.display);
        });
        </script>

</body>
</html>