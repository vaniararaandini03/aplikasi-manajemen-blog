<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffArticleController;
use App\Http\Controllers\Admin\ArticleController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Logout (POST)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register (publik hanya untuk role staff)
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (role: admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function() {

    // Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // CRUD Articles Admin
    Route::resource('articles', ArticleController::class);

    // Form buat staff baru
    Route::get('staff/create', [AdminController::class, 'createStaff'])->name('staff.create');

    // Simpan staff baru
    Route::post('staff/store', [AdminController::class, 'storeStaff'])->name('staff.store');
});

/*
|--------------------------------------------------------------------------
| STAFF ROUTES (role: staff)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:staff'])->prefix('staff')->name('staff.')->group(function() {

    // CRUD Articles Staff
    Route::resource('articles', StaffArticleController::class);
});
