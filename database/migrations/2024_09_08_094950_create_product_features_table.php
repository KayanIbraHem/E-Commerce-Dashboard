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
        Schema::create('product_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable()->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('product_feature_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('locale')->nullable();
            $table->foreignId('product_feature_id')->nullable()->references('id')->on('product_features')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_features');
        Schema::dropIfExists('product_feature_translations');
    }
};
