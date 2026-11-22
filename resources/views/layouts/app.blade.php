<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'PathSeeker')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Career Passport Platform" name="keywords">
    <meta content="Career guidance and resources" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container-fluid bg-light pt-3 d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <p><i class="fa fa-envelope mr-2"></i>pathseekershere@gmail.com</p>
                        <p class="text-body px-3">|</p>
                        <p><i class="fa fa-phone-alt mr-2"></i>+012 345 6789</p>
                    </div>
                </div>
                <div class="col-lg-6 text-center text-lg-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-primary px-3" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="text-primary px-3" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="text-primary px-3" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="text-primary px-3" href="#"><i class="fab fa-instagram"></i></a>
                        <a class="text-primary pl-3" href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid position-relative nav-bar p-0">
        <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-light navbar-light shadow-lg py-3 py-lg-0 pl-3 pl-lg-5">
                <a href="{{ route('home') }}" class="navbar-brand">
                    <h1 class="m-0 text-primary"><span class="text-dark">PATH</span>SEEKER</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <a href="{{ route('home') }}" class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
                        <a href="{{ route('about') }}" class="nav-item nav-link {{ Request::is('about') ? 'active' : '' }}">About</a>
                        <a href="{{ route('service') }}" class="nav-item nav-link {{ Request::is('service') ? 'active' : '' }}">Services</a>
                        <a href="{{ route('package') }}" class="nav-item nav-link {{ Request::is('package') ? 'active' : '' }}">Packages</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu border-0 rounded-0 m-0">
                                <a href="{{ route('blog') }}" class="dropdown-item">Blog</a>
                                <a href="{{ route('single') }}" class="dropdown-item">Blog Detail</a>
                                <a href="{{ route('destinations') }}" class="dropdown-item">Destinations</a>
                                <a href="{{ route('guide') }}" class="dropdown-item">Guides</a>
                                <a href="{{ route('testimonial') }}" class="dropdown-item">Testimonial</a>
                            </div>
                        </div>
                        <a href="{{ route('contact') }}" class="nav-item nav-link {{ Request::is('contact') ? 'active' : '' }}">Contact</a>
                        @if (Auth::check())
                            @php
                                $dashboardRoute = '';
                                switch (Auth::user()->role) {
                                    case 'admin':
                                        $dashboardRoute = route('admin.dashboard');
                                        break;
                                    case 'professional':
                                        $dashboardRoute = route('professional.dashboard');
                                        break;
                                    case 'graduate':
                                        $dashboardRoute = route('graduate.dashboard');
                                        break;
                                    default:
                                        $dashboardRoute = route('home');
                                }
                            @endphp
                            <a href="{{ $dashboardRoute }}" class="nav-item nav-link {{ Request::is($dashboardRoute) ? 'active' : '' }}">Dashboard</a>
                            @if (Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="nav-item nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">Admin</a>
                            @endif
                            <a href="{{ route('logout') }}" class="nav-item nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
                            <a href="{{ route('register') }}" class="nav-item nav-link">Register</a>
                        @endif
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="container-fluid wrapper">
        <div class="content-wrapper" style="min-height: calc(100vh - 150px); padding-top: 80px;">
            <div class="container py-5">
                @yield('content')
            </div>
        </div>
        <div class="container-fluid bg-dark text-white-50 py-5 px-sm-3 px-lg-5" style="margin-top: 0;">
            <div class="row pt-5">
                <div class="col-lg-3 col-md-6 mb-5">
                    <a href="{{ route('home') }}" class="navbar-brand">
                        <h1 class="text-primary"><span class="text-white">PATH</span>SEEKER</h1>
                    </a>
                    <p>Discover your career path with personalized guidance.</p>
                    <h6 class="text-white text-uppercase mt-4 mb-3" style="letter-spacing: 5px;">Follow Us</h6>
                    <div class="d-flex justify-content-start">
                        <a class="btn btn-outline-primary btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-primary btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-primary btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-outline-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-5">
                    <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Quick Links</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-white-50 mb-2" href="{{ route('home') }}"><i class="fa fa-angle-right mr-2"></i>Home</a>
                        <a class="text-white-50 mb-2" href="{{ route('about') }}"><i class="fa fa-angle-right mr-2"></i>About</a>
                        <a class="text-white-50 mb-2" href="{{ route('service') }}"><i class="fa fa-angle-right mr-2"></i>Services</a>
                        <a class="text-white-50 mb-2" href="{{ route('package') }}"><i class="fa fa-angle-right mr-2"></i>Packages</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-5">
                    <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Contact</h5>
                    <p><i class="fa fa-map-marker-alt mr-2"></i>123 Career St, Tech City</p>
                    <p><i class="fa fa-phone-alt mr-2"></i>+012 345 6789</p>
                    <p><i class="fa fa-envelope mr-2"></i>pathseekershere@gmail.com</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-5">
                    <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Newsletter</h5>
                    <div class="w-100">
                        <div class="input-group">
                            <input type="text" class="form-control border-light" style="padding: 25px;" placeholder="Your Email">
                            <div class="input-group-append">
                                <button class="btn btn-primary px-3">Sign Up</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5" style="border-color: rgba(256, 256, 256, .1) !important;">
                <div class="row">
                    <div class="col-lg-6 text-center text-md-left mb-3 mb-md-0">
                        <p class="m-0 text-white-50">Copyright &copy; {{ date('Y') }} PathSeeker. All Rights Reserved.</p>
                    </div>
                    <div class="col-lg-6 text-center text-md-right">
                        <p class="m-0 text-white-50">Designed by <a href="#">NEXTECH</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('mail/contact.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @stack('scripts')
</body>
</html>