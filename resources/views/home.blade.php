<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StaffArticleController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\StaffCategoryController;
use App\Http\Controllers\StaffUserController;

/*
|--------------------------------------------------------------------------
| PUBLIC / GUEST ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [GuestController::class, 'home'])->name('home');
Route::get('/search', [GuestController::class, 'search'])->name('guest.search');

/*
|--------------------------------------------------------------------------
| GUEST ROUTES (LOGIN REQUIRED)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/articles/{article}', [GuestController::class, 'showArticle'])
        ->name('guest.article.show');

    Route::get('/category/{category}', [GuestController::class, 'articlesByCategory'])
        ->name('guest.category.articles');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/users', [AdminController::class, 'users'])->name('users.index');
        Route::get('/staff/create', [AdminController::class, 'createStaff'])->name('staff.create');
        Route::post('/staff/store', [AdminController::class, 'storeStaff'])->name('staff.store');

        // ARTICLE MANAGEMENT
        Route::resource('articles', ArticleController::class);

        // CATEGORY MANAGEMENT
        Route::resource('categories', CategoryController::class);
    });

/*
|--------------------------------------------------------------------------
| STAFF ROUTES  ✅ FIXED
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:staff'])
    ->prefix('staff')
    ->name('staff.')
    ->group(function () {

        // ✅ STAFF DASHBOARD (INI YANG KURANG)
        Route::get('/dashboard', function () {
            return view('staff.dashboard');
        })->name('dashboard');

        // ARTICLE MANAGEMENT (STAFF)
        Route::resource('articles', StaffArticleController::class);

        // OPTIONAL: kalau sidebar staff punya kategori & user
        Route::resource('categories', StaffCategoryController::class)->only(['index']);
        Route::resource('users', StaffUserController::class)->only(['index']);
    });
