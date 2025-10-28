@extends('layouts.Admin.app')

@section('title', 'Edit Food Spot')

@section('content')
    <h2 class="text-primary">Edit Food Spot</h2>

    @if ($errors->any())
        <div class="alert alert-warning border border-warning">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li class="text-dark">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.foodspots.update', $foodspot->id) }}" method="POST" enctype="multipart/form-data"
          class="border p-4 rounded shadow-sm" style="background-color: #e6f7ff;">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label text-primary">Food Spot Name</label>
            <input type="text" class="form-control border-primary" id="name" name="name" value="{{ old('name', $foodspot->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label text-primary">Address</label>
            <input type="text" class="form-control border-primary" id="address" name="address" value="{{ old('address', $foodspot->address) }}" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="open_time" class="form-label text-primary">Open Time</label>
                <input type="time" class="form-control border-primary" id="open_time" name="open_time" value="{{ old('open_time', $foodspot->open_time) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="close_time" class="form-label text-primary">Close Time</label>
                <input type="time" class="form-control border-primary" id="close_time" name="close_time" value="{{ old('close_time', $foodspot->close_time) }}" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label text-primary">Description</label>
            <textarea class="form-control border-primary" id="description" name="description" rows="4">{{ old('description', $foodspot->description) }}</textarea>
        </div>

        <h5 class="mt-4 mb-3 text-primary">🎨 Display & Branding</h5>

        <div class="row">
            <div class="col-md-8 mb-3">
                <label for="banner_title" class="form-label text-primary">Banner Title</label>
                <input type="text" class="form-control border-primary" id="banner_title" name="banner_title"
                    value="{{ old('banner_title', $foodspot->banner_title ?? '') }}" placeholder="e.g., Fresh from the Farm!">
            </div>
            <div class="col-md-4 mb-3">
                <label for="theme_color" class="form-label text-primary">Theme Color</label>
                <input type="color" class="form-control form-control-color border-primary" id="theme_color" name="theme_color"
                    value="{{ old('theme_color', $foodspot->theme_color ?? '#2e94f4') }}">
            </div>
        </div>

        <div class="mb-3">
            <label for="tagline" class="form-label text-primary">Tagline</label>
            <input type="text" class="form-control border-primary" id="tagline" name="tagline"
                value="{{ old('tagline', $foodspot->tagline ?? '') }}" placeholder="A short descriptive tagline">
        </div>

        <div class="mb-3">
            <label for="image_gallery" class="form-label text-primary">Image Gallery</label>
            <input class="form-control border-primary" type="file" id="image_gallery" name="image_gallery[]" multiple accept="image/*">
            <div class="form-text text-muted">Upload new images to replace the gallery. Leave empty to keep existing images.</div>

            @if($foodspot->image_gallery && is_array($foodspot->image_gallery) && count($foodspot->image_gallery) > 0)
                <div class="mt-2">
                    <strong class="text-primary">Current Gallery:</strong>
                    <div class="row mt-2">
                        @foreach($foodspot->image_gallery as $img)
                            <div class="col-md-3 mb-2">
                                <img src="{{ asset('images/' . $img) }}" alt="Gallery Image"
                                     style="width: 100%; max-height: 100px; object-fit: cover; border: 2px solid #2e94f4ff; border-radius: 5px;">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <h5 class="mt-4 mb-3 text-primary">📍 Location and Contact Details</h5>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="phone_number" class="form-label text-primary">Phone Number</label>
                <input type="text" class="form-control border-primary" id="phone_number" name="phone_number"
                    value="{{ old('phone_number', $foodspot->phone_number ?? '') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label text-primary">Email</label>
                <input type="email" class="form-control border-primary" id="email" name="email"
                    value="{{ old('email', $foodspot->email ?? '') }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="category_tag" class="form-label text-primary">Category Tag (e.g., Italian, Vegan)</label>
                <input type="text" class="form-control border-primary" id="category_tag" name="category_tag"
                    value="{{ old('category_tag', $foodspot->category_tag ?? '') }}">
            </div>
        </div>

        <h5 class="mt-4 mb-3 text-primary">🗺️ Map Coordinates</h5>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="latitude" class="form-label text-primary">Latitude</label>
                <input type="text" class="form-control border-primary" id="latitude" name="latitude"
                    value="{{ old('latitude', $foodspot->latitude ?? '') }}" placeholder="e.g., 10.3157">
            </div>
            <div class="col-md-6 mb-3">
                <label for="longitude" class="form-label text-primary">Longitude</label>
                <input type="text" class="form-control border-primary" id="longitude" name="longitude"
                    value="{{ old('longitude', $foodspot->longitude ?? '') }}" placeholder="e.g., 123.8854">
            </div>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label text-primary">Legacy Single Image (optional)</label>
            <input class="form-control border-primary" type="file" id="image" name="image">
            <div class="form-text text-muted">This will be used as fallback if no gallery images are available.</div>
            @if($foodspot->images)
                <div class="mt-2">
                    <strong class="text-primary">Current Single Image:</strong><br>
                    <img src="{{ asset($foodspot->images) }}" alt="Current Image"
                         style="max-width: 200px; max-height: 150px; object-fit: cover; border: 2px solid #2e94f4ff; border-radius: 5px;">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.foodspots.index') }}" class="btn btn-warning ms-2 text-dark">Cancel</a>
    </form>
</div>

@endsection
