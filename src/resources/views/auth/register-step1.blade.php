<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiGLy - 新規会員登録</title>
    <!-- CSSファイルを読み込み -->
    <link rel="stylesheet" href="{{ asset('css/register-step1.css') }}">
</head>
<body>
    <div class="container">
        <h1 class="title">PiGLy</h1>
        <h2 class="subtitle">新規会員登録</h2>

        <div class="step-info">STEP1 アカウント情報の登録</div>

        <form method="POST" action="{{ route('register.step1.post') }}" novalidate>
            @csrf <!-- CSRF保護のトークン -->
            <div class="form-group">
                <label for="name">お名前</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="名前を入力"
                    required
                />
                @if ($errors->has('name'))
                    <div class="error-message">
                        <ul>
                            @foreach ($errors->get('name') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="メールアドレスを入力"
                    required
                />
                @if ($errors->has('email'))
                    <div class="error-message">
                        <ul>
                            @foreach ($errors->get('email') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="password">パスワード</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="パスワードを入力"
                    required
                />
                @if ($errors->has('password'))
                    <div class="error-message">
                        <ul>
                            @foreach ($errors->get('password') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>


            <button type="submit" class="btn">次に進む</button>
        </form>

        <a href="/login" class="link">ログインはこちら</a>
    </div>
</body>
</html>
