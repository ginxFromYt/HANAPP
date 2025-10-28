<?php

namespace App\Http\Controllers;

use App\Models\FoodSpot;
use App\Models\Review;
use Illuminate\Http\Request;

class FoodSpotController extends Controller
{
    // Show food spots to public (Home Page)
    public function index()
    {

        // dito mo kunin in query ung no_visit per foodspot

        $spots = FoodSpot::all();
        return view('home', compact('spots'));
    }

    // Search food spots (same home page)
    public function search(Request $request)
    {
        $query = $request->input('q');

        if ($query) {
            $spots = FoodSpot::where('name', 'like', "%{$query}%")
                             ->orWhere('address', 'like', "%{$query}%")
                             ->get();
        } else {
            $spots = FoodSpot::all();
        }

        return view('home', compact('spots'));
    }

    // Admin view of all food spots
    public function adminIndex()
    {
        $spots = FoodSpot::all();
        return view('admin.foodspots.index', compact('spots'));
    }

    // Create new food spot (form)
    public function create()
    {
        return view('admin.foodspots.create');
    }

    // A. UPDATED store() method to handle new fields
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'description' => 'nullable',
            'open_time' => 'required',
            'close_time' => 'required', // Added missing validation for close_time

            // --- NEW FIELDS VALIDATION ---
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'category_tag' => 'nullable|string|max:50',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'trivia_question' => 'nullable|string|max:500',
            'trivia_answer' => 'nullable|string|max:255',

            // --- DYNAMIC CONTENT FIELDS ---
            'banner_title' => 'nullable|string|max:255',
            'theme_color' => 'nullable|string|max:7',
            'tagline' => 'nullable|string|max:255',
            'image_gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120',
            // -----------------------------

            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120',
        ]);

        $data = $request->only([
            'name', 'address', 'description', 'open_time', 'close_time', // Ensure close_time is included
            // --- RETRIEVE ALL NEW FIELDS ---
            'phone_number', 'email', 'category_tag', 'latitude', 'longitude',
            'trivia_question', 'trivia_answer',
            'banner_title', 'theme_color', 'tagline',
            // -------------------------------
        ]);

        // Handle image gallery upload
        $imageGallery = [];
        if ($request->hasFile('image_gallery')) {
            foreach ($request->file('image_gallery') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images'), $filename);
                $imageGallery[] = $filename; // Store just the filename
            }
        }

        // Handle single image upload (fallback)
        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $filename);
            $data['images'] = 'images/' . $filename; // Store with path for legacy compatibility

            // If no gallery images, use single image filename only
            if (empty($imageGallery)) {
                $imageGallery[] = $filename; // Just filename, not full path
            }
        } else {
            $data['images'] = null;
        }

        // Set image gallery (store as JSON, model will cast to array)
        $data['image_gallery'] = !empty($imageGallery) ? $imageGallery : null;

        FoodSpot::create($data);

        return redirect()->route('admin.foodspots.index')->with('success', 'Food spot added.');
    }


    // Show edit form
    public function edit(FoodSpot $foodspot)
    {
        return view('admin.foodspots.edit', compact('foodspot'));
    }

    // B. UPDATED update() method to handle new fields
   public function update(Request $request, FoodSpot $foodspot)
{
    $request->validate([
        'name' => 'required',
        'address' => 'required',
        'description' => 'nullable',
        'open_time' => 'required',
        'close_time' => 'required',
        'phone_number' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:255',
        'category_tag' => 'nullable|string|max:50',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
        'banner_title' => 'nullable|string|max:255',
        'theme_color' => 'nullable|string|max:7',
        'tagline' => 'nullable|string|max:255',
        'image_gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120',
    ]);

    $data = $request->only([
        'name', 'address', 'description', 'open_time', 'close_time',
        'phone_number', 'email', 'category_tag', 'latitude', 'longitude',
        'banner_title', 'theme_color', 'tagline',
    ]);

    // Handle image gallery upload
    if ($request->hasFile('image_gallery')) {
        $imageGallery = [];
        foreach ($request->file('image_gallery') as $file) {
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $imageGallery[] = $filename; // Store just the filename
        }
        $data['image_gallery'] = $imageGallery; // Let Laravel's cast handle it
    }

    // Handle single image upload (fallback)
    if ($request->hasFile('image')) {
        $filename = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $filename);
        $data['images'] = 'images/' . $filename; // Store with path for legacy compatibility
    }

    $foodspot->update($data);

    return redirect()->route('admin.foodspots.index')->with('success', 'Food spot updated.');
}


    // Delete
    public function destroy(FoodSpot $foodspot)
    {
        $foodspot->delete();
        return redirect()->route('admin.foodspots.index')->with('success', 'Food spot deleted.');
    }

    // Show a specific food spot with reviews
    public function show($id)
    {
        $foodspot = FoodSpot::with('reviews')->findOrFail($id);
        $foodspot = FoodSpot::findOrFail($id);

    // 🌟 ADD THIS LINE TO INCREMENT THE COUNTER 🌟
    $foodspot->increment('visits');
        return view('foodspot.show', compact('foodspot'));
    }

    // Handle review submission
    public function review(Request $request, FoodSpot $foodspot)
    {
        $request->validate([
            'reviewer_name' => 'required',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable',
        ]);

        $foodspot->reviews()->create($request->only(['reviewer_name', 'rating', 'comment']));

        return redirect()->back()->with('success', 'Review added!');
    }

    // Restrict admin methods
    public function __construct()
    {
        $this->middleware('auth:admin')->only([
            'adminIndex', 'create', 'store', 'edit', 'update', 'destroy'
        ]);
    }

    // Comment handler
    public function comment(Request $request, FoodSpot $foodspot)
    {
        $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        $foodspot->reviews()->create([
            'reviewer_name' => auth()->user()->name ?? 'Guest',
            'comment' => $request->input('content'),
            'rating' => 5 // default for now
        ]);

        return back()->with('success', 'Comment added!');
    }

    // admin reply comments
    public function replyToReview(Request $request, Review $review)
    {
        $request->validate([
            'admin_reply' => 'required|string|max:1000',
        ]);

        $review->update([
            'admin_reply' => $request->admin_reply,
        ]);

        return back()->with('success', 'Reply posted successfully.');
    }
}
