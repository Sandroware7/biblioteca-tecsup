<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function create(Book $book)
    {
        if ($book->available < 1) {
            return back()->with('error', 'No hay ejemplares físicos disponibles para prestar.');
        }

        $users = User::all();

        return view('loans.create', compact('book', 'users'));
    }

    public function store(Request $request, Book $book)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'loan_date' => 'required|date',
        ]);

        if ($book->available < 1) {
            return redirect()->route('books.index')->with('error', 'El libro ya no tiene stock físico.');
        }

        Loan::create([
            'book_id' => $book->id,
            'user_id' => $request->input('user_id'),
            'loan_date' => $request->input('loan_date'),
        ]);

        $book->decrement('available');

        return redirect()->route('books.index')->with('success', 'Préstamo registrado correctamente. Stock actualizado.');
    }

    public function index()
    {
        $loans = Loan::with(['book', 'user'])
            ->whereNull('return_date')
            ->get();

        return view('loans.index', compact('loans'));
    }

    public function returnBook(Loan $loan)
    {
        $loan->update([
            'return_date' => now(),
        ]);

        $loan->book->increment('available');

        return back()->with('success', 'Libro devuelto correctamente. Disponibilidad actualizada.');
    }
}
