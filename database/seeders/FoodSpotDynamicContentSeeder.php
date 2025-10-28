<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FoodSpot;

class FoodSpotDynamicContentSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $dynamicData = [
            1 => [
                'banner_title' => 'Fresh from the Farm!',
                'image_gallery' => json_encode(['jaquesfarm.png', 'jaquesfarm1.png', 'jaquesfarm2.png']),
                'theme_color' => '#28a745',
                'tagline' => 'Organic ingredients, farm-to-table freshness'
            ],
            2 => [
                'banner_title' => 'Discover Hidden Delights!',
                'image_gallery' => json_encode(['hiddenplace.png', 'hiddenplace1.png', 'hiddenplace2.png']),
                'theme_color' => '#6f42c1',
                'tagline' => 'Secret recipes in a cozy atmosphere'
            ],
            3 => [
                'banner_title' => 'Where Reggae Meets Flavor!',
                'image_gallery' => json_encode(['reggaeranch.png', 'reggaeranch1.png', 'reggaeranch2.png']),
                'theme_color' => '#fd7e14',
                'tagline' => 'Caribbean vibes with authentic flavors'
            ],
            4 => [
                'banner_title' => 'Taste with Elegance!',
                'image_gallery' => json_encode(['troy.png', 'troy1.png', 'troy2.png']),
                'theme_color' => '#dc3545',
                'tagline' => 'Fine dining experience with exceptional service'
            ],
            5 => [
                'banner_title' => 'Dine Under the Stars!',
                'image_gallery' => json_encode(['veranda.png', 'veranda1.png', 'veranda2.png']),
                'theme_color' => '#20c997',
                'tagline' => 'Romantic outdoor dining with garden views'
            ],
            6 => [
                'banner_title' => 'Sip & Bite Happiness!',
                'image_gallery' => json_encode(['diosa.png', 'diosa1.png', 'diosa2.png']),
                'theme_color' => '#e83e8c',
                'tagline' => 'Coffee culture meets gourmet bites'
            ],
            7 => [
                'banner_title' => 'Comfort Food Awaits!',
                'image_gallery' => json_encode(['seguro.png', 'seguro1.png', 'seguro2.png']),
                'theme_color' => '#ffc107',
                'tagline' => 'Home-style cooking that warms the heart'
            ],
            8 => [
                'banner_title' => 'Luxury Dining Experience!',
                'image_gallery' => json_encode(['solomon.png', 'solomon1.png', 'solomon2.png']),
                'theme_color' => '#6610f2',
                'tagline' => 'Premium cuisine with impeccable presentation'
            ],
            9 => [
                'banner_title' => 'Bowls of Tradition!',
                'image_gallery' => json_encode(['twinsbowl.png', 'twinsbowl1.png', 'twinsbowl2.png']),
                'theme_color' => '#17a2b8',
                'tagline' => 'Traditional recipes served with modern flair'
            ],
        ];

        foreach ($dynamicData as $id => $data) {
            $foodspot = FoodSpot::find($id);
            if ($foodspot) {
                $foodspot->update($data);
                $this->command->info("Updated FoodSpot ID {$id} with dynamic content");
            }
        }
    }
}
