<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/book/{id}', [App\Http\Controllers\HomeController::class, 'show'])->name('book.show');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('auth')->group(function () {
        Route::post('/book/{id}/borrow', [LoanController::class, 'borrowBook'])->name('book.borrow');
        Route::get('/my-books', [LoanController::class, 'myBooks'])->name('my.books');
    });

    Route::middleware([IsAdmin::class])->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('books', BookController::class);

        Route::resource('categories', CategoryController::class);

        Route::resource('members', MemberController::class);

        Route::resource('loans', LoanController::class);

    });
});

require __DIR__.'/auth.php';
