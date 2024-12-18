<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        // return Book::all();
        // return response()->json(Book::all(), 200);

        $query = Book::query();

        // Definisikan $search terlebih dahulu agar selalu tersedia
        $search = null;

        // Jika ada parameter search, filter data
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'LIKE', "%{$search}%")
                ->orWhere('author', 'LIKE', "%{$search}%");
        }

        $books = $query->get();

        // Jika request menginginkan JSON (misalnya untuk testing)
        if ($request->wantsJson() || $request->has('api')) {
            $books = Book::all();
            return response()->json($books, 200);
        }

        return view('books.index', compact('books', 'search'));

    }

    public function listBooks()
    {
        // Ambil semua data buku dari database
        $books = Book::all();

        // Kirim data buku ke view 'books.index'
        return view('books.index', compact('books'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //tes
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd('Rute store() terakses', $request->all()); // Debugging
        \Log::info('Request Data: ', $request->all());
        try {
            $validated = $request->validate([
                'title' => 'required',
                'author' => 'required',
                'year' => 'required|integer',
                'isbn' => 'required|unique:books',
                'copies' => 'required|integer',
            ]);

            // return Book::create($validated);
            \Log::info('Validated Data: ', $validated);

            $book = Book::create($validated);

            \Log::info('Book Created:', $book->toArray());  // Logging book creation

            return response()->json($book, 201);
        } catch (\Exception $e) {
            \Log::error('Error Creating Book:', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to create book', 'message' => $e->getMessage()], 500);
        }
    }
    // public function store(Request $request)
    // {
    //     return response()->json(['message' => 'Book created'], 201);
    // }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        return Book::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $book = Book::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'year' => 'required|integer',
            'isbn' => 'required',
            'copies' => 'required|integer',
        ]);

        $book->update($validated);
        return $book;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Book::findOrFail($id)->delete();
        return response()->noContent();
    }
}
