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
        Schema::create('complaint_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->nullable()->references('id')->on('organizations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('organization_employee_id')->nullable()->references('id')->on('organization_employees')->onDelete('set null')->onUpdate('cascade');
            $table->timestamps();
        });
        Schema::create('complaint_type_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('locale')->nullable();
            $table->foreignId('complaint_type_id')->references('id')->on('complaint_types')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_types');
        Schema::dropIfExists('complaint_type_translations');
    }
};
