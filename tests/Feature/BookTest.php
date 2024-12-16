<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Book;
use Tests\TestCase;

class BookTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    use RefreshDatabase;

    public function test_can_create_book()
    {
        $response = $this->postJson('api/books', [
            'title' => 'Sample Book',
            'author' => 'Author Name',
            'year' => 2021,
            'isbn' => '1234567890',
            'copies' => 5,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('books', ['title' => 'Sample Book']);
    }

    /** @test */
    public function it_returns_a_list_of_books()
    {
        // Arrange: Membuat 10 data dummy buku menggunakan factory
        Book::factory()->count(10)->create();

        // Act: Mengirimkan request GET ke endpoint /api/books
        $response = $this->get('/api/books');

        // Assert: Memastikan status response adalah 200 dan data yang dikembalikan adalah JSON
        $response->assertStatus(200)
            ->assertJsonCount(10)  // Pastikan ada 10 buku yang dikembalikan
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'title',
                    'author',
                    'year',
                    'isbn',
                    'copies',
                    'created_at',
                    'updated_at',
                ],
            ]);
    }
}
