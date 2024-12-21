<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['isbn', 'title', 'copies', 'author', 'year'];

    public function detail()
    {
        return $this->hasOne(BookDetail::class, 'book_id', 'id');
    }
}
