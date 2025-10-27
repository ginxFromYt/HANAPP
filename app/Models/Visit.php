<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    
    // Allow mass assignment for food_spot_id
    protected $fillable = ['food_spot_id']; 

    // Define the relationship back to the FoodSpot
    public function foodSpot()
    {
        return $this->belongsTo(FoodSpot::class);
    }
}

