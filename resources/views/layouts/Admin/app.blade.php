<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Capstone') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])


        <!-- bootstrap v5.3.2 -->
        <link rel="stylesheet" href="{{asset('build/bootstrap/bootstrap.v5.3.2.min.css')}}">


    </head>
   <body class="font-sans antialiased bg-light">
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="bg-dark text-white vh-100 p-3 position-fixed" style="width: 250px;">
            <h4 class="fw-bold text-center mb-4">FOODSPOT</h4>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link text-white d-flex align-items-center">
                        <i class="fas fa-home me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('admin.foodspots.index') }}" class="nav-link text-white d-flex align-items-center">
                        <i class="fas fa-utensils me-2"></i> Food Spots
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="nav-link text-white d-flex align-items-center bg-transparent border-0 w-100 text-start">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Main content area -->
        <div class="flex-grow-1" style="margin-left: 250px;">
            <!-- Topbar -->
            <nav class="navbar navbar-light bg-white shadow-sm px-4 py-3 d-flex justify-content-between align-items-center">
                <form class="d-flex align-items-center w-50">
                    <input class="form-control rounded-pill me-2" type="search" placeholder="Search..." aria-label="Search">
                    <button class="btn btn-outline-secondary rounded-pill" type="submit"><i class="fas fa-search"></i></button>
                </form>

                <div class="d-flex align-items-center">
                    <i class="fas fa-bell me-3 text-secondary"></i>
                    <div class="dropdown">
                        <a class="d-flex align-items-center text-decoration-none" href="#" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://via.placeholder.com/40" alt="Admin" class="rounded-circle me-2">
                            <span class="fw-bold text-dark">{{ auth('admin')->user()->name ?? 'Admin' }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item text-danger" href="{{ route('admin.logout') }}">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
