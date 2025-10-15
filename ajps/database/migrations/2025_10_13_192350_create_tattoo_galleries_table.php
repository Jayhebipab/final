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
    Schema::create('tattoo_galleries', function (Blueprint $table) {
        $table->id();
        $table->string('headertitle');
        $table->json('tattooimages')->nullable();
        $table->string('listheader');
        $table->string('pricelistimages')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tattoo_galleries');
    }
};
