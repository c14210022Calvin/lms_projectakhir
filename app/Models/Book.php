<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['isbn', 'title', 'copies', 'author', 'year'];

    public function show($id)
    {
        $book = Book::with('detail')->findOrFail($id); // Load book along with its details
        return view('books.show', compact('book'));
    }
}
