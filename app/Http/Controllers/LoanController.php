<?php
namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index() {
        // Ambil data buku dan members
        $books = Book::all(); // Fetch all books
        $members = Member::all(); // Fetch all members

        return view('books.loan', compact('books', 'members'));
    }

    public function borrow(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
        ]);

        $book = Book::find($validated['book_id']);
        if ($book->copies < 1) {
            return response()->json([
                'status' => 'error',
                'message' => 'No copies available',
            ], 400);
        }
    
        // Create a new loan record
        $loan = Loan::create([
            'book_id' => $validated['book_id'],
            'member_id' => $validated['member_id'],
            'borrowed_at' => now(),
        ]);
    
        // Decrement the book's available copies
        $book->decrement('copies');
    
        // Return a success response with the loan details
        return response()->json([
            'status' => 'success',
            'message' => 'Book borrowed successfully',
            'data' => $loan,
        ], 201);
    }

    public function returnBook($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->update(['returned_at' => now()]);
        $loan->book->increment('copies');
        return $loan;
    }
}
