<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tattoogallery', function (Blueprint $table) {
            $table->id();
            $table->string('headertitle')->nullable();
            $table->string('tattooimages')->nullable(); // file path or filename
            $table->string('listheader')->nullable();
            $table->string('pricelistimages')->nullable(); // file path or filename
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tattoogallery');
    }
};
