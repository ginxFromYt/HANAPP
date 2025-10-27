<?php

namespace App\Http\Controllers;

use App\Models\FoodSpot;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(FoodSpot $foodspot)
    {
        $foodspot->likes()->firstOrCreate([
            'user_id' => auth()->id(),
        ]);

        return back();
    }

    public function destroy(FoodSpot $foodspot)
    {
        $foodspot->likes()->where('user_id', auth()->id())->delete();

        return back();
    }
}
