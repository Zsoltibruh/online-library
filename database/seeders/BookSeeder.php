<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        Book::factory()
            ->count(20)
            ->hasAttached(Author::factory()->count(fake()->numberBetween(1, 3)))
            ->create()
            ->each(function (Book $book) use ($categories) {
                $book->categories()->attach(
                    $categories->random(fake()->numberBetween(1, 3))
                );
            });
    }
}
