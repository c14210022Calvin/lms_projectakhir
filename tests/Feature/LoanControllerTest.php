<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Loan;
use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoanControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_books_and_members()
    {
        // Arrange: Seed data
        Book::factory()->count(3)->create();
        Member::factory()->count(3)->create();

        // Act: Call the index method
        $response = $this->get(route('loans.index')); // Adjust the route name if necessary

        // Assert: Check the response
        $response->assertStatus(200);
        $response->assertViewIs('books.loan'); // Assert the view
        $response->assertViewHasAll(['books', 'members']); // Assert data is passed
    }

    public function test_borrow_creates_a_loan_and_decrements_book_copies()
    {
        // Arrange: Seed data
        $book = Book::factory()->create(['copies' => 5]);
        $member = Member::factory()->create();

        // Act: Call the borrow method
        $response = $this->postJson(route('loans.borrow'), [
            'book_id' => $book->id,
            'member_id' => $member->id,
        ]);

        // Assert: Check the response
        $response->assertStatus(201);
        $response->assertJson([
            'status' => 'success',
            'message' => 'Book borrowed successfully',
        ]);

        // Assert: Verify the loan was created
        $this->assertDatabaseHas('loans', [
            'book_id' => $book->id,
            'member_id' => $member->id,
        ]);

        // Assert: Verify the book's copies were decremented
        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'copies' => 4, // Initial copies - 1
        ]);
    }

    public function test_borrow_returns_error_when_no_copies_available()
    {
        // Arrange: Seed data
        $book = Book::factory()->create(['copies' => 0]);
        $member = Member::factory()->create();

        // Act: Call the borrow method
        $response = $this->postJson(route('loans.borrow'), [
            'book_id' => $book->id,
            'member_id' => $member->id,
        ]);

        // Assert: Check the response
        $response->assertStatus(400);
        $response->assertJson([
            'status' => 'error',
            'message' => 'No copies available',
        ]);
    }

    public function test_returnBook_updates_returned_at_and_increments_book_copies()
    {
        // Arrange: Seed data
        $book = Book::factory()->create(['copies' => 5]);
        $member = Member::factory()->create();
        $loan = Loan::factory()->create([
            'book_id' => $book->id,
            'member_id' => $member->id,
            'borrowed_at' => now(),
            'returned_at' => null,
        ]);

        // Act: Call the returnBook method
        $response = $this->patchJson(route('loans.return', $loan->id)); // Adjust the route name if necessary

        // Assert: Check the response
        $response->assertStatus(200);

        // Assert: Verify the loan's returned_at was updated
        $this->assertNotNull($loan->fresh()->returned_at);

        // Assert: Verify the book's copies were incremented
        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'copies' => 6, // Initial copies + 1
        ]);
    }
}
