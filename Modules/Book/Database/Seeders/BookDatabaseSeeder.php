<?php

namespace Modules\Book\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Book\Database\factories\BookFactory;
use Modules\Book\Entities\Book;

class BookDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        for ($i = 0; $i < 3; $i++) {
            $factory = app(BookFactory::class)->definition();

            $book = Book::createBook(
                $factory['title'],
                $factory['author'],
                $factory['category'],
                $factory['price'],
                $factory['quantity'],
                $factory['published_by']
            );

            $book->update([
                'excerpt' => $factory['excerpt'],
                'description' => $factory['description'],
                'status' => rand(0, 10) > 5 ? Book::STATUS_PUBLISHED : Book::STATUS_UNPUBLISHED
            ]);
        }
    }
}
