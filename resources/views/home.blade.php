@extends('layouts.guest')

@section('title', 'Food Spots')

<style>
    /* Define Blue Color Palette */
    :root {
        --hanapp-light-blue: #9fd3f3ff;
        --hanapp-primary-blue: #2e94f4ff;
        --hanapp-bright-blue: rgba(181, 210, 243, 1);
        --hanapp-dark-blue: #0b68e0;
    }


    body {
        background-color: #ffffff !important;
        margin: 0;
        padding: 0;
    }

    /* Header/Navbar Styling */
    .hanapp-navbar {
        background-color: var(--hanapp-light-blue) !important;
        border-bottom: 2px solid var(--hanapp-primary-blue);
    }

    /* HANAPP Logo Text */
    .hanapp-logo {
        color: var(--hanapp-primary-blue) !important;
        font-size: 1.6rem;
    }

    /* Admin/Register Buttons */
    .btn-admin-login {
        color: var(--hanapp-primary-blue);
        border-color: var(--hanapp-primary-blue);
    }
    .btn-admin-login:hover {
        background-color: var(--hanapp-primary-blue);
        color: white;
    }
    .btn-outline-primary {
        color: var(--hanapp-primary-blue);
        border-color: var(--hanapp-primary-blue);
    }
    .btn-outline-primary:hover {
        background-color: var(--hanapp-primary-blue);
        color: white;
    }
    .btn-outline-danger {
        color: #dc3545;
        border-color: #dc3545;
    }
    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
    }
    .btn-register {
        background-color: var(--hanapp-primary-blue) !important;
        border-color: var(--hanapp-primary-blue) !important;
        color: white;
    }

    /* Hamburger Menu Button (Blue only) */
    .btn-hamburger {
        color: var(--hanapp-primary-blue);
        border-color: var(--hanapp-primary-blue);
    }
    .btn-hamburger:hover {
        background-color: var(--hanapp-primary-blue);
        color: white;
    }

    /* Search Section Styling (Centered and Spaced) */
    .search-form-group {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px 0;
    }
    .search-input {
        max-width: 500px;
        border: 1px solid var(--hanapp-primary-blue);
        border-radius: 5px 0 0 5px;
        height: 45px;
        box-shadow: none;
    }
    .search-btn {
        background-color: var(--hanapp-primary-blue);
        border: 1px solid var(--hanapp-primary-blue);
        color: white;
        height: 45px;
        border-radius: 0 5px 5px 0;
    }
    .search-btn:hover {
        background-color: var(--hanapp-dark-blue);
    }


    /* HANAPP Food Spot Card Design */
    .foodspot-card {
        border: 2px solid var(--hanapp-primary-blue);
        border-radius: 12px;
        background-color: #fff;
        box-shadow: none;
        overflow: hidden;
        text-align: center;
        transition: transform 0.2s ease;
    }

    .foodspot-card:hover {
        transform: translateY(-5px);
    }

    /* Blue Header Banner */
    .foodspot-card .card-header {
        background-color: var(--hanapp-primary-blue);
        color: white;
        font-weight: bold;
        font-size: 1rem;
        padding: 8px;
        border-radius: 10px 10px 0 0;
    }

    /* Image Styling */
    .foodspot-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    /* Card Body */
    .foodspot-card .card-body {
        padding: 15px;
    }

    .foodspot-card .card-title {
        color: var(--hanapp-primary-blue);
        font-weight: 600;
        margin-bottom: 8px;
    }

    .foodspot-card .card-text {
        color: #333;
        font-size: 0.9rem;
        margin-bottom: 12px;
    }

    /* Themed “View More” Button */
    .btn-view-more {
        display: inline-block;
        background-color: var(--hanapp-primary-blue) !important;
        color: white !important;
        font-weight: 500;
        border-radius: 20px;
        padding: 8px 20px;
        text-decoration: none;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-view-more:hover {
        background-color: var(--hanapp-dark-blue) !important;
        color: white !important;
    }

    /* Slider Buttons */
    .slider-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        /* Using rgba based on primary blue to maintain transparency */
        background: rgba(46, 148, 244, 0.7);
        border: none;
        color: white;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 4px;
        font-weight: bold;
    }

    .slider-btn:hover {
        /* Using rgba based on dark blue to maintain transparency */
        background: rgba(11, 104, 224, 0.9);
    }

    .prev-btn {
        left: 10px;
    }

    .next-btn {
        right: 10px;
    }

/* 🌊 Modern HANAPP Hamburger Menu Style */
.btn-hamburger {
    background-color: white !important;
    color: var(--hanapp-primary-blue) !important;
    border: 2px solid var(--hanapp-primary-blue);
    border-radius: 8px;
    font-size: 1.3rem;
    padding: 5px 10px;
    transition: all 0.3s ease;
}
.btn-hamburger:hover {
    background-color: var(--hanapp-primary-blue) !important;
    color: white !important;
    transform: scale(1.05);
}

/* 🧭 Offcanvas Menu Styling */
.offcanvas {
    /* Updated gradient for light blue */
    background: linear-gradient(180deg, rgba(235, 245, 255, 1) 0%, var(--hanapp-bright-blue) 100%);
    border-right: 2px solid var(--hanapp-primary-blue);
    font-family: 'Poppins', sans-serif;
}
.offcanvas-header {
    background-color: var(--hanapp-primary-blue);
    color: white;
    border-bottom: 1px solid var(--hanapp-dark-blue);
}
.offcanvas-title {
    font-weight: 600;
    letter-spacing: 0.5px;
}
.offcanvas-body {
    padding-top: 15px;
}
.offcanvas-body ul li a {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 15px;
    border-radius: 8px;
    color: #333;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.2s ease;
}
.offcanvas-body ul li a:hover {
    background-color: var(--hanapp-primary-blue);
    color: white;
    transform: translateX(4px);
}

.offcanvas-start.show {
    animation: slideIn 0.3s ease-out;
}
@keyframes slideIn {
    from {
        transform: translateX(-100%);
        opacity: 0.5;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}
</style>

@section('content')

<nav class="navbar navbar-expand-lg navbar-light hanapp-navbar shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold hanapp-logo" href="{{ route('home') }}">
            <span class="me-2">HANAPP</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="d-flex justify-content-end align-items-center w-100">
                @auth('admin')
                    <div class="d-inline-flex align-items-center">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-primary me-2">Dashboard</a>
                        <a href="{{ route('admin.logout') }}" class="btn btn-sm btn-outline-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                @else
                    <a href="{{ route('admin.login') }}" class="btn btn-sm btn-outline-dark me-2 btn-admin-login">Admin Login</a>
                @endauth
                <button class="btn btn-sm btn-outline-success ms-2 btn-hamburger" type="button" data-bs-toggle="offcanvas" data-bs-target="#sideMenu" aria-controls="sideMenu">
                    ☰
                </button>
            </div>
        </div>
    </div>
</nav>

<div class="offcanvas offcanvas-start" tabindex="-1" id="sideMenu" aria-labelledby="sideMenuLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title fw-bold" id="sideMenuLabel">Menu</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="list-unstyled">
            <li><a href="{{ route('about') }}" class="d-block py-2">📖 About Us</a></li>
            <li><a href="{{ route('contact') }}" class="d-block py-2">📞 Contact</a></li>
            <li><a href="{{ route('terms') }}" class="d-block py-2">📜 Terms of Service</a></li>
            <li><a href="{{ route('privacy') }}" class="d-block py-2">🔒 Privacy Policy</a></li>
            <li><a href="{{ route('careers') }}" class="d-block py-2">💼 Careers</a></li>
           <li><a href="{{ route('images') }}" class="d-block py-2">🖼️ Image Policy</a></li>

        </ul>
    </div>
</div>

<form action="{{ route('search.index') }}" method="GET">
    <div class="container search-form-group">
        <input type="text" name="q" class="form-control search-input" id="q" value="{{ request('q') }}" placeholder="Find food spots...">
        <input type="submit" value="Search now" class="search-btn">
    </div>

</form>

<div class="container py-4">
    <div class="row">

        @forelse ($spots as $spot)
            <div class="col-md-4 mb-4">
                <div class="card h-100 position-relative foodspot-card">

                    <!-- Dynamic Banner Title -->
                    <div class="card-header" style="background-color: {{ $spot->theme_color }};">
                        {{ $spot->banner_title }}
                    </div>

                    <!-- Dynamic Image Gallery -->
                    <div class="image-slider" style="position: relative; overflow: hidden;">
                        @foreach ($spot->image_gallery as $index => $img)
                            <img
                                src="{{ asset('images/' . $img) }}"
                                alt="{{ $spot->name }} Image {{ $index + 1 }}"
                                class="img-fluid shadow spot-image"
                                style="display: {{ $index === 0 ? 'block' : 'none' }};"
                                data-spot-id="{{ $spot->id }}"
                                data-index="{{ $index }}"
                            >
                        @endforeach

                        @if(is_array($spot->image_gallery) && count($spot->image_gallery) > 1)
                        <button type="button" class="slider-btn prev-btn" data-spot-id="{{ $spot->id }}"
                                style="position: absolute; top: 50%; left: 10px; transform: translateY(-50%); background: rgba(0,0,0,0.5); border: none; color: white; padding: 5px 10px; cursor: pointer; border-radius: 3px;">
                            &lt;
                        </button>
                        <button type="button" class="slider-btn next-btn" data-spot-id="{{ $spot->id }}"
                                style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); background:rgba(0,0,0,0.5); border: none; color: white; padding: 5px 10px; cursor: pointer; border-radius: 3px;">
                            &gt;
                        </button>
                        @endif
                    </div>

                    <!-- Spot Info -->
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $spot->name }}</h5>
                        <p class="card-text">{{ $spot->address }}</p>
                        @if($spot->tagline)
                            <p class="card-text text-muted small">{{ $spot->tagline }}</p>
                        @endif

                        <a href="{{ route('foodspots.show', $spot->id) }}" class="mt-auto btn btn-view-more">View More</a>
                    </div>
                </div>
            </div>
        @empty
            <p>No food spots available.</p>
        @endforelse
    </div>
</div>

<footer class="text-center py-4 mt-5 hanapp-footer"
        style="font-size: 0.9rem; font-family: 'Poppins', sans-serif;">
    Alright Reserve © 2025.
</footer>

@endsection

@push('scripts')
<script>
    // Slider logic
    document.querySelectorAll('.slider-btn').forEach(button => {
        button.addEventListener('click', () => {
            const spotId = button.getAttribute('data-spot-id');
            const isNext = button.classList.contains('next-btn');
            const images = document.querySelectorAll(`.spot-image[data-spot-id="${spotId}"]`);
            if (images.length === 0) return;

            let currentIndex = -1;
            images.forEach((img, idx) => {
                if (img.style.display === 'block') currentIndex = idx;
            });

            let newIndex = isNext
                ? (currentIndex + 1) % images.length
                : (currentIndex - 1 + images.length) % images.length;

            images.forEach(img => img.style.display = 'none');
            images[newIndex].style.display = 'block';
        });
    });
</script>
@endpush
