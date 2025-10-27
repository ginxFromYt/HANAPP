@extends('layouts.app')

@section('title', 'Image Policy')

@section('content')

<style>
/* 🌿 HANAPP Privacy Page Styling - Reused for Image Policy */
.policy-wrapper {
    font-family: 'Poppins', sans-serif;
    padding: 60px 20px;
    display: flex;
    justify-content: center;
}

.policy-card {
    background-color: white;
    max-width: 800px;
    width: 100%;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #e8f5e9;
}

.policy-card h1 {
    color: var(--hanapp-primary-blue, #2e94f4ff); 
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 1rem;
    text-align: center;
}

.policy-card p {
    font-size: 1rem;
    color: #444;
    margin-bottom: 1rem;
    line-height: 1.6;
}

/* Optional: Adding a bit of style for emphasis on the main note */
.policy-note {
    background-color: #e6f7ff; /* Light blue background for attention */
    border-left: 5px solid var(--hanapp-primary-blue, #2e94f4ff);
    padding: 15px;
    border-radius: 8px;
    margin-top: 20px;
    font-style: italic;
}
</style>

<div class="policy-wrapper">
    <div class="policy-card">
        <h1>Image and Content Policy</h1>
        <p>[HANAPP FOODSPOT], we strive for accuracy and proper attribution of all visual content. This policy clarifies the use of images on our platform.</p>
        
        <div class="policy-note">
            <p>
                Disclaimer on Third-Party Images: Some photos displayed on this foodspot are used for example purposes and are copyrighted by their original creators.
            </p>
            <p>
                If you are the rightful owner of an image and wish for it to be immediately removed or correctly credited, please contact us directly at [123@gmail.com] with the image details and the specific URL where it appears. We will take prompt action.
            </p>
        </div>

        <p style="margin-top: 20px;">We appreciate your understanding and cooperation as we work to ensure all content is used responsibly and with proper acknowledgment.</p>
    </div>
</div>

@endsection