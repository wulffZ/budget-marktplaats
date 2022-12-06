<?php

use App\Http\Controllers\BidController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostController;

// Index
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Protected routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Dashboard
    Route::get('/dashboard', [PostController::class, "index"])->name('dashboard');

    // Create
    Route::get('/post/create', [PostController::class, "create"])->name('post.create');

    // Store
    Route::post('/post/create', [PostController::class, "store"])->name('post.store');

    // Show
    Route::get('/post/update/{id}', [PostController::class, "edit"])->name('post.edit');

    // Edit
    Route::get('/post/{id}', [PostController::class, "show"])->name('post.show');

    // Delete
    Route::get('/post/delete/{id}', [PostController::class, "destroy"])->name('post.destroy');

    // Post edit
    Route::post('/post/update/{id}', [PostController::class, "update"])->name('post.update');

    // Bid store
    Route::post('/bid', [BidController::class, "store"])->name('bid.store');

    // Bid destroy
    Route::get('/bid/{id}', [BidController::class, "destroy"])->name('bid.destroy');
});
