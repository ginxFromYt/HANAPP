<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FoodSpot;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $q = $request->input('q');
        
        $q = FoodSpot::Where('name','LIKE','%'.$q.'%')->get();

        //return $q;
        if (count($q) >= 1)
        {
            
        return view('search.results')
        ->with('q',$q);
       
        }
        else
        {
        
        $spots = FoodSpot::all();
        return view('home')
        ->with('spots',$spots);

        }
     
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
