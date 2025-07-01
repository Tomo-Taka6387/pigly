@extends('layouts.simple')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}" />
@endsection

@section('content')
<div class="login-form__content">
    <div class="login-title__box">
        <h2>ログイン</h2>
    </div>
    <form class="form" action="/login" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <label class="login-form_title" for="email">メールアドレス</label>
                <input class="login-form_box" type="email" name="email" id="email" placeholder="メールアドレスを入力" />
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <label class="login-form_title" for="password">パスワード</label>
                <input class="login-form_box" type="password" name="password" id="password" placeholder="パスワードを入力" />
            </div>
            <div class="form__error">
                @error('password')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="login_form-btn">
            <button class="login__button-submit" type="submit">ログイン</button>
            <a class="form__button-submit" href="/register">アカウント登録はこちら</a>
        </div>
    </form>
</div>
@endsection