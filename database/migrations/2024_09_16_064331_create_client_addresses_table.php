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
        Schema::create('client_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->nullable()->references('id')->on('organizations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('organization_employee_id')->nullable()->references('id')->on('organization_employees')->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('client_id')->nullable()->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
            $table->string('building_type')->nullable()->comment('APARTMENT = 1 , VILLA = 2 , OFFICE = 3');
            $table->string('building_name')->nullable();
            $table->string('apartment_number')->nullable();
            $table->string('floor')->nullable();
            $table->string('street')->nullable();
            $table->string('address')->nullable();
            $table->string('code')->nullable();
            $table->string('phone')->nullable();
            $table->string('landmark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_addresses');
    }
};
