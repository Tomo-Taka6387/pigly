<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeightRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use App\Http\Requests\RegisterWeightRequest;

class WeightController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $weightTarget = $user->weightTarget;

        $weightLogs = WeightLog::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(7);

        $latestLog = WeightLog::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();

        return view('weight_dashboard', compact('weightLogs', 'weightTarget', 'latestLog'));
    }

    public function create()
    {
        return view('weight_logs.create');
    }

    public function store(WeightRequest $request)
    {
        $request->user()->weightLogs()->create([
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);

        return redirect()->route('weight_logs.index');
    }
    public function goalSettingEdit()
    {
        $weightTarget = WeightTarget::where('user_id', Auth::id())->first();
        if (!$weightTarget) {
            $weightTarget = new WeightTarget();
        }
        return view('target_weight', compact('weightTarget'));
    }
    public function edit($weightLogId)
    {
        $weightLog = WeightLog::findOrFail($weightLogId);
        return view('profile_edit', compact('weightLog'));
    }

    public function update(WeightRequest $request, $weightLogId)
    {
        WeightTarget::updateOrCreate(
            ['user_id' => Auth::id()],
            ['target_weight' => $request->target_weight]
        );
        $request->merge([
            'exercise_time' => substr($request->exercise_time, 0, 5)
        ]);

        $validated = $request->validated();

        $weightLog = WeightLog::findOrFail($weightLogId);
        $weightLog->fill($validated);
        $weightLog->save();

        return redirect()->route('weight_logs.index');
    }

    public function destroy($weightLogId)
    {
        $weightLog = WeightLog::findOrFail($weightLogId);


        $weightLog->delete();

        return redirect()->route('weight_logs.index');
    }
}
