<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FoodSpot;

class FoodSpotSeeder extends Seeder
{
    public function run()
    {
        $spots = [
            [
                'name' => 'Troy Bistro and Cafe',
                'address' => 'Sample Address 1',
                'description' => 'A cozy place with delicious bistro food.',
                'images' => ['troy1.png', 'troy2.png', 'troy3.png'],
            ],
            [
                'name' => 'Veranda Alfresco and Grill',
                'address' => 'Sample Address 2',
                'description' => 'Dine under the stars with grilled favorites.',
                'images' => ['veranda1.png', 'veranda2.png', 'veranda3.png'],
            ],
            [
                'name' => 'Diosa Tea and Burger',
                'address' => 'Sample Address 3',
                'description' => 'Refreshing tea and tasty burgers in one spot.',
                'images' => ['diosa1.png', 'diosa2.png', 'diosa3.png'],
            ],
            [
                'name' => 'Seguro Snack House and Restaurant',
                'address' => 'Sample Address 4',
                'description' => 'Comfort food that feels like home.',
                'images' => ['seguro1.png', 'seguro2.png', 'seguro3.png'],
            ],
            [
                'name' => 'Solomon Hotels and Resort',
                'address' => 'Sample Address 5',
                'description' => 'Luxury dining in a hotel and resort setting.',
                'images' => ['solomon1.png', 'solomon2.png', 'solomon3.png'],
            ],
            [
                'name' => 'Twinsbowl Panciteria',
                'address' => 'Sample Address 6',
                'description' => 'Classic pancit dishes with a twist.',
                'images' => ['twinsbowl1.png', 'twinsbowl2.png', 'twinsbowl3.png'],
            ],
        ];

        // ✅ Only ONE foreach loop
        foreach ($spots as $spotData) {
            FoodSpot::create([
                'name' => $spotData['name'],
                'address' => $spotData['address'],
                'description' => $spotData['description'],
                // save first image only (since FoodSpot table has single "image" column)
                'image' => $spotData['images'][0],
            ]);
        }
    }
}
