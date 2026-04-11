<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuidelieAiActionsController;
use App\Http\Controllers\HospitalDemoController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\NotificationCenterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/hospitals', [HospitalDemoController::class, 'index'])->name('hospitals.index');
Route::get('/dashboard/hospitals', [HospitalDemoController::class, 'index'])->name('dashboard.hospitals');
Route::get('/hospitals/{hospital}', [HospitalDemoController::class, 'show'])->name('hospitals.show');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/data', [DashboardController::class, 'data'])->name('dashboard.data');
Route::get('/guidelie_ai_actios', [GuidelieAiActionsController::class, 'index'])->name('guidelie.ai.actions');
Route::post('/guidelie_ai_actios/ask', [GuidelieAiActionsController::class, 'ask'])->name('guidelie.ai.actions.ask');
Route::get('/notifications', [NotificationCenterController::class, 'index'])->name('notifications.index');
Route::post('/notifications', [NotificationCenterController::class, 'send'])->name('notifications.send');
Route::get('/notifications/pharmacy', [NotificationCenterController::class, 'index'])->name('notifications.pharmacy.index');
Route::post('/notifications/pharmacy', [NotificationCenterController::class, 'send'])->name('notifications.pharmacy.send');
Route::get('/recommendations', [DashboardController::class, 'index'])->name('recommendations');
Route::view('/design-options', 'landing-options')->name('landing.options');
