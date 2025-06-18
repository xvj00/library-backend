<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    protected $table = 'genres';
    protected $guarded = false;


    public function books()
    {
        return $this->belongsToMany(Book::class, 'genre_books', 'genre_id', 'book_id');
    }
}
