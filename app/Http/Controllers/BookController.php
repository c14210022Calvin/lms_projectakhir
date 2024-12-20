<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
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
        return view('books.create');
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
                'title' => 'required|string|min:1',
                'author' => 'required|string|min:1',
                'year' => 'required|integer|min:1900|max:' . date('Y'),
                'isbn' => 'required|unique:books|string|min:10',
                'copies' => 'required|integer|min:0',
            ]);

            // return Book::create($validated);
            \Log::info('Validated Data: ', $validated);

            $book = Book::create($validated);

            \Log::info('Book Created:', $book->toArray());  // Logging book creation

            // Cek apakah request JSON atau biasa
            if ($request->wantsJson()) {
                return response()->json($book, 201);
            }
            // Redirect ke halaman daftar buku dengan pesan sukses
            return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan!');
        } catch (ValidationException $e) {
            \Log::error('Validation Error:', $e->errors());
            return response()->json(['errors' => $e->errors()], 422);
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
        // Return view untuk form edit buku dengan data buku yang dipilih
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        try {
            $book = Book::findOrFail($id);
            $validated = $request->validate([
                'title' => 'required',
                'author' => 'required',
                'year' => 'required|integer',
                'isbn' => 'required',
                'copies' => 'required|integer',
            ]);

            $book->update($validated);
            // return $book;
            if ($request->wantsJson()) {
                return response()->json($book, 200);
            }

            return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui!');
        } catch (\Exception $e) {
            \Log::error('Error Updating Book:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('Gagal memperbarui buku.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        // Book::findOrFail($id)->delete();
        // return response()->noContent();
        try {
            $book = Book::findOrFail($id);
            $book->delete();

            return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus!');
        } catch (\Exception $e) {
            \Log::error('Error Deleting Book:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('Gagal menghapus buku.');
        }
    }
}
