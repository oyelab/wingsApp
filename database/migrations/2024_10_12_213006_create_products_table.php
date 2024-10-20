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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
			$table->string('title');
			$table->string('slug')->unique(); // Slug column
			$table->decimal('price', 10, 2);
			$table->decimal('sale', 5, 2);
			$table->json('categories');
			$table->text('description');
			$table->json('specifications')->nullable(); // Add this line to store specification IDs
			$table->json('images');
			$table->string('meta_title')->nullable();
			$table->json('keywords')->nullable();              // Store tag names as JSON
            $table->text('meta_desc')->nullable();
            $table->string('og_image')->nullable();  // Store the filename of the og:image
			$table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
