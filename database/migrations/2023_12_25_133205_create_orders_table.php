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
            $table->string('number');
            $table->string('casher_name');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('duration');
            $table->foreignId('offer_id')->nullable();
            $table->json('visitors');
            $table->decimal('total');
            $table->decimal('remianing')->nullable();
            $table->string('last_number')->nullable();
            $table->decimal('last_total')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
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
