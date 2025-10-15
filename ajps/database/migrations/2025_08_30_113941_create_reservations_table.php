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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('first_name')->nullable(); // Optional field
            $table->string('last_name')->nullable(); // Optional field
            $table->string('email');
            $table->string('phone');
            $table->date('preferred_date')->nullable(); // Optional field
            $table->date('preferred_time')->nullable(); // Optional field
            $table->string('service');
            $table->text('description/instruction');
            $table->timestamps(); // Adds created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};