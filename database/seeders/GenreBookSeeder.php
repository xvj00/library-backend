<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = Book::all();
        $genres = Genre::all();

        // Для каждого book прикрепляем случайного автора
        foreach ($books as $book) {
            $book->genres()->attach(
                $genres->random()->id
            );
        }

        foreach ($genres as $genre) {
            $genre->books()->attach(
                $books->random()->id
            );
        }
    }
}
