<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookDetail extends Model
{
    use HasFactory;

    protected $table = 'booksdetail'; // Sesuai nama tabel di database
    protected $fillable = ['book_id', 'genre', 'description', 'copies'];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
