<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;


Route::redirect('/', '/books')->name('dashboard');


Route::middleware(['auth', 'verified'])->group(function () {

    Route::resource('note', NoteController::class);

    //books
    Route::get('/books', [BookController::class, 'listBooks']);
    Route::get('/books', [BookController::class, 'listBooks'])->name('books.index');
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');
});

// Middleware untuk user dengan role "admin"
Route::middleware(['auth', 'verified', RoleMiddleware::class . ':admin'])->group(function () {
    // Route khusus untuk Admin
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');

    // Route Edit dan Update Buku
    
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy'); // Tambahkan route ini

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});

// Middleware untuk user biasa dengan role "user"
Route::middleware(['auth', RoleMiddleware::class . ':user'])->group(function () {
    // Profile routes khusus untuk User
    Route::get('/books/loan', [LoanController::class, 'index'])->name('loan.index');
    Route::post('/books/loan', [LoanController::class, 'borrow'])->name('loan.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
