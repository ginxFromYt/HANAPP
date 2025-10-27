<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Http\Controllers\Controller;

class AdminAuthController extends Controller
{
    public function __construct()
    {
        // Protect all admin routes except login/register
        $this->middleware('auth:admin')
            ->except(['showLoginForm', 'login', 'showRegisterForm', 'register']);
    }

    // Show admin login form
    public function showLoginForm()
    {
        // View file: resources/views/admin/auth/login.blade.php
        return view('admin.auth.login');
    }

  public function login(Request $request)
{

    //dd($request->all());
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
        // If login successful, redirect to dashboard
        return redirect()->route('admin.dashboard')->with('success', 'Welcome back!');
    }

    return back()->withErrors([
        'email' => 'Invalid credentials provided.',
    ])->withInput($request->only('email'));
}


    // Logout admin
  public function logout(Request $request)
{
    Auth::guard('admin')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('home'); // Redirect to home page
}


    // Show registration form
    public function showRegisterForm()
    {
        // View file: resources/views/admin/auth/register.blade.php
        return view('admin.auth.register');
    }

    // Handle registration request
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::guard('admin')->login($admin);



        // Redirect to route name "admin.dashboard"
        return redirect()->route('admin.dashboard')->with('success', 'Welcome to the admin dashboard!');
    }
}
