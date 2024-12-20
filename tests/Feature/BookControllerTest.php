<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Book;

class BookControllerTest extends TestCase
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

    public function test_store_book_with_boundary_data()
    {

        // Buat pengguna dan autentikasi
        $user = User::factory()->create([
            'role' => 'admin', // Atur role langsung
        ]);
        // $user->assignRole('admin'); // Tambahkan role admin

        $this->actingAs($user);

        // Debug role pengguna
        // \Log::info('User Roles:', $user->roles->pluck('name')->toArray());
        \Log::info('User Role:', [auth()->user()->role]);

        // Data valid pada batas bawah
        $response = $this->postJson(route('books.store'), [
            'title' => 'A', // batas bawah
            'author' => 'B', // batas bawah
            'year' => 2000,
            'isbn' => '1234567890',
            'copies' => 1, // batas bawah
        ]);

        // $response->dump(); // Debug respons jika gagal
        $response->assertStatus(201);
        $this->assertDatabaseHas('books', ['title' => 'A', 'author' => 'B']);

        // Data tidak valid pada batas bawah
        $response = $this->postJson(route('books.store'), [
            'title' => '', // tidak valid
            'author' => '', // tidak valid
            'year' => 2000,
            'isbn' => '1234567890',
            'copies' => -1, // tidak valid
        ]);

        // $response->dump();
        // \Log::error($response->getContent());

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['title', 'author', 'copies']);
    }

    public function test_store_book_with_non_latin_characters()
    {
        $user = User::factory()->create([
            'role' => 'admin', // Atur role langsung
        ]);
        // $user->assignRole('admin'); // Tambahkan role admin

        $this->actingAs($user);

        // Data dengan karakter non-Latin
        $response = $this->postJson(route('books.store'), [
            'title' => '本',
            'author' => 'محمد',
            'year' => 2023,
            'isbn' => '9876543210',
            'copies' => 5,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('books', ['title' => '本', 'author' => 'محمد']);
    }

    public function test_search_books_with_non_latin_characters()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Menambahkan data ke database
        Book::factory()->create(['title' => 'كتاب', 'author' => 'المؤلف']);

        // Melakukan pencarian
        $response = $this->getJson(route('books.index', ['search' => 'كتاب']));

        $response->assertStatus(200);
        $response->assertJsonFragment(['title' => 'كتاب']);
    }

}
