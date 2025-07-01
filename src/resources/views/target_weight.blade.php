@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/target_weight.css') }}" />
@endsection

@section('content')
<div class="target-weight">
    <div class="target-weight_box">
        <div class="target-weight_title">
            <h2>目標体重設定</h2>
        </div>
        <form method="post" action="{{ route('weight_target.update') }}">
            @csrf
            <input type="text" name="target_weight" id="target_weight"
                value="{{ old('target_weight', optional($weightTarget)->target_weight ?? '') }}">
            <div class="error-form">
                @error('target_weight')
                {{ $message }}
                @enderror
            </div>
            <div class="target-btm">
                <a href="{{ route('weight_logs.index') }}">戻る</a>
                <button type="submit">更新</button>
            </div>
        </form>
    </div>
</div>
@endsection