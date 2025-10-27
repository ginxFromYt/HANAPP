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
        Schema::create('food_spots', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('address');
        $table->text('description')->nullable();
        $table->time('open_time');
        $table->time('close_time'); // you need this too
        $table->string('images')->nullable(); // must be nullable
        $table->timestamps();
        $table->integer('visits')->default(0); 
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_spots');
    }
};
