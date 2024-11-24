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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
			$table->string('type');  // Type of asset: 'banner', 'logo', etc.
			$table->string('title');  // Name of the asset (e.g., 'Payment Gateway Banner')
			$table->string('file');  // Path to the uploaded file
			$table->text('description')->nullable();  // Optional description for the asset
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
