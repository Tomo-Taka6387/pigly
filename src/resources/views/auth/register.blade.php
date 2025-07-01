@extends('layouts.simple')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}" />
@endsection

@section('content')
<div class="login-form__content">
    <div class="login-title__box">
        <h2 class="register-title">新規会員登録</h2>
        <h3 class="register-title_sub">STEP1&emsp;アカウント情報の登録</h3>
    </div>
    <form class="form" action="{{ route('register.step1.post') }}" method="post">
        @csrf
        <div class="form__group">
            <div class="register-form_box">
                <label class="register-form_title" for="name">お名前</label>
                <input type="text" name="name" id="name" placeholder="名前を入力" value="{{ old('name') }}" />
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="register-form_box">
                <label for=”email" class="register-form_title">メールアドレス</label>
                <input type="email" name="email" id="email" placeholder="メールアドレスを入力" value="{{ old('email') }}" />
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="register-form_box">
                <label class="register-form_title" for="password">パスワード</label>
                <input type="password" name="password" id="password" placeholder="パスワードを入力" />
                <div class="form__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <div class="register-form_btn">
            <button class="register__button-submit" type="submit">次に進む</button>
            <a class="form__button-submit" href="/login">ログインはこちら</a>
        </div>
    </form>
</div>
@endsection