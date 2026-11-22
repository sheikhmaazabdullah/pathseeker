<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PathSeeker Admin Panel')</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables/css/dataTables.bootstrap5.min.css') }}">
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100%;
            background: #f8f9fa;
            padding-top: 100px;
            transition: all 0.3s;
            z-index: 1000;
            overflow-y: auto;
            border-right: 1px solid #e9ecef;
        }
        .page-body-wrapper {
            margin-left: 260px;
            min-height: 100vh;
            padding-top: 70px;
        }
        .main-panel {
            padding: 20px;
        }
        .content-wrapper {
            padding: 20px 0;
        }
        .sidebar-icon-only .sidebar {
            width: 70px;
        }
        .sidebar-icon-only .page-body-wrapper {
            margin-left: 70px;
        }
        @media (max-width: 991px) {
            .sidebar {
                left: -260px;
            }
            .page-body-wrapper {
                margin-left: 0;
            }
            .sidebar.active {
                left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container-scroller">
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            @include('layouts.partials.sidebar')
        </nav>

        <!-- Navbar and Main Content -->
        <div class="container-fluid page-body-wrapper">
            @include('layouts.partials.navbar')
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                @include('layouts.partials.footer')
            </div>
        </div>
    </div>

    <!-- Include necessary JS -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.querySelector('[data-bs-toggle="minimize"]');
            const sidebar = document.getElementById('sidebar');
            const body = document.body;

            if (toggle) {
                toggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                    body.classList.toggle('sidebar-icon-only');
                });
            }

            const mobileToggle = document.querySelector('.navbar-toggler-right');
            if (mobileToggle) {
                mobileToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>