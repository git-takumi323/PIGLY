<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PiGLy')</title>
    <!-- 共通CSS -->
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <!-- 各ページのCSS -->
    @yield('css')
</head>
<body>
    <div class="background">
        <div class="container">
            <h1 class="title">PiGLy</h1>
            @yield('content')
        </div>
    </div>
</body>
</html>
