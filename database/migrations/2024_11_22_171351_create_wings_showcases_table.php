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
        Schema::create('showcases', function (Blueprint $table) {
            $table->id();
			$table->string('title');
			$table->string('banner');
			$table->text('short_description');
			$table->boolean('status')->default(1); // Default active
			$table->unsignedTinyInteger('order'); // Default order 1, range 1-5
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('showcases');
    }
};
