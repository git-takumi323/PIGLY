@extends('layouts.auth')

@section('title', 'PiGLy - ログイン')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <h2 class="subtitle">ログイン</h2>

    <form action="/login" method="POST" novalidate>
        @csrf
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="メールアドレスを入力" required />
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" placeholder="パスワードを入力" required />
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn">ログイン</button>
    </form>

    <a href="{{ route('register.step1') }}" class="link">アカウント作成はこちら</a>
@endsection
