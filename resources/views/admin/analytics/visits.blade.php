@extends('layouts.Admin.app')

@section('title', 'Visits Analytics')

@section('content')
<div class="container-fluid py-4">
    
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 text-primary mb-1">
                        <i class="fas fa-chart-line me-2"></i>Visits Analytics
                    </h1>
                    <p class="text-muted mb-0">Detailed analysis of food spot visits</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-5">
        <div class="col-md-4">
            <div class="card bg-primary text-white shadow-sm">
                <div class="card-body text-center">
                    <div class="display-4 fw-bold">{{ number_format($totalVisits) }}</div>
                    <h5 class="card-title mb-0">Total Visits</h5>
                    <small class="opacity-75">All time visits</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white shadow-sm">
                <div class="card-body text-center">
                    <div class="display-4 fw-bold">{{ $foodSpots->count() }}</div>
                    <h5 class="card-title mb-0">Total Food Spots</h5>
                    <small class="opacity-75">Active locations</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-info text-white shadow-sm">
                <div class="card-body text-center">
                    <div class="display-4 fw-bold">{{ $foodSpots->count() > 0 ? number_format($totalVisits / $foodSpots->count(), 1) : '0' }}</div>
                    <h5 class="card-title mb-0">Average Visits</h5>
                    <small class="opacity-75">Per food spot</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row mb-5">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="fas fa-chart-line me-2"></i>Daily Visits Trend
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="visitsLineChart" height="300"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="fas fa-chart-bar me-2"></i>Top 10 Most Visited
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="topSpotsChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="fas fa-table me-2"></i>Food Spots Visits Data
                    </h5>
                    <button class="btn btn-sm btn-outline-primary" onclick="downloadCSV()">
                        <i class="fas fa-download me-1"></i>Export CSV
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="visitsTable">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Food Spot Name</th>
                                    <th>Total Visits</th>
                                    <th>Created Date</th>
                                    <th>Visits per Day</th>
                                    <th>Performance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($foodSpots as $index => $spot)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <strong class="text-primary">{{ $spot->name }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary fs-6">{{ number_format($spot->visits) }}</span>
                                    </td>
                                    <td>{{ $spot->created_at->format('M d, Y') }}</td>
                                    <td>
                                        @php
                                            $daysActive = $spot->created_at->diffInDays(now()) + 1;
                                            $visitsPerDay = $spot->visits / $daysActive;
                                        @endphp
                                        {{ number_format($visitsPerDay, 1) }}
                                    </td>
                                    <td>
                                        @if($spot->visits >= 100)
                                            <span class="badge bg-success">Excellent</span>
                                        @elseif($spot->visits >= 50)
                                            <span class="badge bg-warning">Good</span>
                                        @elseif($spot->visits >= 10)
                                            <span class="badge bg-info">Average</span>
                                        @else
                                            <span class="badge bg-secondary">Needs Attention</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Daily Visits Line Chart
    const visitsCtx = document.getElementById('visitsLineChart').getContext('2d');
    new Chart(visitsCtx, {
        type: 'line',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Daily Visits',
                data: @json($chartData),
                borderColor: '#007bff',
                backgroundColor: 'rgba(0, 123, 255, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 6,
                pointHoverRadius: 8,
                pointBackgroundColor: '#007bff',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0,0,0,0.1)'
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(0,0,0,0.1)'
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
                    borderColor: '#007bff',
                    borderWidth: 1
                }
            }
        }
    });

    // Top Spots Bar Chart
    const topSpotsCtx = document.getElementById('topSpotsChart').getContext('2d');
    new Chart(topSpotsCtx, {
        type: 'bar',
        data: {
            labels: @json($topSpotsLabels),
            datasets: [{
                label: 'Visits',
                data: @json($topSpotsData),
                backgroundColor: [
                    '#007bff', '#28a745', '#ffc107', '#dc3545', '#6f42c1',
                    '#20c997', '#fd7e14', '#e83e8c', '#6610f2', '#17a2b8'
                ],
                borderWidth: 0,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'y',
            scales: {
                x: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0,0,0,0.1)'
                    }
                },
                y: {
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
                    bodyColor: '#fff'
                }
            }
        }
    });

    // Export CSV function
    function downloadCSV() {
        const table = document.getElementById('visitsTable');
        let csv = [];
        const rows = table.querySelectorAll('tr');
        
        for (let i = 0; i < rows.length; i++) {
            const row = [], cols = rows[i].querySelectorAll('td, th');
            for (let j = 0; j < cols.length; j++) {
                row.push(cols[j].innerText);
            }
            csv.push(row.join(','));
        }
        
        const csvFile = new Blob([csv.join('\n')], {type: 'text/csv'});
        const downloadLink = document.createElement('a');
        downloadLink.download = 'visits_analytics.csv';
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
</style>

@endsection