<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookDetail extends Model
{
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
