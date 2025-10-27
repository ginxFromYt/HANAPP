@extends('layouts.app')
@section('title', 'Careers')

@section('content')

<style>
/* 🌊 HANAPP Careers Page Styling - Blue Theme */
.careers-wrapper {
    font-family: 'Poppins', sans-serif;
    padding: 60px 20px;
    display: flex;
    justify-content: center;
}

.careers-card {
    background-color: #fff;
    max-width: 800px;
    width: 100%;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    /* Changed from light green to light blue */
    border: 1px solid var(--hanapp-light-blue, #9fd3f3ff); 
}

.careers-card h1 {
    /* Changed to primary blue */
    color: var(--hanapp-primary-blue, #2e94f4ff); 
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 1.2rem;
    text-align: center;
}

.careers-card p {
    font-size: 1rem;
    color: #444;
    line-height: 1.6;
    text-align: center;
    margin-bottom: 1.5rem;
}

.careers-list {
    list-style: none;
    padding: 0;
}

.careers-list li {
    /* Changed from light green background to a very light blue/white */
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

.careers-list li:hover {
    /* Changed hover background color to a slightly darker light blue */
    background-color: #e6f7ff; 
    transform: translateX(5px);
}

.careers-email {
    text-align: center;
    margin-top: 20px;
    font-weight: 500;
}

.careers-email strong {
    /* Changed to primary blue */
    color: var(--hanapp-primary-blue, #2e94f4ff);
}
</style>

<div class="careers-wrapper">
    <div class="careers-card">
        <h1>Careers</h1>
        <p>Join the Alright Reserve team! We’re always looking for passionate individuals who want to make a difference in local food communities.</p>

        <ul class="careers-list">
            <li>🌱 Marketing & Community Engagement</li>
            <li>💻 Web Development & IT Support</li>
            <li>📞 Customer Service</li>
            <li>🤝 Partnerships & Business Development</li>
        </ul>

        <p class="careers-email">
            If you’re interested, send us your CV at <strong>careers@foodspot.com</strong>.
        </p>
    </div>
</div>

@endsection
