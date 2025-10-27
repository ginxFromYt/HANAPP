<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">HANAPP</a>

        <div class="collapse navbar-collapse justify-content-end">
            @auth('admin')
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary me-2">Dashboard</a>
                <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-outline-danger">Logout</button>
                </form>
            @else
                <a href="{{ route('admin.login') }}" class="btn btn-outline-primary me-2">Admin Login</a>
                <a href="{{ route('admin.register') }}" class="btn btn-outline-success">Register</a>
            @endauth
        </div>
    </div>
</nav>
