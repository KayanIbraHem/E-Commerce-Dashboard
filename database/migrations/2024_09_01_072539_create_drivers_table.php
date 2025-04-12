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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->nullable()->references('id')->on('organizations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('organization_employee_id')->nullable()->references('id')->on('organization_employees')->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('shipping_type_id')->nullable()->references('id')->on('shipping_types')->onDelete('set null')->onUpdate('cascade');
            $table->string('status')->default(0)->comment('0 = pending, 1 = active, 2 = inactive');
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('age')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('date_of_employment')->nullable();
            $table->string('image')->nullable();
            $table->string('front_side_image')->nullable();
            $table->string('back_side_image')->nullable();
            $table->string('license_image')->nullable();
            $table->string('driver_license_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
