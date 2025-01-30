<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiGLy - Weight Log Edit</title>
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
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
            <h2 class="form-title">Weight Log</h2>
            <form action="{{ route('weight-logs.update', ['weightLogId' => $log->id]) }}" method="POST">
                @csrf
                @method('POST')

                <div class="form-group">
                    <label for="date">日付</label>
                    <input type="date" id="date" name="date" value="{{ $log->date }}" required />
                </div>

                <div class="form-group">
                    <label for="weight">体重</label>
                    <div class="input-wrapper">
                        <input type="number" id="weight" name="weight" value="{{ $log->weight }}" required />
                        <span class="unit">kg</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="calories">摂取カロリー</label>
                    <div class="input-wrapper">
                        <input type="number" id="calories" name="calories" value="{{ $log->calories }}" required />
                        <span class="unit">cal</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exercise_time">運動時間</label>
                    <input type="time" id="exercise_time" name="exercise_time" value="{{ $log->exercise_time }}" required />
                </div>

                <div class="form-group">
                    <label for="exercise_content">運動内容</label>
                    <textarea id="exercise_content" name="exercise_content" rows="4">{{ $log->exercise_content }}</textarea>
                </div>

                <div class="form-actions">
                    <a href="{{ route('weight-logs.index') }}" class="btn btn-back">戻る</a>
                    <button type="submit" class="btn btn-update">更新</button>
                    <button type="button" class="btn btn-delete" onclick="confirmDelete({{ $log->id }})">削除</button>
                </div>
            </form>
        </div>
    </main>

    <script>
        function confirmDelete(id) {
            if (confirm('本当に削除しますか？')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/weight_logs/${id}`;
                const csrf = document.createElement('input');
                csrf.name = '_token';
                csrf.value = '{{ csrf_token() }}';
                csrf.type = 'hidden';
                const method = document.createElement('input');
                method.name = '_method';
                method.value = 'DELETE';
                method.type = 'hidden';
                form.appendChild(csrf);
                form.appendChild(method);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>
