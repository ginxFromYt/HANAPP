@extends('layouts.Admin.app')

@section('title', 'Manage Food Spots')

@section('content')
<div class="container mt-4">

    <h1>Manage Food Spots</h1>

    <!-- Add New Food Spot Form -->
    <div class="card mb-4">
        <div class="card-header">Add New Food Spot</div>
        <div class="card-body">
            <form action="{{ route('admin.foodspots.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Food Spot Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="open_time" class="form-label">Open Time</label>
                    <input type="time" name="open_time" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="close_time" class="form-label">Close Time</label>
                    <input type="time" name="close_time" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>


                <button type="submit" class="btn btn-primary">Add Food Spot</button>
            </form>
        </div>
    </div>

    <!-- List Food Spots -->
    <h2>Existing Food Spots</h2>
    @if($spots->isEmpty())
        <p>No food spots available.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Open</th>
                    <th>Close</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($spots as $spot)
                <tr>
                    <td>{{ $spot->name }}</td>
                    <td>{{ $spot->address }}</td>
                    <td>{{ $spot->open_time}}</td>
                    <td>{{ \Carbon\Carbon::parse($spot->close_time)->format('h:i A') }}</td>
                    <td>


                        @if($spot->images != NULL)

                        <!-- dito ung number 5.  -->
                        <img src="{{ asset($spot->images) }}" alt="{{ $spot->name }}" width="100">
                        @else
                        No image
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.foodspots.edit', $spot->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('admin.foodspots.destroy', $spot->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this food spot?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>
@endsection
