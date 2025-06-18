<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('genre_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('genre_id')-> index()->constrained('genres')->CascadeOnDelete();
            $table->foreignId('book_id')-> index()->constrained('books')->CascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genre_books');
    }
};
