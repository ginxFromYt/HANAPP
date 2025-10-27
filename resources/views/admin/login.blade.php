<form action="{{ route('admin.login') }}" method="POST">
    @csrf
    <input type="email" name="email" placeholder="Admin Email" class="form-control mb-2" required>
    <input type="password" name="password" placeholder="Password" class="form-control mb-2" required>
    <button type="submit" class="btn btn-primary">Login</button>
</form>
