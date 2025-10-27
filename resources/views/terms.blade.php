@extends('layouts.app')
@section('title', 'Terms of Service')

@section('content')

<style>
/* 🌊 HANAPP Terms of Service Styling - Blue Theme */
.terms-wrapper {
    font-family: 'Poppins', sans-serif;
    padding: 60px 20px;
    display: flex;
    justify-content: center;
}

.terms-card {
    background-color: #fff;
    max-width: 800px;
    width: 100%;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    /* Changed border from light green to light blue */
    border: 1px solid var(--hanapp-light-blue, #9fd3f3ff);
}

.terms-card h1 {
    /* Changed to primary blue */
    color: var(--hanapp-primary-blue, #2e94f4ff);
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 1.2rem;
    text-align: center;
}

.terms-card p {
    font-size: 1rem;
    color: #444;
    line-height: 1.6;
    margin-bottom: 1.5rem;
    text-align: center;
}

.terms-list {
    list-style: none;
    padding: 0;
}

.terms-list li {
    /* Changed background from light green to a very light blue/white */
    background-color: #f7fcff; 
    /* Changed border color to primary blue */
    border-left: 4px solid var(--hanapp-primary-blue, #2e94f4ff);
    padding: 14px 15px;
    border-radius: 8px;
    margin-bottom: 12px;
    color: #333;
    font-size: 1rem;
    transition: all 0.25s ease;
}

.terms-list li:hover {
    /* Changed hover background color to a slightly darker light blue */
    background-color: #e6f7ff;
    transform: translateX(5px);
}
</style>
<div class="terms-wrapper">
    <div class="terms-card">
        <h1>Terms of Service</h1>
        <p>Welcome to Alright Reserve. By using our platform, you agree to the following terms and conditions:</p>

        <ul class="terms-list">
            <li>Users must provide accurate and truthful information when making reservations.</li>
            <li>Alright Reserve connects customers with local food spots and is not liable for the quality or service of these businesses.</li>
            <li>Users agree to use the platform responsibly and not engage in any fraudulent activities.</li>
            <li>All personal data collected is handled according to our Privacy Policy.</li>
            <li>We reserve the right to update these terms at any time; continued use constitutes acceptance.</li>
        </ul>
    </div>
</div>

@endsection
