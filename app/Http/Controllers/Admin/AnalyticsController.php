<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FoodSpot;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function visitsAnalytics()
    {
        // Get all food spots with their visits
        $foodSpots = FoodSpot::select('id', 'name', 'visits', 'created_at')
            ->orderBy('visits', 'desc')
            ->get();

        // Calculate total visits
        $totalVisits = $foodSpots->sum('visits');

        // Get visits data for chart (last 30 days)
        $visitsData = FoodSpot::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(visits) as total_visits')
        )
        ->where('created_at', '>=', now()->subDays(30))
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderBy('date')
        ->get();

        // Prepare chart data
        $chartLabels = $visitsData->pluck('date')->map(function($date) {
            return \Carbon\Carbon::parse($date)->format('M d');
        });
        $chartData = $visitsData->pluck('total_visits');

        // Get top 10 most visited spots for chart
        $topSpots = $foodSpots->take(10);
        $topSpotsLabels = $topSpots->pluck('name');
        $topSpotsData = $topSpots->pluck('visits');

        return view('admin.analytics.visits', compact(
            'foodSpots', 
            'totalVisits', 
            'chartLabels', 
            'chartData',
            'topSpotsLabels',
            'topSpotsData'
        ));
    }

    public function ratingsAnalytics()
    {
        // Get all food spots with their average ratings
        $foodSpotsWithRatings = FoodSpot::select('food_spots.id', 'food_spots.name')
            ->leftJoin('reviews', 'food_spots.id', '=', 'reviews.food_spot_id')
            ->selectRaw('
                food_spots.id,
                food_spots.name,
                COALESCE(AVG(reviews.rating), 0) as average_rating,
                COUNT(reviews.id) as total_reviews
            ')
            ->groupBy('food_spots.id', 'food_spots.name')
            ->orderBy('average_rating', 'desc')
            ->get();

        // Calculate overall average rating
        $overallRating = Review::avg('rating') ?? 0;

        // Get ratings distribution
        $ratingsDistribution = Review::select('rating', DB::raw('COUNT(*) as count'))
            ->groupBy('rating')
            ->orderBy('rating')
            ->get();

        // Get recent reviews for timeline
        $recentReviews = Review::with('foodspot')
            ->select('reviews.*')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Prepare chart data
        $distributionLabels = $ratingsDistribution->pluck('rating')->map(function($rating) {
            return $rating . ' Star' . ($rating > 1 ? 's' : '');
        });
        $distributionData = $ratingsDistribution->pluck('count');

        // Top rated spots chart data
        $topRatedSpots = $foodSpotsWithRatings->take(10);
        $topRatedLabels = $topRatedSpots->pluck('name');
        $topRatedData = $topRatedSpots->pluck('average_rating');

        return view('admin.analytics.ratings', compact(
            'foodSpotsWithRatings',
            'overallRating',
            'recentReviews',
            'distributionLabels',
            'distributionData',
            'topRatedLabels',
            'topRatedData'
        ));
    }
}
