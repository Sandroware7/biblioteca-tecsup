<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Book;
use App\Models\Loan;


//RUTAS PuBLICAS (nadie necesita loguearse)
Route::get('/', [BookController::class, 'catalog'])->name('home');


//RUTAS COMUNES (Usuarios Logueados: admins y estudiantes)
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $total_books = Book::count();
            $active_loans = Loan::whereNull('return_date')->count();
            $total_users = User::where('role', 'student')->count();
            $recent_loans = Loan::with(['book', 'user'])->orderBy('loan_date', 'desc')->take(5)->get();

            return view('dashboard', compact('total_books', 'active_loans', 'total_users', 'recent_loans'));
        } else {
            $my_loans = $user->loans()->with('book')->orderBy('loan_date', 'desc')->get();
            return view('dashboard', compact('my_loans'));
        }
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/books/{book}/loan', [LoanController::class, 'create'])->name('loans.create');
    Route::post('/books/{book}/loan', [LoanController::class, 'store'])->name('loans.store');

    //ZONA BLINDADA: SOLO ADMINISTRADORES
    Route::middleware(['admin'])->group(function () {

        Route::resource('books', BookController::class);

        Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');

        Route::patch('/loans/{loan}/return', [LoanController::class, 'returnBook'])->name('loans.return');
    });

});

require __DIR__.'/auth.php';
