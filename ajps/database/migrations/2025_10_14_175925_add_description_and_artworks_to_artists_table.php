<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('artists', function (Blueprint $table) {
        $table->text('description')->nullable()->after('email');
        $table->string('profile_photo')->nullable()->after('description');
        $table->string('cover_photo')->nullable()->after('profile_photo');
        $table->json('artworks')->nullable()->after('cover_photo');
    });
}

public function down()
{
    Schema::table('artists', function (Blueprint $table) {
        $table->dropColumn(['description', 'profile_photo', 'cover_photo', 'artworks']);
    });
}

};
