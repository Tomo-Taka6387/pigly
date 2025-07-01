<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WeightController;
use Illuminate\Auth\Events\Registered;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return view('login');
});

Route::get('/register/step1', [AuthController::class, 'showStep1'])->name('register.step1');
Route::post('/register/step1', [AuthController::class, 'postStep1'])->name('register.step1.post');

Route::middleware('auth')->group(function () {
    Route::get('/register/step2', [AuthController::class, 'showStep2'])->name('register.step2');
    Route::post('/register/step2', [AuthController::class, 'store'])->name('register.step2.post');
    Route::get('/weight_logs', [WeightController::class, 'index'])->name('weight_logs.index');
    Route::get('/weight_logs/create', [WeightController::class, 'create'])->name('weight_logs.create');
    Route::post('/weight_logs', [WeightController::class, 'store'])->name('weight_logs.store');
    Route::get('/weight_logs/goal_setting', [WeightController::class, 'goalSettingEdit'])->name('weight_target.edit');
    Route::post('/weight_logs/goal_setting', [WeightController::class, 'goalSettingUpdate'])->name('weight_target.update');
    Route::get('/weight_logs/{weightLogId}/edit', [WeightController::class, 'edit'])->name('weight_logs.edit');
    Route::put('/weight_logs/{weightLogId}', [WeightController::class, 'update'])->name('weight_logs.update');
    Route::delete('/weight_logs/{weightLogId}/delete', [WeightController::class, 'destroy'])->name('weight_logs.delete');
});
