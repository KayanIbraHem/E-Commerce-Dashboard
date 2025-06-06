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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable()->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('product_id')->nullable()->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('product_feature_id')->nullable()->references('id')->on('product_features')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('product_advantage_id')->nullable()->references('id')->on('product_advantages')->onDelete('cascade')->onUpdate('cascade');
            $table->string('quantity')->default(1)->nullable();
            $table->string('discount')->nullable();
            $table->string('price')->nullable();
            $table->string('price_after_discount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
