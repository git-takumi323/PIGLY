<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiGLy - STEP2</title>
    <!-- CSSの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/register-step2.css') }}">
</head>
<body>
    <div class="background">
        <div class="container">
            <h1 class="title">PiGLy</h1>
            <h2 class="subtitle">新規会員登録</h2>

            <div class="step-info">STEP2 体重データの入力</div>

            <form method="POST" action="{{ route('register.step2.post') }}" novalidate >
                @csrf <!-- CSRF保護トークン -->

                <!-- 現在の体重 -->
                <div class="form-group">
                    <label for="current_weight">現在の体重</label>
                    <div class="input-wrapper">
                        <input
                            type="number"
                            id="current_weight"
                            name="current_weight"
                            value="{{ old('current_weight') }}"
                            placeholder="現在の体重を入力"
                        />
                        <span class="unit">kg</span>
                    </div>
                    <!-- 現在の体重に関連する全エラーメッセージ -->
                    @if ($errors->has('current_weight'))
                        <div class="error-messages">
                            <ul>
                                @foreach ($errors->get('current_weight') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <!-- 目標の体重 -->
                <div class="form-group">
                    <label for="target_weight">目標の体重</label>
                    <div class="input-wrapper">
                        <input
                            type="number"
                            id="target_weight"
                            name="target_weight"
                            value="{{ old('target_weight') }}"
                            placeholder="目標の体重を入力"
                        />
                        <span class="unit">kg</span>
                    </div>
                    <!-- 目標の体重に関連する全エラーメッセージ -->
                    @if ($errors->has('target_weight'))
                        <div class="error-messages">
                            <ul>
                                @foreach ($errors->get('target_weight') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn">アカウント作成</button>
            </form>
        </div>
    </div>
</body>
</html>
