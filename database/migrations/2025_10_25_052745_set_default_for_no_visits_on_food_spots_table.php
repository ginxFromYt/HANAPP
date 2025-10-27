<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       // Align default to 0 for visit counter. Prefer existing 'visits' column; fallback to 'no_visits' if present.
       if (Schema::hasColumn('food_spots', 'visits')) {
           DB::statement("ALTER TABLE `food_spots` MODIFY `visits` INT NOT NULL DEFAULT 0");
       } elseif (Schema::hasColumn('food_spots', 'no_visits')) {
           DB::statement("ALTER TABLE `food_spots` MODIFY `no_visits` INT NOT NULL DEFAULT 0");
       }
    }

    public function down(): void
    {
        // Best-effort revert: remove explicit default while keeping NOT NULL.
        if (Schema::hasColumn('food_spots', 'visits')) {
            DB::statement("ALTER TABLE `food_spots` MODIFY `visits` INT NOT NULL");
        } elseif (Schema::hasColumn('food_spots', 'no_visits')) {
            DB::statement("ALTER TABLE `food_spots` MODIFY `no_visits` INT NOT NULL");
        }
    }
};
