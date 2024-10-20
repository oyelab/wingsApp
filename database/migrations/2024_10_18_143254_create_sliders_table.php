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
        // Schema::create('sliders', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('title')->unique(); // Optional title for the slider
        //     $table->integer('order');// Display order
        //     $table->boolean('status')->default(1); // Status (1 = active, 0 = inactive)
		// 	$table->string('image'); // Store image filename
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('sliders');
    }
};
