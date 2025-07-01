<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <h1 class="header__logo">PiGLy</h1>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <nav class="header-btm">
                <a href="{{ route('weight_target.edit') }}">目標体重設定</a>
                <button type="submit">ログアウト</button>
            </nav>
        </form>
    </header>

    <main>
        @yield('content')
    </main>
    @yield('js')
</body>

</html>