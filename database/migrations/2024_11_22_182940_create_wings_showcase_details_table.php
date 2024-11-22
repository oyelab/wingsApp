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
        Schema::create('showcase_details', function (Blueprint $table) {
            $table->id();
			$table->foreignId('showcase_id')->constrained()->onDelete('cascade');
			$table->string('heading');
			$table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wings_showcase_details');
    }
};
