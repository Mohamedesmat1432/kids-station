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
        Schema::create('switch_branchs', function (Blueprint $table) {
            $table->id();
            $table->string('hostname')->unique();
            $table->string('ip')->unique();
            $table->string('platform')->nullable();
            $table->string('version')->nullable();
            $table->string('floor')->nullable();
            $table->string('location')->nullable();
            $table->string('password')->nullable();
            $table->string('password_enable')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('switch_branchs');
    }
};
