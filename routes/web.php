<?php

use App\Http\Controllers\MedicalHistoryController;
use App\Http\Controllers\Web\GetBpmLatestController;
use App\Http\Controllers\Web\PatientController;
use App\Models\SensorsValue;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::resources([
        'patient' => PatientController::class,
        'medical-history' => MedicalHistoryController::class,
    ]);

    Route::get('latest-bpm/{patient}', GetBpmLatestController::class)->name('latest-bpm');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
