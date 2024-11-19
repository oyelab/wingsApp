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
        Schema::create('reviews', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('user_id'); // Reference to the user who writes the review
			$table->unsignedBigInteger('product_id')->nullable(); // Reference to the product if applicable
			$table->text('content'); // The review content
			$table->boolean('status')->default(true); // Status of the review (active or inactive)
			$table->timestamps();
		
			// Foreign keys (optional)
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
