@extends('layouts.guest')

@section('title', 'Admin Login | HANAPP')

@section('content')
<style>
    :root {
        --hanapp-light-blue: #9fd3f3ff;
        --hanapp-primary-blue: #2e94f4ff;
        --hanapp-bright-blue: rgba(181, 210, 243, 1);
        --hanapp-dark-blue: #0b68e0;
    }

    body {
        background-color: #f5f9ff !important;
        font-family: 'Poppins', sans-serif;
    }

    .login-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 90vh;
    }

    .login-card {
        background: white;
        border: 2px solid var(--hanapp-primary-blue);
        border-radius: 15px;
        padding: 40px 50px;
        box-shadow: 0 4px 10px rgba(46, 148, 244, 0.2);
        width: 100%;
        max-width: 420px;
    }

    .login-title {
        color: var(--hanapp-dark-blue);
        font-weight: 700;
        text-align: center;
        margin-bottom: 30px;
        font-size: 1.8rem;
    }

    .form-control {
        border: 1.8px solid var(--hanapp-primary-blue);
        border-radius: 10px;
        height: 45px;
        box-shadow: none;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--hanapp-dark-blue);
        box-shadow: 0 0 5px rgba(46, 148, 244, 0.4);
    }

    .btn-login {
        background-color: var(--hanapp-primary-blue);
        border: none;
        color: white;
        width: 100%;
        border-radius: 10px;
        height: 45px;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }

    .btn-login:hover {
        background-color: var(--hanapp-dark-blue);
    }

    .register-link {
        text-align: center;
        margin-top: 15px;
        font-size: 0.95rem;
    }

    .register-link a {
        color: var(--hanapp-primary-blue);
        font-weight: 500;
        text-decoration: none;
    }

    .register-link a:hover {
        text-decoration: underline;
    }
</style>

<nav class="navbar navbar-light hanapp-navbar shadow-sm">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <a class="navbar-brand fw-bold hanapp-logo" href="{{ route('home') }}">
            HANAPP
        </a>

        <div class="d-flex align-items-center">
            <a href="{{ route('home') }}" class="btn btn-sm btn-outline-dark me-2">Back to Home</a>

        </div>
    </div>
</nav>

<div class="login-container">
    <div class="login-card">
        <h2 class="login-title">Admin Login</h2>

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" name="email" id="email" class="form-control" required autofocus>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-login mt-3">Login</button>
        </form>
    </div>
</div>

<footer class="text-center py-4 mt-5" style="font-size: 0.9rem;">
    Alright Reserve © 2025.
</footer>
@endsection
