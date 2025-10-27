<?php

use App\Http\Controllers\FoodSpotController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReviewController;

Route::get('/', [FoodSpotController::class, 'index'])->name('home');
Route::get('/foodspots/{foodspot}', [FoodSpotController::class, 'show'])->name('foodspots.show');
Route::post('/foodspots/{foodspot}/comment', [FoodSpotController::class, 'comment'])->name('foodspots.comment');
Route::post('/foodspots/{foodspot}/reviews', [FoodSpotController::class, 'review'])->name('foodspots.review');
Route::post('/reviews/{review}/reply', [FoodSpotController::class, 'replyToReview'])->middleware('auth:admin')->name('reviews.reply');

// Search
Route::get('/search', [FoodSpotController::class, 'search'])->name('search.index');

// Static Pages
Route::view('/terms-of-service', 'terms')->name('terms');
Route::view('/about-us', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::view('/privacy-policy', 'privacy')->name('privacy');
Route::view('/careers', 'careers')->name('careers');
Route::view('/image-policy', 'image-policy')->name('images');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Auth
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::get('/register', [AdminAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AdminAuthController::class, 'register'])->name('register');

    // Protected Admin Routes
    Route::middleware(['auth:admin', 'no.cache'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::resource('foodspots', FoodSpotController::class);
        Route::post('/reviews/{id}/reply', [AdminController::class, 'reply'])->name('reviews.reply');
    });
});

// Redirect /login to admin login
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Likes (assuming user auth, but adjust if needed)
Route::post('/foodspots/{foodspot}/like', [LikeController::class, 'store'])->middleware('auth')->name('foodspots.like');
Route::delete('/foodspots/{foodspot}/unlike', [LikeController::class, 'destroy'])->middleware('auth')->name('foodspots.unlike');
