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
        Schema::create('tattoallery', function (Blueprint $table) {
            $table->id();
            $table->string('headertitle')->nullable();
            $table->string('tattooimages')->nullable(); // path or filename
            $table->string('listheader')->nullable();
            $table->string('pricelistimages')->nullable(); // path or filename
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tattogallery');
    }
};
