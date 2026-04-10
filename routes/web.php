<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HospitalDemoController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/hospitals', [HospitalDemoController::class, 'index'])->name('hospitals.index');
Route::get('/dashboard/hospitals', [HospitalDemoController::class, 'index'])->name('dashboard.hospitals');
Route::get('/hospitals/{hospital}', [HospitalDemoController::class, 'show'])->name('hospitals.show');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/data', [DashboardController::class, 'data'])->name('dashboard.data');
Route::get('/recommendations', [DashboardController::class, 'index'])->name('recommendations');
Route::view('/design-options', 'landing-options')->name('landing.options');
