<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Book;
use App\Models\Edition;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake() -> sentence(1),
            'description' => fake() -> paragraph(5),
            'edition_id' => Edition::inRandomOrder()->first()->id,
        ];

    }

//    public function configure()
//   {
//        return $this->afterCreating(function (Book $book) {
//            $images = [
//                'https://i.pinimg.com/736x/bd/4c/24/bd4c246c3cff3738782185ef598df7b2.jpg',
//                'https://avatars.mds.yandex.net/i?id=b0e52f6194678dfe30574c9ad9063611_l-7011647-images-thumbs&n=13',
//                'https://static2.my-shop.ru/products17/160754/cover.jpg',
//                'https://www.umniza.de/WebRoot/Store22/Shops/62303963/5786/B989/85A8/4D82/DCF1/C0A8/2ABA/CECB/978-5-9268-2192-2.jpg',
//                'https://img.chaconne.ru/img/3923809_720882.jpg',
//                'https://rainbowread.wordpress.com/wp-content/uploads/2017/10/i551674.jpg',
//                'https://i.pinimg.com/736x/01/2a/d1/012ad16c9e15e88cbb5230f150ac3705--vintage-book-covers-vintage-books.jpg'
//
//            ];
//
//            $book->addMediaFromUrl($images[array_rand($images)])
//                ->toMediaCollection('book_images');
//        });
//    }
}
