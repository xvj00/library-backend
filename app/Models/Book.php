<?php

namespace App\Models;

use App\Enums\ReservationsStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $guarded = ['image'];



    public function authors()
    {
        return $this->belongsToMany(Author::class, 'author_books', 'book_id', 'author_id');
    }


    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_books', 'book_id', 'genre_id');
    }

    public function editions()
    {
        return $this->belongsTo(Edition::class, 'edition_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'book_id');
    }
    public function isReserved() {
        return $this->reservations()->where('status', ReservationsStatus::BOOKED)->exists();
    }

    public function isConfirmed()
    {
        return $this->reservations()->where('status', ReservationsStatus::CONFIRMED)->exists();
    }

    public function isGiven()
    {
        return $this->reservations()->where('status', ReservationsStatus::GIVEN)->exists();
    }

    public function isCanceled()
    {
        return $this->reservations()->where('status', ReservationsStatus::CANCELED)->exists();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'book_id');
    }

}
