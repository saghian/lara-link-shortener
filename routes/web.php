<?php

use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('/console')->middleware(['auth'])->group(function () {
    // Test Route
    Route::get('/', function () {
        // return view('dashboard.dashboard');
        return view('panel.posts.index');
    })->name('console.index');

    Route::get('/link-edit', function () {
        return view('panel.link.edit');
    });

    Route::resource('link', LinkController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// مسیر catch-all برای لینک‌های کوتاه - باید در انتها قرار گیرد
Route::get('/{shortLink}', [LinkController::class, 'redirect'])
    ->where('shortLink', '^(?!console|auth|login|register|report|profile).+$')
    ->name('redirect');


require __DIR__ . '/auth.php';
