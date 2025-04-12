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
        Schema::table('organization_employees', function (Blueprint $table) {
            $table->foreignId('position_id')->nullable()->references('id')->on('positions')->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('permission_id')->nullable()->references('id')->on('permissions')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('organization_employees', function (Blueprint $table) {
            $table->dropColumn(['position_id', 'permission_id']);
        });
    }
};
