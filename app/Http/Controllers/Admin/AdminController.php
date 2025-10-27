<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\FoodSpot;
use App\Models\Review;
use Carbon\Carbon;
use App\Http\Controllers\Controller;



class AdminController extends Controller
{

public function dashboard()
{

    $sevenDaysAgo = Carbon::now()->subDays(6);
    $days = collect(range(6, 0))
        ->map(fn($i) => now()->subDays($i)->format('Y-m-d'))
        ->toArray();

    $chartLabels = collect($days)->map(fn($d) => Carbon::parse($d)->format('D'))->toArray();

    $totfs = FoodSpot::count();

    $totalVisits = DB::table('food_spots')
                        ->where('updated_at', '>=', $sevenDaysAgo)
                        ->sum('visits');

    $rawAverageRating = DB::table('reviews')
        ->where('created_at', '>=', $sevenDaysAgo) // <-- Filter reviews by date
        ->avg('rating');

    $averageRating = round($rawAverageRating, 1);

    $newReviewsCount = Review::where('created_at', '>=', $sevenDaysAgo)->count();
    $reviews = Review::with('foodspot')->latest()->get();

    $visitsPerDay = DB::table('food_spots')
        ->select(
            DB::raw('DATE(updated_at) as date'),
            DB::raw('SUM(visits) as total_visits_on_day')
        )
        ->where('updated_at', '>=', $sevenDaysAgo)
        ->groupBy('date')
        ->pluck('total_visits_on_day', 'date');

    $chartVisits = collect($days)->map(fn($d) => $visitsPerDay[$d] ?? 0)->toArray();

    $ratings = Review::select(
        DB::raw('DATE(created_at) as date'),
        DB::raw('avg(rating) as avg_rating')
    )
    ->where('created_at', '>=', $sevenDaysAgo)
    ->groupBy('date')
    ->pluck('avg_rating', 'date');

    $chartRatings = collect($days)->map(fn($d) => round($ratings[$d] ?? 0, 1))->toArray();


    return view('admin.dashboard', compact(
        'reviews',
        'totfs',
        'totalVisits',
        'averageRating', // This is now the 7-day average
        'newReviewsCount',
        'chartLabels',
        'chartVisits',
        'chartRatings'
    ));
}


    public function reply(Request $request, $id) {
        $request->validate([
            'admin_reply' => 'required|string|max:500',
        ]);
        $review = Review::findOrFail($id);
        $review->admin_reply = $request->admin_reply;
        $review->save();
        return back()->with('success', 'Reply posted successfully.');
    }

    public function logout(Request $request) {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

}
