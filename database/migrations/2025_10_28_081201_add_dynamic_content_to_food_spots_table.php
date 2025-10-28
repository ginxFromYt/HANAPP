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
        Schema::table('food_spots', function (Blueprint $table) {
            $table->string('banner_title')->nullable()->after('name');
            $table->json('image_gallery')->nullable()->after('images');
            $table->string('theme_color')->default('#2e94f4ff')->after('image_gallery');
            $table->text('tagline')->nullable()->after('banner_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('food_spots', function (Blueprint $table) {
            $table->dropColumn(['banner_title', 'image_gallery', 'theme_color', 'tagline']);
        });
    }
};
