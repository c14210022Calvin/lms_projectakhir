<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::post('/books', [BookController::class, 'store']);
Route::middleware('api')->post('/books', [BookController::class, 'store']);

// Menambahkan rute untuk daftar buku
Route::get('/books', [BookController::class, 'index']);
