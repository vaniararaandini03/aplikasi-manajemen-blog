<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StaffController;
use app\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::resource('dashboard', DashboardController::class);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('home', HomeController::class);