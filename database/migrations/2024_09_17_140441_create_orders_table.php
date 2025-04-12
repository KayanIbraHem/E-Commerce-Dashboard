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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->nullable()->references('id')->on('organizations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('client_address_id')->nullable()->references('id')->on('client_addresses')->onDelete('cascade')->onUpdate('cascade');
            $table->nullableMorphs('orderable');
            $table->string('order_number')->nullable();
            $table->string('price')->nullable();
            $table->string('discount')->nullable();
            $table->string('price_after_discount')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
