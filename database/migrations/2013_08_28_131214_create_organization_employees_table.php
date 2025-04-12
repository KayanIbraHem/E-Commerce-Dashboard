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
        Schema::create('organization_employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->nullable()->references('id')->on('organizations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('organization_employee_id')->nullable()->references('id')->on('organization_employees')->onDelete('set null')->onUpdate('cascade');
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('image')->nullable();
            $table->string('api_token')->nullable();
            $table->string('date_added')->nullable();
            $table->boolean('show_notification')->default(true);
            $table->boolean('send_notifications_to_email')->default(true);
            $table->boolean('notification_sound')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_employees');
    }
};
