<?php

namespace App\Http\Controllers;


class AdminDashboardController extends Controller
{
    public function index() 
    {

        //return "test";
        return view('admin.dashboard');
    }
}
