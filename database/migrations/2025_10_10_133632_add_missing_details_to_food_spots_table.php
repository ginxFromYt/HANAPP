<?php

// database/migrations/YYYY_MM_DD_HHmmss_add_missing_details_to_food_spots_table.php

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
            
            // --- CONTACT DETAILS ---
            // 'close_time' is removed because it already exists.
            
            // Add new contact fields after 'close_time'
            $table->string('phone_number')->nullable()->after('close_time');
            $table->string('email')->nullable()->after('phone_number');
            $table->string('category_tag')->nullable()->after('email');

            // --- COORDINATES ---
            // Adding coordinates after 'address'
            $table->decimal('latitude', 10, 7)->nullable()->after('address');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('food_spots', function (Blueprint $table) {
            // Drop the columns we attempted to add
            $table->dropColumn([
                'phone_number',
                'email',
                'category_tag',
                'latitude',
                'longitude',
                'trivia_question',
                'trivia_answer',
            ]);
        });
    }
};
