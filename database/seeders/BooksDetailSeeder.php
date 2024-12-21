<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = ['Fiction', 'Non-fiction', 'Mystery', 'Science Fiction', 'Fantasy', 'Romance', 'Thriller', 'Biography', 'History', 'Poetry'];
        $descriptions = [
            'A compelling tale of adventure and discovery.',
            'An in-depth analysis of historical events.',
            'A thrilling story full of unexpected twists.',
            'A heartwarming romance set in a small town.',
            'A journey through space and time with amazing discoveries.',
            'An exploration of the human condition through poetry.',
            'A gripping mystery that will keep you guessing.',
            'The life and achievements of a notable figure.',
            'A deep dive into the world of fantasy and magic.',
            'A detailed account of significant historical milestones.'
        ];

        // Ambil semua ID buku (misal ada 100 buku di tabel books)
        $bookIds = range(1, 100);
        shuffle($bookIds); // Acak ID untuk variasi

        $data = [];
        foreach ($bookIds as $bookId) {
            $data[] = [
                'book_id' => $bookId,
                'genre' => $genres[array_rand($genres)],
                'description' => $descriptions[array_rand($descriptions)],
                'copies' => rand(1, 100),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        DB::table('booksdetail')->insert($data);
    }
}
