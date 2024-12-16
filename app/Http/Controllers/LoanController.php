<?php
namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function borrow(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
        ]);

        $book = Book::find($validated['book_id']);
        if ($book->copies < 1) {
            return response()->json(['error' => 'No copies available'], 400);
        }

        $loan = Loan::create([
            'book_id' => $validated['book_id'],
            'member_id' => $validated['member_id'],
            'borrowed_at' => now(),
        ]);

        $book->decrement('copies');
        return $loan;
    }

    public function returnBook($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->update(['returned_at' => now()]);
        $loan->book->increment('copies');
        return $loan;
    }
}
