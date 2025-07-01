<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterWeightRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\WeightTarget;
use App\Models\WeightLog;
use App\Models\User;

class AuthController extends Controller
{
    public function showStep1()
    {
        return  view('auth.register');
    }

    public function showStep2()
    {
        return view('auth.weight');
    }

    public function postStep1(RegisterRequest $request)
    {
        $validated = $request->validated();
        $data = $request->validated();

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        session([
            'register.name' => $validated['name'],
            'register.email' => $validated['email'],
            'register.password' => $validated['password'],
        ]);
        Auth::login($user);

        return redirect()->route('register.step2');
    }


    public function store(RegisterWeightRequest $request)
    {
        $user = Auth::user();

        WeightTarget::updateOrCreate(
            ['user_id' => $user->id],
            ['target_weight' => $request->input('target_weight')],
        );

        WeightLog::create([
            'user_id' => $user->id,
            'weight' => $request->input('weight'),
            'date' => now(),
        ]);
        return redirect()->route('weight_logs.index');
    }

    public function index()
    {
        $logs = WeightLog::where('user_id', auth()->id())
            ->orderBy('date', 'asc')
            ->get();

        return view('weight_logs.index', compact('logs'));
    }
}
