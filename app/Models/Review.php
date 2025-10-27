<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'food_spot_id',
        'reviewer_name',
        'rating',
        'comment',
        'admin_reply',
    ];

    public function foodspot()
    {
        return $this->belongsTo(FoodSpot::class);
    }
}
