<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('artwork_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('artist_id'); // FK
            $table->string('image_path'); // path ng image
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            // 🔹 Foreign Key Constraint
            $table->foreign('artist_id')
                  ->references('id')
                  ->on('artists')
                  ->onDelete('cascade'); // auto-delete artworks when artist deleted
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artwork_images');
    }
};

