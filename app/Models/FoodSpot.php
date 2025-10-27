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
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
