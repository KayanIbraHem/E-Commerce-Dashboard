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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->nullable()->references('id')->on('organizations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('organization_employee_id')->nullable()->references('id')->on('organization_employees')->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('category_id')->nullable()->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('is_general')->default(true);
            $table->boolean('is_active')->default(true);
            $table->string('code')->nullable();
            $table->string('discount');
            $table->string('discount_type')->comment('FIXED = 1 , PERCENTAGE = 2');
            $table->string('min_purchase')->nullable();
            $table->string('max_discount')->nullable();
            $table->string('usage_limit')->nullable();
            $table->string('used_count')->default(0);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
