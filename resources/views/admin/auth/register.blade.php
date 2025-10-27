@extends('layouts.app')

@section('title', 'Admin Register')

@section('content')
<div class="container mt-5">
  <h3>Admin Registration</h3>
  <form method="POST" action="{{ route('admin.register') }}">
    @csrf
    <input type="text" name="name" placeholder="Full Name" required class="form-control mb-2" />
    <input type="email" name="email" placeholder="Email" required class="form-control mb-2" />
    <input type="password" name="password" placeholder="Password" required class="form-control mb-2" />
    <input type="password" name="password_confirmation" placeholder="Confirm Password" required class="form-control mb-2" />
    <button type="submit" class="btn btn-success">Register</button>
  </form>
</div>
@endsection
