@extends('layouts.Admin.app')

@section('title', 'Ratings Analytics')

@section('content')
<div class="container-fluid py-4">
    
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 text-primary mb-1">
                        <i class="fas fa-star me-2"></i>Ratings Analytics
                    </h1>
                    <p class="text-muted mb-0">Detailed analysis of food spot ratings and reviews</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-5">
        <div class="col-md-3">
            <div class="card bg-warning text-white shadow-sm">
                <div class="card-body text-center">
                    <div class="display-4 fw-bold">{{ number_format($overallRating, 1) }}</div>
                    <h5 class="card-title mb-0">Overall Rating</h5>
                    <small class="opacity-75">Average across all spots</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white shadow-sm">
                <div class="card-body text-center">
                    <div class="display-4 fw-bold">{{ $foodSpotsWithRatings->count() }}</div>
                    <h5 class="card-title mb-0">Rated Spots</h5>
                    <small class="opacity-75">Food spots with reviews</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white shadow-sm">
                <div class="card-body text-center">
                    <div class="display-4 fw-bold">{{ $foodSpotsWithRatings->sum('total_reviews') }}</div>
                    <h5 class="card-title mb-0">Total Reviews</h5>
                    <small class="opacity-75">All time reviews</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-primary text-white shadow-sm">
                <div class="card-body text-center">
                    <div class="display-4 fw-bold">{{ $foodSpotsWithRatings->where('average_rating', '>=', 4)->count() }}</div>
                    <h5 class="card-title mb-0">4+ Star Spots</h5>
                    <small class="opacity-75">Highly rated locations</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row mb-5">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="fas fa-chart-pie me-2"></i>Ratings Distribution
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="ratingsDistributionChart" height="300"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="fas fa-chart-bar me-2"></i>Top Rated Food Spots
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="topRatedChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Sections -->
    <div class="row">
        <!-- Ratings Table -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="fas fa-table me-2"></i>Food Spots Ratings Data
                    </h5>
                    <button class="btn btn-sm btn-outline-primary" onclick="downloadRatingsCSV()">
                        <i class="fas fa-download me-1"></i>Export CSV
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="ratingsTable">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Food Spot Name</th>
                                    <th>Average Rating</th>
                                    <th>Total Reviews</th>
                                    <th>Rating Grade</th>
                                    <th>Stars</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($foodSpotsWithRatings as $index => $spot)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <strong class="text-primary">{{ $spot->name }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-warning text-dark fs-6">{{ number_format($spot->average_rating, 1) }}</span>
                                    </td>
                                    <td>{{ $spot->total_reviews }}</td>
                                    <td>
                                        @if($spot->average_rating >= 4.5)
                                            <span class="badge bg-success">Excellent</span>
                                        @elseif($spot->average_rating >= 4.0)
                                            <span class="badge bg-primary">Very Good</span>
                                        @elseif($spot->average_rating >= 3.5)
                                            <span class="badge bg-info">Good</span>
                                        @elseif($spot->average_rating >= 3.0)
                                            <span class="badge bg-warning">Average</span>
                                        @elseif($spot->average_rating > 0)
                                            <span class="badge bg-danger">Poor</span>
                                        @else
                                            <span class="badge bg-secondary">No Reviews</span>
                                        @endif
                                    </td>
                                    <td>
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= floor($spot->average_rating))
                                                <i class="fas fa-star text-warning"></i>
                                            @elseif($i - 0.5 <= $spot->average_rating)
                                                <i class="fas fa-star-half-alt text-warning"></i>
                                            @else
                                                <i class="far fa-star text-muted"></i>
                                            @endif
                                        @endfor
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Reviews -->
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="fas fa-clock me-2"></i>Recent Reviews
                    </h5>
                </div>
                <div class="card-body" style="max-height: 500px; overflow-y: auto;">
                    @forelse($recentReviews as $review)
                    <div class="border-bottom pb-3 mb-3">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h6 class="mb-1 text-primary">{{ $review->reviewer_name ?? 'Anonymous' }}</h6>
                                <div class="mb-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}" style="font-size: 0.8rem;"></i>
                                    @endfor
                                </div>
                            </div>
                            <small class="text-muted">{{ $review->created_at->format('M d') }}</small>
                        </div>
                        <p class="mb-1 small">{{ Str::limit($review->comment, 100) }}</p>
                        @if($review->foodspot)
                            <small class="text-muted">
                                <i class="fas fa-map-marker-alt me-1"></i>{{ $review->foodspot->name }}
                            </small>
                        @endif
                    </div>
                    @empty
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-comments fa-2x mb-2"></i>
                        <p>No reviews yet</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Ratings Distribution Pie Chart
    const distributionCtx = document.getElementById('ratingsDistributionChart').getContext('2d');
    new Chart(distributionCtx, {
        type: 'doughnut',
        data: {
            labels: @json($distributionLabels),
            datasets: [{
                data: @json($distributionData),
                backgroundColor: [
                    '#dc3545', '#fd7e14', '#ffc107', '#28a745', '#007bff'
                ],
                borderWidth: 0,
                cutout: '60%'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff'
                }
            }
        }
    });

    // Top Rated Spots Bar Chart
    const topRatedCtx = document.getElementById('topRatedChart').getContext('2d');
    new Chart(topRatedCtx, {
        type: 'bar',
        data: {
            labels: @json($topRatedLabels),
            datasets: [{
                label: 'Average Rating',
                data: @json($topRatedData),
                backgroundColor: '#ffc107',
                borderColor: '#e0a800',
                borderWidth: 1,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 5,
                    grid: {
                        color: 'rgba(0,0,0,0.1)'
                    },
                    ticks: {
                        stepSize: 0.5
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    callbacks: {
                        label: function(context) {
                            return 'Rating: ' + context.raw.toFixed(1) + '/5';
                        }
                    }
                }
            }
        }
    });

    // Export CSV function for ratings
    function downloadRatingsCSV() {
        const table = document.getElementById('ratingsTable');
        let csv = [];
        const rows = table.querySelectorAll('tr');
        
        for (let i = 0; i < rows.length; i++) {
            const row = [], cols = rows[i].querySelectorAll('td, th');
            for (let j = 0; j < cols.length - 1; j++) { // Exclude the stars column
                row.push(cols[j].innerText);
            }
            csv.push(row.join(','));
        }
        
        const csvFile = new Blob([csv.join('\n')], {type: 'text/csv'});
        const downloadLink = document.createElement('a');
        downloadLink.download = 'ratings_analytics.csv';
        downloadLink.href = window.URL.createObjectURL(csvFile);
        downloadLink.style.display = 'none';
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
    }
</script>

<style>
    .card {
        border: none;
        border-radius: 12px;
    }
    
    .card-header {
        border-bottom: 1px solid rgba(0,0,0,0.125);
        border-radius: 12px 12px 0 0 !important;
    }
    
    .table th {
        border-top: none;
        font-weight: 600;
        color: #495057;
    }
    
    .badge {
        font-size: 0.875em;
    }
    
    .display-4 {
        font-weight: 700;
    }
    
    .fa-star {
        font-size: 0.9rem;
    }
</style>

@endsection