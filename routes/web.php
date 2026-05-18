<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AiRecommendationController;
use App\Http\Controllers\AiDailySummaryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::post('/tasks/{task}/generate-ai', [AiRecommendationController::class, 'generate'])
        ->middleware('throttle:ai-generate')
        ->name('tasks.generate-ai');

    Route::post('/dashboard/generate-daily-summary', [AiDailySummaryController::class, 'generate'])
        ->middleware('throttle:ai-generate')
        ->name('dashboard.generate-daily-summary');

    Route::view('/about', 'about')->name('about');

    Route::view('/guide', 'guide')->name('guide');

    Route::resource('subjects', SubjectController::class);

    Route::resource('tasks', TaskController::class);

    Route::patch('/tasks/{task}/quick-status', [TaskController::class, 'quickUpdateStatus'])
        ->name('tasks.quick-status');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__ . '/auth.php';
