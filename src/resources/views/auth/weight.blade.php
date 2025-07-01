@extends('layouts.simple')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/weight.css') }}" />
@endsection

@section('content')
<div class="login-form__content">
    <div class="login-title__box">
        <h2 class="" weight-title>新規会員登録</h2>
        <h3 class="weight-title_sub">STEP2&emsp;体重データの入力 </h3>
    </div>
    @if ($errors->any())
    <div class="form__error">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form class="form" action="{{ route('register.step2.post') }}" method="post">
        @csrf
        <div class="form__group">
            <div class="weight-form_box">
                <label class="weight-form_title" for="weigh">現在の体重</label>
                <input class="weight-form_box" type="text" name="weight" id="weigh" placeholder="現在の体重を入力" />
                <div class="form__error">
                    @error('weight')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="weight-form_box">
                <label class="weight-form_title" for="target_weight">目標の体重</label>
                <input class="weight-form_box" type="text" name="target_weight" id="target_weight" placeholder="目標の体重を入力" />
                <div class="form__error">
                    @error('target_weight')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <button class="login__button-submit" type="submit">アカウントを作成</button>
    </form>

</div>
@endsection