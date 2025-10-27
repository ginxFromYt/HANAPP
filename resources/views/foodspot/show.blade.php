<!DOCTYPE html>
<html>
<head>
    <title>{{ $foodspot->name }} - HANAPP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />

<style>
    /* HANAPP Global Variables (Refined Colors for a Professional Look) */
    :root {
        --hanapp-primary-green: #007bff; /* Bright Blue (Modern Primary) */
        --hanapp-secondary-color: #6c757d; /* Gray for text/borders */
        --hanapp-light-bg: #f4f6f9; /* Light, soft background */
        --hanapp-card-bg: #ffffff; /* Pure White card background */
        --hanapp-dark-text: #212529; /* Darkest Text */
        --hanapp-shadow-light: 0 4px 12px rgba(0,0,0,0.05); /* Soft shadow */
        --hanapp-shadow-strong: 0 8px 20px rgba(0,0,0,0.1);
        --hanapp-star-gold: #ffc107; /* Star Color (Yellow) */
        --hanapp-success-light: #e6f7ff; /* Light background for Trivia/Tag (Blue Tint) */
        /* REMOVED --hanapp-border-color and replacing with --hanapp-primary-green */
    }

    /* ------------------------------------------------------------------
      BASE STYLES & LAYOUT
      ------------------------------------------------------------------ */
    body {
        font-family: 'Poppins', 'Segoe UI', sans-serif; /* Modern font for professional look */
        color: var(--hanapp-dark-text);
        line-height: 1.6;
        background-color: var(--hanapp-light-bg);
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    .spot-header-area {
        background-color: var(--hanapp-card-bg);
        border-radius: 12px;
        box-shadow: var(--hanapp-shadow-strong);
        margin-top: 20px;
        padding: 30px;
        border: 1px solid var(--hanapp-primary-green);
    }

    /* Headings (Simplified and Modern) */
    h2 {
        font-weight: 700;
        margin-bottom: 5px;
        color: var(--hanapp-dark-text);
        font-size: 2rem;
        border-bottom: none;
        padding-bottom: 0;
        margin-top: 0;
    }
    h4 {
        font-weight: 600;
        color: var(--hanapp-dark-text);
        font-size: 1.5rem;
    }

    /* Back Link */
    .back-link {
        color: var(--hanapp-secondary-color) !important;
        text-decoration: none;
        font-weight: 500;
        margin-bottom: 20px;
        display: inline-block;
        transition: color 0.3s;
    }
    .back-link:hover {
        color: var(--hanapp-primary-green) !important;
    }

    /* Spot Tag (Cuisine) - Refined Look */
    .spot-tag {
        background-color: var(--hanapp-primary-green);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-top: 10px;
        margin-bottom: 0;
        display: inline-block;
    }

    .card-base {
        background-color: var(--hanapp-card-bg);
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 30px;
        /* BLUE BORDER */
        border: 1px solid var(--hanapp-primary-green);
        box-shadow: var(--hanapp-shadow-light);
    }

    /* Image Card */
    .spot-image-card {
        padding: 0;
        margin-bottom: 0;
    }
    .spot-image-card img {
        width: 100%;
        height: 250px;
        border-radius: 8px;
        object-fit: cover;
        display: block;
        box-shadow: var(--hanapp-shadow-light);
    }

    /* Map Preview Card (col-md-6) */
    .map-preview-card {
        background-color: var(--hanapp-card-bg);
        border-radius: 12px;
        padding: 25px;
        box-shadow: var(--hanapp-shadow-light);
        height: 100%;
        border: 1px solid var(--hanapp-primary-green);
    }
    .map-preview-container {
        border-radius: 8px;
        overflow: hidden;
    }

    /* Spot Information Card (Sidebar) - Renamed for clarity in layout */
    .floating-info-card {
        background-color: var(--hanapp-card-bg);
        border-radius: 12px;
        padding: 25px;
        box-shadow: var(--hanapp-shadow-strong);
        border: 1px solid var(--hanapp-primary-green);
        margin-bottom: 30px;
    }

    .info-list {
        list-style: none;
        padding: 0;
    }
    .info-list li {
        margin-bottom: 15px;
        font-size: 1rem;
        display: flex;
        align-items: flex-start;
    }
    .info-list li span:first-child {
        color: var(--hanapp-primary-green);
        font-size: 1.3rem;
        margin-right: 12px;
    }
    .rating-summary {
        font-size: 1.1rem;
        margin-top: 15px;
        color: var(--hanapp-primary-green);
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .map-container {
        height: 350px;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid var(--hanapp-primary-green);
        margin-bottom: 20px;
        box-shadow: var(--hanapp-shadow-light);
    }

    /* General Button Styling */
    .btn {
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        border: none;
    }
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    }
    .btn-primary, .btn-submit-review {
        background-color: var(--hanapp-primary-green);
        color: white;
    }
    .btn-directions {
        background-color: var(--hanapp-primary-green);
        color: white;
        display: inline-block;
        padding: 10px 30px;
        border-radius: 8px;
        text-align: center;
        text-decoration: none;
        margin-top: 15px;
        transition: all 0.3s;
    }
    .btn-directions:hover {
        background-color: #0056b3;
    }


    /* Form Fields */
    input[type="text"], textarea {
        width: 100%;
        padding: 12px;
        margin-top: 0;
        margin-bottom: 15px;
        border: 1px solid #ced4da;
        border-radius: 6px;
        box-sizing: border-box;
        font-size: 1rem;
        transition: border-color 0.3s;
    }
    input[type="text"]:focus, textarea:focus {
        border-color: var(--hanapp-primary-green);
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    /* Review Card */
    .review-card {
        background-color: var(--hanapp-card-bg);
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 15px;
        /* BLUE BORDER */
        border: 1px solid var(--hanapp-primary-green);
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    .review-card .reviewer-name {
        font-weight: 700;
        color: var(--hanapp-primary-green);
        font-size: 1.1rem;
        display: inline;
        margin-right: 10px;
    }
    .review-card .admin-reply {
        background-color: #f7f7f7;
        padding: 15px;
        border-left: 4px solid var(--hanapp-secondary-color);
        margin-top: 15px;
        border-radius: 0 6px 6px 0;
        font-size: 0.95rem;
    }

    /* Stars */
    .star {
        color: #ccc;
        font-size: 1.2rem;
    }
    .star.checked, .rating-stars .star.checked {
        color: var(--hanapp-star-gold);
    }
    .hanapp-header {
        background-color: var(--hanapp-primary-green);
        padding: 15px 0;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .hanapp-header .logo {
        font-weight: 700;
        color: white;
        font-size: 1.8rem;
    }
    .hanapp-header .btn {
        background-color: white;
        color: var(--hanapp-primary-green);
        padding: 8px 15px;
    }
    .hanapp-footer {
        background-color: var(--hanapp-dark-text); /* Dark color for professionalism */
        color: white;
        padding: 20px 0;
        text-align: center;
        margin-top: 60px;
        font-size: 0.9rem;
    }
    @media (max-width: 992px) {
        /* Stack columns on smaller screens */
        .spot-detail-content {
            flex-direction: column;
            gap: 0;
        }
        .left-column, .right-column {
            flex: none;
            width: 100%;
        }
        .info-card {
            margin-top: 0;
        }
        .map-container {
            height: 250px;
        }
    }

    /* Description Card Specific Design - Professional Update */
    .description-card-design {
        background-color: var(--hanapp-card-bg);
        padding: 30px;
        border-radius: 15px;
        height: 100%;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        border: 2px solid var(--hanapp-primary-green);
    }

    /* Specific styling for the Description text */
    .description-card-design p {
        font-family: 'Georgia', 'Times New Roman', serif;
        font-size: 1.05rem;
        line-height: 1.8;
        color: #495057;
        margin-top: 15px;
    }

    /* Specific styling for the Heading inside the Description Card */
    .description-card-design h5 {
        color: var(--hanapp-dark-text);
        font-weight: 700 !important;
        border-bottom: 2px solid #f8f9fa;
        padding-bottom: 10px;
    }

    /* ADD THIS NEW CSS BLOCK */
/* ------------------------------------------------------------------
  CIRCULAR RATING DISPLAY STYLES
  ------------------------------------------------------------------ */
.circular-rating-display {
    width: 100%; /* Take up the full width of the col-sm-5 container */
    padding-bottom: 100%; /* Creates a 1:1 aspect ratio container (a perfect square) */
    position: relative;
    border-radius: 50%; /* Make it a circle */
    background-color: var(--hanapp-primary-green); /* Blue background for the circle */
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    overflow: hidden;
    box-shadow: var(--hanapp-shadow-strong);
    border: 4px solid var(--hanapp-star-gold); /* Gold border for "Top Rated" feel */
}

.circular-rating-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 90%;
}

.rating-value-large {
    font-size: 4rem; /* Large number for the rating */
    font-weight: 700;
    line-height: 1;
    margin-bottom: 0;
}

.rating-text-small {
    font-size: 0.9rem;
    font-weight: 500;
    margin-top: 5px;
}

/* New style for the tag inside the circle (optional) */
.circular-rating-content .spot-tag {
    background-color: var(--hanapp-star-gold);
    color: var(--hanapp-dark-text);
    margin-top: 10px;
}

/* Remove image styling from the header area where the circle is used */
.spot-header-area.circular-layout .spot-image-card img {
    display: none;
}
</style>
</head>
<body>

    {{-- <nav class="hanapp-header">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">HANAPP</div>
            <div>
                <a href="#" class="btn btn-sm me-2">Admin Login</a>
                <a href="#" class="btn btn-sm">Register</a>
            </div>
        </div>
    </nav> --}}

    <div class="container my-5">
        <a href="javascript:history.back()" class="back-link">
            ← Back to Spots
        </a>

        <div class="row g-4">

            <div class="col-lg-7">

                <div class="spot-header-area">
                    <div class="row mb-4 align-items-start">

                        <div class="col-sm-5">
    @php $averageRating = $foodspot->reviews->avg('rating'); @endphp

                {{-- CONDITION: If the food spot has NO image, display the circular rating.
                    You can adjust this condition to check if it's 'top rated' or a specific category.
                    For now, it displays the circle if there is NO image URL. --}}
                @if (!$foodspot->image)
                    {{-- START CIRCULAR RATING CARD --}}
                    <div class="circular-rating-display">
                        <div class="circular-rating-content">
                            <p class="rating-text-small text-uppercase mb-0">TOP RATED</p>

                            {{-- LARGE RATING VALUE --}}
                            <h1 class="rating-value-large">{{ number_format($averageRating, 1) }}</h1>

                            {{-- SMALL STAR RATING --}}
                            <div>
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="star" style="font-size: 1.5rem; color: var(--hanapp-star-gold);">★</span>
                                @endfor
                            </div>
                        </div>
                    </div>
                    {{-- END CIRCULAR RATING CARD --}}

                @else
                    {{-- START STANDARD IMAGE CARD (Original Code) --}}
                    <div class="spot-image-card">
                        <img src="{{ asset($foodspot->image) }}"
                            alt="{{ $foodspot->name }}"
                            class="img-fluid">
                    </div>
                    {{-- END STANDARD IMAGE CARD --}}
                @endif
            </div>

                        <div class="col-sm-7">
                            <h2 class="mt-0">{{ $foodspot->name }}</h2>
                            <p class="text-secondary">{{ $foodspot->address }}</p>
                            <span class="spot-tag">{{ $foodspot->category_tag ?? 'Culinary Gem' }}</span>

                            @php $averageRating = $foodspot->reviews->avg('rating'); @endphp
                            <div class="rating-summary mt-3">
                                Average Rating:
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="star {{ $i <= round($averageRating) ? 'checked' : '' }}">★</span>
                                @endfor
                                ({{ number_format($averageRating,1) }})
                            </div>

                            <p class="text-secondary mb-0" style="font-size: 0.95rem;">
                              <span style="font-weight: 600; color: var(--hanapp-dark-text); margin-right: 5px;">
                                Total Visits:
                         </span>
                            <span style="font-weight: 700; color: var(--hanapp-primary-green);">
                                {{ number_format($foodspot->visits) }} </span>
                            </p>
                        </div>
                    </div>
                    </div>

                <div class="row g-3 mt-4">
                    <div class="col-md-6">
                        <div class="map-preview-card h-100">
                            <h5 class="fw-bold mb-3">Location Map</h5>

                            <div id="map-preview" class="map-preview-container" style="height: 200px;">
                                </div>

                            <div class="text-center mt-3">
                                <a href="https://www.google.com/maps/dir/?api=1&destination={{ $foodspot->latitude }},{{ $foodspot->longitude }}"
                                    target="_blank"
                                    class="btn-directions w-100">
                                    🚗 Get Directions
                                </a>
                            </div>
                        </div>
                    </div>

                  <div class="col-md-6">
                    <div class="description-card-design"> <h5 class="fw-bold mb-3">About the Spot</h5>
                     <p class="mb-0 text-secondary">{{ $foodspot->description ?? 'Description here' }}</p>
                </div>
            </div>
                </div>
                <div class="card-base mb-5 mt-5">
                    <h4 class="mb-4">Leave a Review</h4>
                    <form action="{{ route('foodspots.review', $foodspot->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="reviewer_name" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label d-block">Rating</label>
                            <div id="rating-stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="star" data-value="{{ $i }}">★</span>
                                @endfor
                            </div>
                            <input type="hidden" name="rating" id="rating-value" value="0">
                        </div>
                        <div class="mb-3">
                            <textarea name="comment" class="form-control" rows="3" placeholder="Write your review..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-submit-review">Submit Review</button>
                    </form>
                </div>

                <div>
                    <h4 class="mb-4">User Reviews ({{ $foodspot->reviews->count() }})</h4>
                    @foreach ($foodspot->reviews as $review)
                        <div class="review-card">
                            <div class="review-header d-flex align-items-center mb-2">
                                <span class="reviewer-name">{{ $review->reviewer_name ?? 'Guest' }}</span>
                                <div>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="star {{ $i <= $review->rating ? 'checked' : '' }}">★</span>
                                    @endfor
                                </div>
                            </div>
                            <p class="review-comment">{{ $review->comment }}</p>

                            @if($review->admin_reply)
                                <div class="admin-reply">
                                    <strong>Admin Reply:</strong> {{ $review->admin_reply }}
                                </div>
                            @endif

                            @auth('admin')
                                <form action="{{ route('reviews.reply', $review->id) }}" method="POST" class="mt-3">
                                    @csrf
                                    <textarea name="admin_reply" class="form-control mb-2" rows="2" placeholder="Write a reply...">{{ $review->admin_reply }}</textarea>
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">Reply</button>
                                </form>
                            @endauth
                        </div>
                    @endforeach
                </div>

            </div>
            <div class="col-lg-5">
                <h4 class="mb-3">Spot Information</h4>
                <div class="floating-info-card">
                    <ul class="info-list">
                        <li><span>📞</span> <div><strong>Phone:</strong> <span class="d-block">{{ $foodspot->phone_number ?? 'N/A' }}</span></div></li>
                        <li><span>📧</span> <div><strong>Email:</strong> <a href="mailto:{{ $foodspot->email }}" class="text-dark d-block">{{ $foodspot->email ?? 'N/A' }}</a></div></li>
                        <li><span>📍</span> <div><strong>Address:</strong> <span class="d-block">{{ $foodspot->address }}</span></div></li>
                    </ul>

                    <hr>
                    <h5 class="mt-4 mb-3">Operating Hours</h5>
                    <p class="text-secondary mb-0">
                        Mon-Sun:
                        <strong>{{ $foodspot->open_time ? \Carbon\Carbon::parse($foodspot->open_time)->format('g:i A') : 'N/A' }}</strong> -
                        <strong>{{ $foodspot->close_time ? \Carbon\Carbon::parse($foodspot->close_time)->format('g:i A') : 'N/A' }}</strong>
                    </p>

                </div>
            </div>
            </div>
    </div>

    <footer class="hanapp-footer">
        © 2025 HANAPP. All rights reserved.
    </footer>


    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script>
        // Initialize map with food spot coordinates (or fallback)
        var latitude = {{ $foodspot->latitude ?? 10.3157 }};
        var longitude = {{ $foodspot->longitude ?? 123.8854 }};

        // The map is now correctly targeting the new 'map-preview' container.
        var map = L.map('map-preview').setView([latitude, longitude], 15);

        // Map layer (OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Green icon (keeping your original icon style)
        var greenIcon = L.icon({
            iconUrl: 'https://cdn-icons-png.flaticon.com/512/684/684908.png',
            iconSize: [40, 40],
            iconAnchor: [20, 40],
            popupAnchor: [0, -35]
        });

        // Marker with popup
        L.marker([latitude, longitude], { icon: greenIcon })
            .addTo(map)
            .bindPopup("<b>{{ $foodspot->name }}</b><br>{{ $foodspot->address }}")
            .openPopup();
    </script>

    <script>
        // User rating interaction
        const stars = document.querySelectorAll('#rating-stars .star');
        const ratingInput = document.getElementById('rating-value');

        stars.forEach(star => {
            star.addEventListener('click', () => {
                const value = parseInt(star.getAttribute('data-value'));
                ratingInput.value = value;
                stars.forEach(s => {
                    s.classList.toggle('checked', parseInt(s.getAttribute('data-value')) <= value);
                });
            });
        });
    </script>
</body>
</html>
