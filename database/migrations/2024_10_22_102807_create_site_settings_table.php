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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();          // Site title
            $table->text('description')->nullable();      // Meta description
            $table->text('keywords')->nullable();         // SEO keywords
            $table->string('og_image')->nullable();       // Open Graph Image (for sharing)
            $table->string('logo_v1')->nullable();        // Primary logo
            $table->string('logo_v2')->nullable();        // Secondary logo
            $table->string('favicon')->nullable();        // Favicon
            $table->string('email')->nullable();          // Contact email
            $table->string('phone')->nullable();          // Contact phone
            $table->string('address')->nullable();        // Contact address
            $table->text('social_links')->nullable();     // JSON array for social media links
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
