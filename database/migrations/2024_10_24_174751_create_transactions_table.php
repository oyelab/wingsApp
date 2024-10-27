<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('transactions', function (Blueprint $table) {
	// 		$table->id(); // This creates an 'unsignedBigInteger' as the primary key for transactions
	// 		$table->string('ref');
	// 		$table->unsignedBigInteger('order_id'); // Ensure order_id is unsignedBigInteger
	// 		$table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade'); // Set foreign key constraint
    //         $table->string('val_id')->nullable(false);
    //         $table->decimal('amount', 10, 2)->nullable(false);
    //         $table->string('card_type')->nullable();
    //         $table->decimal('store_amount', 10, 2)->nullable();
    //         $table->string('card_no')->nullable();
    //         $table->string('bank_tran_id')->nullable();
    //         $table->string('status')->nullable();
    //         $table->timestamp('tran_date')->nullable();
    //         $table->string('error')->nullable();
    //         $table->string('currency')->nullable();
    //         $table->string('card_issuer')->nullable();
    //         $table->string('card_brand')->nullable();
    //         $table->string('card_sub_brand')->nullable();
    //         $table->string('card_issuer_country')->nullable();
    //         $table->string('card_issuer_country_code')->nullable();
    //         $table->string('store_id')->nullable();
    //         $table->string('verify_sign')->nullable();
    //         $table->string('verify_key')->nullable();
    //         $table->string('verify_sign_sha2')->nullable();
    //         $table->string('currency_type')->nullable();
    //         $table->decimal('currency_amount', 10, 2)->nullable();
    //         $table->decimal('currency_rate', 10, 4)->nullable();
    //         $table->decimal('base_fair', 10, 2)->nullable();
    //         $table->string('value_a')->nullable();
    //         $table->string('value_b')->nullable();
    //         $table->string('value_c')->nullable();
    //         $table->string('value_d')->nullable();
    //         $table->string('subscription_id')->nullable();
    //         $table->integer('risk_level')->nullable();
    //         $table->string('risk_title')->nullable();
    //         $table->timestamps(); // for created_at and updated_at
    //     });
    // }

    // /**
    //  * Reverse the migrations.
    //  */
    // public function down(): void
    // {
    //     Schema::dropIfExists('transactions');
    // }
};
