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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
			$table->string('ref'); // Transaction ID
            $table->unsignedBigInteger('user_id')->nullable(); // Customer ID (nullable)
            $table->string('name'); // Customer's name
            $table->string('email'); // Customer's email
            $table->string('phone'); // Customer's phone number
            $table->text('address'); // Customer's address
            $table->tinyInteger('status')->default(0); // Order status (0 = Pending)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
