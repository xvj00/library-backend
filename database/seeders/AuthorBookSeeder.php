<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = Book::all();
        $authors = Author::all();

        // Для каждого book прикрепляем случайного автора
        foreach ($books as $book) {
            $book->authors()->attach(
                $authors->random()->id
            );
        }
    }
}
