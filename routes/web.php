<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PublicPostController;
use App\Http\Controllers\PublicPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/posts/{slug}', [PublicPostController::class, 'show'])->name('posts.show');
Route::get('/category/{slug}', [PublicPostController::class, 'category'])->name('category.show');
Route::get('/page/{slug}', [PublicPageController::class, 'show'])->name('pages.show');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Temporary route for testing CSRF issue (outside middleware groups)
Route::post('admin/posts-test', [PostController::class, 'store'])->name('admin.posts.store.test')->middleware(['auth']);

// Simple test route to verify CSRF bypass
Route::post('test-csrf', function() {
    return response()->json(['status' => 'success', 'message' => 'CSRF bypass working']);
})->name('test.csrf');

// Admin Routes (Protected)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Categories (Super Admin only)
    Route::middleware(['role:superadmin'])->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('pages', PageController::class);
        Route::resource('users', UserController::class);
    });

    // Posts (All authenticated users, with policy authorization)
    Route::resource('posts', PostController::class);

    // Test form route
    Route::get('posts/test-form', function() {
        $categories = \App\Models\Category::all();
        return view('admin.posts.test-form', compact('categories'));
    })->name('posts.test.form');
});
