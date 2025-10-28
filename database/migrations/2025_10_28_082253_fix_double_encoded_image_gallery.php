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
        // Fix double-encoded JSON in image_gallery column
        \DB::table('food_spots')->whereNotNull('image_gallery')->get()->each(function ($spot) {
            $imageGallery = $spot->image_gallery;
            
            // If it's a string, try to decode it
            if (is_string($imageGallery)) {
                $decoded = json_decode($imageGallery, true);
                
                // If the decoded result is still a string, decode again (double-encoded)
                if (is_string($decoded)) {
                    $doubleDecoded = json_decode($decoded, true);
                    if (is_array($doubleDecoded)) {
                        \DB::table('food_spots')
                            ->where('id', $spot->id)
                            ->update(['image_gallery' => json_encode($doubleDecoded)]);
                        echo "Fixed spot ID: {$spot->id}\n";
                    }
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
