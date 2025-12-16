<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route;

use App\Models\User;
use App\Models\Book;
use App\Models\Loan;


Route::get('/', [BookController::class, 'catalog'])->name('home');


Route::get('/dashboard', function () {
    $user = Illuminate\Support\Facades\Auth::user();

    if ($user->role === 'admin') {
        $total_books = Book::count();
        $active_loans = Loan::whereNull('return_date')->count();
        $total_users = User::where('role', 'student')->count();

        $recent_loans = Loan::with(['book', 'user'])
            ->orderBy('loan_date', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact('total_books', 'active_loans', 'total_users', 'recent_loans'));
    }

    else {
        $my_loans = $user->loans()
            ->with('book')
            ->orderBy('loan_date', 'desc')
            ->get();

        return view('dashboard', compact('my_loans'));
    }

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
