@extends('layouts.app')
@section('title', 'Food Spots')
@section('content')

<form action="{{ route('search.index') }}" method="GET">
    <div class="form-group m-4 col-6">
        <label for="q">Search here...</label>
        <input type="text" name="q" class="form-control col-6" id="q" value="{{ request('q') }}">
        <input type="submit" value="Search now" class="btn btn-primary">
    </div>
</form>


@endsection

@push('scripts')
<script>
    function showMoreDetails(button) {
        document.querySelectorAll('.more-details').forEach(detail => detail.style.display = 'none');
        document.querySelectorAll('.btn.btn-primary').forEach(btn => btn.style.display = 'inline-block');

        const moreDetails = button.nextElementSibling;
        if (moreDetails && moreDetails.classList.contains('more-details')) {
            moreDetails.style.display = 'block';
            button.style.display = 'none';
        }
    }

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
