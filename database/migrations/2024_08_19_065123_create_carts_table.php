<?php

use App\Constant;
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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('total_price', 10)->default(0);
            $table->enum('payment_method', [
                Constant::CART_PAYMENT_METHOD_CASH,
                Constant::CART_PAYMENT_METHOD_TRANSFER,
            ]);
            $table->enum('payment_state', [
                Constant::CART_PAYMENT_STATUS_PENDING,
                Constant::CART_PAYMENT_STATUS_SUCCESS,
                Constant::CART_PAYMENT_STATUS_FAILED,
            ])->default(Constant::CART_PAYMENT_STATUS_PENDING);
            $table->enum('state', [
                Constant::CART_STATUS_NEW,
                Constant::CART_STATUS_PROCESSING,
                Constant::CART_STATUS_COMPLETED,
                Constant::CART_STATUS_CANCELED,
            ])->default(Constant::CART_STATUS_NEW);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
