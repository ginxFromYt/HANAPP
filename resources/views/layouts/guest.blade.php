<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'FoodSpot')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* ✅ Inline CSS for custom background color */
        body {
            background-color:rgba(76, 233, 24, 0.29); /* Change this to any color you want */
        }
    </style>
</head>
<body>


    <main class="">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
