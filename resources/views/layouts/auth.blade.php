<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PathSeeker - Authentication')</title>
    <!-- Local Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Local Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Local Font Awesome CSS -->
    <link href="{{ asset('css/fontawesome.min.css') }}" rel="stylesheet">
    <!-- Font Awesome Webfonts (for icons) -->
    <link rel="stylesheet" href="{{ asset('webfonts/fa-solid-900.woff2') }}" type="font/woff2" crossorigin>
    <!-- Add any other necessary CSS -->
    @stack('styles')
</head>
<body>
    <div class="container">
        @yield('content')
    </div>

    <!-- Local jQuery JS -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <!-- Local Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- Add any other necessary JS -->
    @stack('scripts')
</body>
</html>