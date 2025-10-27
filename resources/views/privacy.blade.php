@extends('layouts.app')
@section('title', 'Privacy Policy')

@section('content')

<style>
/* 🌿 HANAPP Privacy Page Styling */
.privacy-wrapper {
    font-family: 'Poppins', sans-serif;
    padding: 60px 20px;
    display: flex;
    justify-content: center;
}

.privacy-card {
    background-color: white;
    max-width: 800px;
    width: 100%;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #e8f5e9;
}

.privacy-card h1 {
    color: var(--hanapp-primary-blue, #2e94f4ff); 
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 1rem;
    text-align: center;
}

.privacy-card p {
    font-size: 1rem;
    color: #444;
    margin-bottom: 1rem;
    line-height: 1.6;
}

.privacy-card ul {
    margin-top: 1rem;
    padding-left: 1.2rem;
}

.privacy-card ul li {
    background-color: #f9fff9;
    border-left: 4px solid var(--hanapp-primary-blue, #2e94f4ff);
    padding: 10px 15px;
    border-radius: 8px;
    margin-bottom: 10px;
    color: #333;
    transition: all 0.25s ease;
}

.privacy-card ul li:hover {
     background-color: #e6f7ff;
    transform: translateX(5px);
}
</style>

<div class="privacy-wrapper">
    <div class="privacy-card">
        <h1>Privacy Policy</h1>
        <p>Your privacy is important to us. This Privacy Policy explains how we collect, use, and protect your information:</p>
        <ul>
            <li>We collect personal data only for reservations and platform improvements.</li>
            <li>We never sell or misuse your personal information.</li>
            <li>You can request data deletion at any time by contacting us.</li>
            <li>We use standard security measures to keep your data safe.</li>
        </ul>
    </div>
</div>

@endsection
