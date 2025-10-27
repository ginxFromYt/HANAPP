@extends('layouts.app')
@section('title', 'Contact Us')

@section('content')

<style>
/* 🌊 HANAPP Contact Page Styling - Blue Theme */
.contact-wrapper {
    font-family: 'Poppins', sans-serif;
    padding: 60px 20px;
    display: flex;
    justify-content: center;
}

.contact-card {
    background-color: white;
    max-width: 800px;
    width: 100%;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    /* Changed border from light green to light blue */
    border: 1px solid var(--hanapp-light-blue, #9fd3f3ff);
}

.contact-card h1 {
    /* Changed to primary blue */
    color: var(--hanapp-primary-blue, #2e94f4ff);
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 1rem;
    text-align: center;
}

.contact-card p {
    font-size: 1rem;
    color: #444;
    margin-bottom: 1rem;
    line-height: 1.6;
    text-align: center;
}

.contact-info {
    margin-top: 20px;
}

.contact-info li {
    list-style: none;
    /* Changed background from light green to a very light blue/white */
    background-color: #f7fcff; 
    /* Changed border color to primary blue */
    border-left: 4px solid var(--hanapp-primary-blue, #2e94f4ff);
    padding: 12px 15px;
    border-radius: 8px;
    margin-bottom: 12px;
    color: #333;
    font-size: 1rem;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: all 0.25s ease;
}

.contact-info li:hover {
    /* Changed hover background color to a slightly darker light blue */
    background-color: #e6f7ff;
    transform: translateX(5px);
}

.contact-info a {
    /* Changed link color to primary blue */
    color: var(--hanapp-primary-blue, #2e94f4ff);
    text-decoration: none;
    font-weight: 500;
}

.contact-info a:hover {
    text-decoration: underline;
}
</style>

<div class="contact-wrapper">
    <div class="contact-card">
        <h1>Contact Us</h1>
        <p>We’d love to hear from you! Reach out through the following channels:</p>
        <ul class="contact-info">
            <li>📞 <strong>Phone:</strong> 0965 795 1956</li>
            <li>📧 <strong>Email:</strong> foodspot@gmail.com</li>
            <li>📱 <strong>Facebook:</strong> <a href="https://facebook.com/Foodspot.ph" target="_blank">Foodspot.ph</a></li>
        </ul>
        </div>
    </div>
</div>

@endsection
