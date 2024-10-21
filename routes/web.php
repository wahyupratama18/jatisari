<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BookMemberController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReturnedBookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('profile')->controller(ProfileController::class)->name('profile.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });

    Route::resource('book', BookController::class);

    Route::resource('member', MemberController::class);

    Route::resource('borrow', BookMemberController::class)->except(['show', 'edit', 'destroy']);

    Route::resource('returned', ReturnedBookController::class)->only(['index']);
});

require __DIR__.'/auth.php';
