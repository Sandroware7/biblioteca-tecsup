<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Agregué esto para que funcione Auth::user()
use App\Models\User;
use App\Models\Book;
use App\Models\Loan;

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS (Nadie necesita loguearse)
|--------------------------------------------------------------------------
*/
Route::get('/', [BookController::class, 'catalog'])->name('home');

/*
|--------------------------------------------------------------------------
| RUTAS COMUNES (Usuarios Logueados: Admins y Estudiantes)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // 1. EL DASHBOARD (Lógica mixta que ya tenías)
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

    // 2. PERFIL (Cualquiera puede editar su propio perfil)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 3. PRÉSTAMOS (El estudiante necesita poder PEDIR un libro)
    // Dejamos esto fuera del admin para que el estudiante pueda dar click en "Prestar"
    Route::get('/books/{book}/loan', [LoanController::class, 'create'])->name('loans.create');
    Route::post('/books/{book}/loan', [LoanController::class, 'store'])->name('loans.store');

    /*
    |--------------------------------------------------------------------------
    | ZONA BLINDADA: SOLO ADMINISTRADORES
    |--------------------------------------------------------------------------
    | Aquí aplicamos el middleware 'admin' que creamos.
    | Si un estudiante intenta entrar aquí -> ERROR 403.
    */
    Route::middleware(['admin'])->group(function () {

        // Gestión total de libros (Crear, Editar, Eliminar)
        Route::resource('books', BookController::class);

        // Ver todos los préstamos del sistema
        Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');

        // Procesar la devolución de un libro (Normalmente lo hace el bibliotecario)
        Route::patch('/loans/{loan}/return', [LoanController::class, 'returnBook'])->name('loans.return');
    });

});

require __DIR__.'/auth.php';
