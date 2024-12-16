<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;

class GetBooksTest extends TestCase
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

    /** @test */
    public function it_can_get_a_list_of_books()
    {
        // Arrange: Buat beberapa data buku di database
        Book::factory()->count(3)->create();

        // Act: Kirim permintaan GET ke endpoint /api/books
        $response = $this->getJson('/api/books');

        // Assert: Pastikan response memiliki status 200 OK dan struktur data JSON yang sesuai
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                'id',
                'title',
                'author',
                'isbn',
                'copies',
                'created_at',
                'updated_at',
            ],
        ]);
    }
}
