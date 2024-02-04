<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->foreignId('user_id')->nullable();
            $table->foreignId('offer_id')->nullable();
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('duration');
            $table->json('visitors');
            $table->decimal('total');
            $table->decimal('remianing')->nullable();
            $table->string('last_number')->nullable();
            $table->decimal('last_total')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('status', ['inprogress', 'completed', 'completed_audit'])->default('inprogress');
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
