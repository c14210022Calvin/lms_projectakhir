<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booksdetail', function (Blueprint $table) {
            $table->id("bookDetail_id"); // Auto-incrementing primary key
            $table->unsignedBigInteger('book_id'); // Foreign key column
            $table->string('genre'); // Genre of the book
            $table->text('description'); // Long context or synopsis
            $table->integer('copies'); // Number of copies
            $table->timestamps(); // created_at and updated_at columns

            // Foreign key constraint
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booksdetail');
    }
};
