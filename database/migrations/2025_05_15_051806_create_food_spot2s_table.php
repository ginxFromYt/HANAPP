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
        Schema::create('food_spot2s', function (Blueprint $table) {
            $table->id();
            $table->string('name');              // Food spot name
            $table->string('address');           // Address
            $table->time('open_time');           // Opening time
            $table->time('close_time');          // Closing time
            $table->string('image_path')->nullable(); // Image path (optional)
            $table->integer('total_views')->default(0);  // Total views
            $table->integer('total_likes')->default(0);  // Total likes
            $table->timestamps();                // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_spot2s');
    }
};
