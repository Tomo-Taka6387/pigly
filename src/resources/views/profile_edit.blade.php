@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile_edit.css') }}" />
@endsection

@section('content')
<div class="weight-edit">
    <h2 class="edit-title">Weight Log</h2>
    <form method="post" action="{{ route('weight_logs.update', ['weightLogId' => $weightLog->id]) }}">
        @csrf
        @method('PUT')

        <div class="input-box">
            <label class="box-title">日付</label>
            <input type="date" name="date" value="{{ old('date', $weightLog->date) }}">
            <div class="input-error">
                @error('date')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="input-box">
            <label class="box-title">体重</label>
            <input type="text" name="weight" value="{{ old('weight', $weightLog->weight) }}">
            <div class="input-error">
                @error('weight')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="input-box">
            <label class="box-title">接種カロリー</label>
            <input type="text" name="calories" value="{{ old('calories', $weightLog->calories) }}">
            <div class="input-error">
                @error('calories')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="input-box">
            <label class="box-title">運動時間</label>
            <input type="time" name="exercise_time" step="60" value="{{ old('exercise_time', $weightLog->exercise_time) }}">
            <div class="input-error">
                @error('exercise_time')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="input-box">
            <label class="box-title">運動内容</label>
            <input type="text" name="exercise_content" value="{{ old('exercise_content', $weightLog->exercise_content) }}">
            <div class="input-error">
                @error('exercise_content')
                {{ $message }}
                @enderror
            </div>
        </div>

        <a href="{{ route('weight_logs.index') }}" class="btn-back">戻る</a>
        <button type="submit">更新</button>
    </form>
    <div class="edit-delete">
        <form method="post" action="{{ route('weight_logs.delete', ['weightLogId' => $weightLog->id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit">削除</button>
        </form>
    </div>
</div>