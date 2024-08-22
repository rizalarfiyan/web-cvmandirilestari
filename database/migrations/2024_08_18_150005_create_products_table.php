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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->string('slug', 64)->unique();
            $table->text('description');
            $table->string('images')->nullable();
            $table->decimal('price', 10)->default(0);
            $table->boolean('in_stock')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->boolean('on_sale')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
