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
        Schema::create('product_advantages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_feature_id')->nullable()->references('id')->on('product_features')->onDelete('cascade')->onUpdate('cascade');
            $table->string('price')->default(0)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('product_advantage_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('locale')->nullable();
            $table->foreignId('product_advantage_id')->nullable()->references('id')->on('product_advantages')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_advantages');
        Schema::dropIfExists('product_advantage_translations');
    }
};
