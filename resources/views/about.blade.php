@extends('layouts.app')
@section('title', 'About Us')

@section('content')

<style>
/* 🌊 HANAPP About Page Styling - Blue Theme */
.about-wrapper {
    font-family: 'Poppins', sans-serif;
    display: flex;
    justify-content: center;
}

.about-card {
    background-color: white;
    max-width: 800px;
    width: 100%;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    /* Changed from light green to light blue for border */
    border: 1px solid var(--hanapp-light-blue, #9fd3f3ff);
}

.about-card h1 {
    /* Changed to primary blue */
    color: var(--hanapp-primary-blue, #2e94f4ff);
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 1rem;
    text-align: center;
}

.about-card p {
    font-size: 1rem;
    color: #444;
    margin-bottom: 1rem;
    line-height: 1.6;
    text-align: center;
}

.about-card ul {
    margin-top: 1rem;
    padding-left: 1.2rem;
}

.about-card ul li {
    /* Changed from light green background to a very light blue/white */
    background-color: #f7fcff; 
    /* Changed border color to primary blue */
    border-left: 4px solid var(--hanapp-primary-blue, #2e94f4ff);
    padding: 10px 15px;
    border-radius: 8px;
    margin-bottom: 10px;
    color: #333;
    transition: all 0.25s ease;
}

.about-card ul li:hover {
    /* Changed hover background color to a slightly darker light blue */
    background-color: #e6f7ff;
    transform: translateX(5px);
}
</style>

<div class="about-wrapper">
    <div class="about-card">
        <h1>About Us</h1>
        <p>Alright Reserve connects you to the best local food spots in your community.</p>
        <ul>
            <li>We support local businesses by helping them reach more food lovers.</li>
            <li>Discover hidden culinary gems and unique flavors you won’t find anywhere else.</li>
            <li>Enjoy a seamless reservation experience with our platform.</li>
            <li>We are committed to sustainability and local sourcing.</li>
        </ul>
    </div>
</div>

@endsection
