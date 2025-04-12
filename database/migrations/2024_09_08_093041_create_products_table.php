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
            $table->foreignId('organization_id')->nullable()->references('id')->on('organizations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('organization_employee_id')->nullable()->references('id')->on('organization_employees')->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('category_id')->nullable()->references('id')->on('categories')->onDelete('set null')->onUpdate('cascade');
            $table->string('status')->default(1)->nullable()->comment('0=inactive,1=active');
            $table->string('quantity')->default(0)->nullable();
            $table->string('quantity_purchase')->default(0)->nullable();
            $table->string('discount_type')->default(0)->nullable()->comment('0=no discount,1 = percentage, 2 = fixed');
            $table->string('discount_value')->default(0)->nullable();
            $table->string('price')->default(0)->nullable();
            $table->string('price_after_discount')->default(0)->nullable();
            $table->string('main_image')->nullable();
            $table->string('video')->nullable();
            $table->timestamps();
        });
        Schema::create('product_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('locale')->nullable();
            $table->foreignId('product_id')->nullable()->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_translations');
    }
};
