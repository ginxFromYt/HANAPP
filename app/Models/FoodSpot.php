<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodSpot extends Model
{
    use HasFactory;

 protected $fillable = [
        'name',
        'address',
        'description',
        'open_time',
        'close_time',
        'images',
        'visits', // Changed from 'no_visits' to match the database column

        // Ensure all fields from your controller are here
        'phone_number',
        'email',
        'category_tag',
        'latitude',
        'longitude',
        'trivia_question', // <-- Required for your controller to save this data
        'trivia_answer',   // <-- Required for your controller to save this data

        // Dynamic content fields
        'banner_title',
        'image_gallery',
        'theme_color',
        'tagline',
    ];

    protected $casts = [
        'image_gallery' => 'array',
    ];

    // Get banner title with fallback
    public function getBannerTitleAttribute($value)
    {
        return $value ?: 'Delicious Moments Await!';
    }

    // Get theme color with fallback
    public function getThemeColorAttribute($value)
    {
        return $value ?: '#2e94f4ff';
    }

    // Get image gallery with fallback - override the cast to ensure array
    public function getImageGalleryAttribute($value)
    {
        // If null, return default
        if ($value === null) {
            return ['default-image.png'];
        }
        
        // If it's already an array (from cast), check if empty
        if (is_array($value)) {
            return !empty($value) ? $value : ['default-image.png'];
        }
        
        // If it's a string, try to decode
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (is_array($decoded) && !empty($decoded)) {
                return $decoded;
            }
        }
        
        // Fallback to default
        return ['default-image.png'];
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
