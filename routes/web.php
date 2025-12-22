<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| USER / PUBLIC (TAMPILAN KAYAK MEDIUM)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');
});

Route::middleware(['auth','role:staff'])
    ->prefix('staff')
    ->name('staff.')
    ->group(function () {
        Route::resource('articles', StaffArticleController::class);
    });

