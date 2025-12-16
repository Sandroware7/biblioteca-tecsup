<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route;


Route::get('/', [BookController::class, 'catalog'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::resource('books', BookController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/books/{book}/loan', [LoanController::class, 'create'])->name('loans.create');
    Route::post('/books/{book}/loan', [LoanController::class, 'store'])->name('loans.store');

    Route::patch('/loans/{loan}/return', [LoanController::class, 'returnBook'])->name('loans.return');

    Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');

    Route::patch('/loans/{loan}/return', [LoanController::class, 'returnBook'])->name('loans.return');
});

require __DIR__.'/auth.php';
