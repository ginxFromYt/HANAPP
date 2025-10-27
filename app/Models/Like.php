<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
   public function foodspot()
{
    return $this->belongsTo(Foodspot::class);
}

}
