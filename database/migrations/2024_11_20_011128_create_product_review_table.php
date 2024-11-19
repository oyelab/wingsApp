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
        Schema::create('product_review', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('review_id');
			$table->unsignedBigInteger('product_id');
			$table->timestamps();
		
			// Foreign keys
			$table->foreign('review_id')->references('id')->on('reviews')->onDelete('cascade');
			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
		
			// Unique constraint to prevent duplicate entries for the same product and review
			$table->unique(['review_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_review');
    }
};
