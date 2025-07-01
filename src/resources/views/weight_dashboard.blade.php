@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/weight_dashboard.css') }}" />
<link rel="stylesheet" href="{{ asset('css/modal.css') }}" />
@endsection

@section('content')
<div class="weight_dashboard">
    <div class="weight-box">
        <div class="weight-box_target">
            <h3 class="weight-title">目標体重</h3>
            <p class="weight-date">{{ optional($weightTarget)->target_weight }}kg</p>
        </div>
        <div class="weight-box_goal">
            <h3 class="weight-title">目標まで</h3>
            @if($weightTarget && $latestLog)
            <p>{{ number_format($latestLog->weight - $weightTarget->target_weight, 1) }} kg</p>
            @else
            <p>-</p>
            @endif
        </div>
        <div class="weight-box_current">
            <h3 class="weight-title">最新体重</h3>
            <p>{{ optional($latestLog)->weight ? number_format($latestLog->weight, 1) . ' kg' : '-' }}</p>
        </div>
    </div>
    <form class="weight_form" method="get" action="{{ route('weight_logs.index') }}">
        @csrf
        <label class="weight-form_date">
            <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}">
            <span id="start_date_display">{{ request('start_date') ? \Carbon\Carbon::parse(request('start_date'))->format('Y年m月d日') : '' }}</span>
        </label>
        <label class="weight-form_date">
            <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}">
            <span id="end_date_display">{{ request('end_date') ? \Carbon\Carbon::parse(request('end_date'))->format('Y年m月d日') : '' }}</span>
        </label>
        <button type="submit">検索</button>
    </form>
    <button type="button" id="openModal" class="btn-create">データ追加</button>


    <div id="modal" class="modal" style="display: none;">
        <div class="modal-content">

            <h2 class="modal-title">Weight Log を追加</h2>

            <form method="post" action="{{ route('weight_logs.store') }}">
                @csrf

                <div class="input-box">
                    <label class="box-title">日付</label>
                    <input type="date" name="date" value="{{ old('date', \Carbon\Carbon::today()->toDateString()) }}" placeholder="年/月/日">
                    <div class="input-error">
                        @error('date')
                        {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="input-box">
                    <label class="box-title">体重</label>
                    <input type="text" name="weight" value="{{ old('weight') }}" placeholder="50.0">
                    <div class="input-error">
                        @error('weight')
                        {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="input-box">
                    <label class="box-title">接種カロリー</label>
                    <input type="text" name="calories" value="{{ old('calories') }}" placeholder="1200">
                    <div class="input-error">
                        @error('calories')
                        {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="input-box">
                    <label class="box-title">運動時間</label>
                    <input type="time" name="exercise_time" value="{{ old('exercise_time') }}" placeholder="00:00">
                    <div class="input-error">
                        @error('exercise_time')
                        {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="input-box">
                    <label class="box-title">運動内容 </label>
                    <input type="text" name="exercise_content" value="{{ old('exercise_content') }}" placeholder="運動内容を追加">
                    <div class="input-error">
                        @error('exercise_content')
                        {{ $message }}
                        @enderror
                    </div>
                </div>

                <a href="{{ route('weight_logs.index') }}" class="btn-back">戻る</a>
                <button type="submit">登録</button>
            </form>
        </div>
    </div>

    <div class="weight-dashboard_table">
        <table>
            <thead>
                <tr>
                    <th>日付</th>
                    <th>体重</th>
                    <th>食事接種カロリー</th>
                    <th>運動時間</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($weightLogs as $log)
                <tr>
                    <td title="記録日">{{ \Carbon\Carbon::parse($log->date)->format('Y/m/d') }}</td>
                    <td title="体重">{{ number_format($log->weight, 1) }} kg</td>
                    <td title="食事摂取カロリー">{{ number_format($log->calories ?? 0) }} cal</td>
                    <td title="運動時間">
                        @php
                        $hours = floor(($log->exercise_minutes ?? 0) / 60);
                        $minutes = ($log->exercise_minutes ?? 0) % 60;
                        @endphp
                        {{ $hours }}:{{ $minutes }}
                    </td>
                    <td>
                        <a href="{{ route('weight_logs.edit', ['weightLogId' => $log->id]) }}">編集</a>
                    </td>
                    @empty
                <tr>
                    <td colspan="4">データがありません。</td>
                </tr>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $weightLogs->links() }}
</div>
@endsection

@php
$hasErrors = $errors->any();
@endphp

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('modal');
        const openModal = document.getElementById('openModal');

        if (openModal) {
            openModal.addEventListener('click', () => {
                modal.style.display = 'block';
            });
        }

        const hasErrors = @json($hasErrors);

        if (hasErrors) {
            modal.style.display = 'block';
        }
    });
</script>
@endsection