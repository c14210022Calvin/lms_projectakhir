<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3), // Judul dengan 3 kata
            'author' => $this->faker->name, // Nama penulis acak
            'year' => $this->faker->year, // Tahun acak
            'isbn' => $this->faker->isbn13, // ISBN 13 digit
            'copies' => $this->faker->numberBetween(1, 50), // Jumlah salinan antara 1 hingga 50
        ];
    }
}
