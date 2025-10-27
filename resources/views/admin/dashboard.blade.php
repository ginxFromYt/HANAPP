@extends('layouts.Admin.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container py-5 position-relative">

    {{-- ==== Admin Welcome Banner ==== --}}
    <div class="dashboard-banner text-white p-5 rounded-4 shadow-lg mb-5 text-center position-relative">
        @if(auth('admin')->check())
            <h1 class="display-5 fw-bolder mb-2">
                Welcome back, <span class="text-white">{{ auth('admin')->user()->name }}</span>!
            </h1>
        @else
            <h1 class="display-5 fw-bolder text-white mb-2">Welcome, Admin!</h1>
        @endif
        <p class="lead mt-3 mb-4">Manage your food spots and user feedback effectively.</p>

        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('admin.foodspots.index') }}" class="btn btn-light btn-lg shadow-sm fw-bold text-primary">
                <i class="fas fa-utensils me-2"></i> Manage Food Spots
            </a>

            {{-- ==== USER REVIEWS BUTTON ==== --}}
            <button class="btn btn-primary btn-lg shadow-sm fw-bold text-white rounded-pill d-flex align-items-center gap-2"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#userReviewsCanvas"
                aria-controls="userReviewsCanvas">
                <i class="fas fa-comments"></i>
                User Reviews
            </button>
        </div>
    </div>

  <div class="row g-4 justify-content-center text-center mb-5">

    {{-- === Total Spots (Blue) === --}}
    <div class="col-md-4 col-lg-3 d-flex justify-content-center">
        <div class="card metric-card metric-blue shadow-sm rounded-4 w-100" style="max-width: 300px;">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-map-marker-alt me-2"></i>Total Spots</h5>
                <p class="card-text display-6 fw-bold">{{ $totfs ?? 'N/A' }}</p>
            </div>
        </div>
    </div>

    {{-- === Total Visits (White) === --}}
    <div class="col-md-4 col-lg-3 d-flex justify-content-center">
        <div class="card metric-card metric-white shadow-sm rounded-4 w-100" style="max-width: 300px;">
            <div class="card-body">
                <h5 class="card-title text-primary"><i class="fas fa-eye me-2 text-primary"></i>Total Visits</h5>
                <p class="card-text display-6 fw-bold text-primary">{{ $totalVisits ?? 'N/A' }}</p>
            </div>
        </div>
    </div>

    {{-- === Average Rating (Blue) === --}}
    <div class="col-md-4 col-lg-3 d-flex justify-content-center">
        <div class="card metric-card metric-blue shadow-sm rounded-4 w-100" style="max-width: 300px;">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-star me-2"></i>Average Rating</h5>
                <p class="card-text display-6 fw-bold">{{ number_format($averageRating, 1) ?? 'N/A' }}</p>
            </div>
        </div>
    </div>

</div>


  {{-- ==== METRIC CARDS + CHARTS COMBINED ==== --}}
<div class="row g-4 mb-5 justify-content-center text-center">


    {{-- === Total Visits === --}}
    <div class="col-lg-4 col-md-6">
        <div class="card shadow-sm border-0 rounded-4 h-100">
            <div class="card-body">
                <h5 class="card-title text-primary"><i class="fas fa-eye me-2"></i>Visits Analytic</h5>
                <canvas id="visitsChart" height="120"></canvas>
            </div>
        </div>
    </div>

    {{-- === Average Rating === --}}
    <div class="col-lg-4 col-md-6">
        <div class="card shadow-sm border-0 rounded-4 h-100">
            <div class="card-body">
                <h5 class="card-title text-warning"><i class="fas fa-star me-2"></i>Average Rating Analytic</h5>
                <canvas id="ratingsChart" height="120"></canvas>
            </div>
        </div>
    </div>

</div>

        </div>

    </div>

{{-- ==== OFFCANVAS USER REVIEWS ==== --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="userReviewsCanvas" aria-labelledby="userReviewsLabel">
    <div class="offcanvas-header bg-primary text-white">
        <h5 class="offcanvas-title fw-bold" id="userReviewsLabel">
            <i class="fas fa-user-edit me-2"></i> User Reviews
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body bg-white">
        <div class="row g-4">
            @forelse($reviews as $review)
                <div class="col-12">
                    <div class="card review-card p-3 shadow-sm">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="d-flex flex-column">
                                <h6 class="mb-1 fw-bold text-primary">{{ $review->reviewer_name ?? 'Guest User' }}</h6>
                                <div class="small">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star star-icon {{ $i <= $review->rating ? 'text-primary' : 'text-muted' }}"></i>
                                    @endfor
                                </div>
                            </div>
                            <small class="text-primary" style="font-size: 0.7rem;">{{ $review->created_at->format('M d, Y') }}</small>
                        </div>

                        <p class="text-primary small mb-2">{{ $review->comment }}</p>

                        @if($review->foodspot)
                            <small class="fw-semibold text-primary d-block mb-3">
                                <i class="fas fa-utensils me-1"></i>{{ $review->foodspot->name }}
                            </small>
                        @endif

                        {{-- Admin Reply --}}
                        <div class="pt-2 border-top border-light">
                            @if($review->admin_reply)
                                <div class="admin-reply-box p-2 mb-3">
                                    <strong class="text-primary small d-block mb-1"><i class="fas fa-user-shield me-1"></i>Your Reply:</strong>
                                    <p class="mb-0 text-primary admin-reply-text">{{ $review->admin_reply }}</p>
                                </div>
                            @endif

                            <form action="{{ route('admin.reviews.reply', $review->id) }}" method="POST">
                                @csrf
                                <div class="d-flex flex-column">
                                    <textarea name="admin_reply" class="form-control mb-2 text-primary border-primary bg-white" rows="2"
                                        placeholder="Reply...">{{ old('admin_reply', $review->admin_reply) }}</textarea>
                                    <button type="submit" class="btn btn-primary btn-sm fw-bold text-white">
                                        {{ $review->admin_reply ? 'Update Reply' : 'Reply' }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-primary rounded-3 shadow-sm text-center">
                        <i class="fas fa-info-circle me-2"></i> No user reviews yet.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

{{-- ==== STYLES ==== --}}
<style>
    :root {
        --main-blue: #007bff;
    }

    body { background-color: #ffffff; }

    .dashboard-banner { background-color: var(--main-blue) !important; }

    .metric-card {
        border-radius: 1rem !important;
        transition: all 0.2s;
        height: 100%;
    }

    .metric-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .metric-blue { background-color: var(--main-blue); color: white; }

    .metric-white {
        background-color: #ffffff;
        border: 1px solid var(--main-blue);
        color: var(--main-blue);
    }

    .review-card {
        border-radius: 1rem !important;
        border: 1px solid #e0e0e0;
        background: white;
        color: var(--main-blue);
    }

    .admin-reply-box {
        background-color: #f1f7ff !important;
        border: 1px solid var(--main-blue) !important;
        border-radius: 8px !important;
    }

    .star-icon { font-size: 0.7rem; }

    .btn-primary { background-color: var(--main-blue); border: none; }

    .btn-primary:hover { background-color: #0056b3; }

    .text-primary { color: var(--main-blue) !important; }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // === Visits Chart (Line) ===
    new Chart(document.getElementById('visitsChart'), {
        type: 'line',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Visits',
                data: @json($chartVisits),
                borderColor: '#007bff',
                backgroundColor: 'rgba(0,123,255,0.15)',
                tension: 0.4,
                borderWidth: 2,
                pointBackgroundColor: '#007bff'
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } } }
    });

    // === Reviews Chart (Bar) ===
    new Chart(document.getElementById('reviewsChart'), {
        type: 'bar',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'New Reviews',
                data: @json($newReviewsCount),
                backgroundColor: 'rgba(40,167,69,0.6)',
                borderColor: '#28a745',
                borderWidth: 1
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } } }
    });

    // === Ratings Chart (Line) ===
    new Chart(document.getElementById('ratingsChart'), {
        type: 'line',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Avg Rating',
                data: @json($chartRatings),
                borderColor: '#ffc107',
                backgroundColor: 'rgba(255,193,7,0.25)',
                borderWidth: 2,
                tension: 0.4,
                pointBackgroundColor: '#ffc107'
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } } }
    });
</script>


@endsection
