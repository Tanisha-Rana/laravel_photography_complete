
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Photography By Monali</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('website/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/style.css') }}">

    <!-- Favicon -->
    <link href="{{ asset('website/img/image.png') }}" rel="icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Playfair+Display:wght@500&family=Work+Sans&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries -->
    <link href="{{ asset('website/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('website/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('website/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Active Page Styling -->
    <style>
        .nav-link.active {
            color: #d4a574 !important;
            font-weight: 600;
            border-bottom: 2px solid #d4a574;
            padding-bottom: 5px;
        }
        .navbar-nav .nav-link:hover {
            color: #d4a574;
        }
    </style>
</head>

<body>
    @include('sweetalert::alert')

    @if(session('profile_updated'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Profile Updated',
                    text: @json(session('profile_updated')),
                    timer: 2200,
                    showConfirmButton: false
                });
            });
        </script>
    @endif

<!-- Navbar Start -->
<div class="container-fluid bg-light sticky-top shadow-sm">
    <nav class="navbar navbar-expand-lg navbar-light py-2">
        <div class="container">

            <!-- Logo -->
            <a href="{{ url('/') }}" class="navbar-brand">
                <img src="{{ asset('website/img/logo.png') }}" alt="Photography By Monali" height="80" style="border-radius:10px;">
            </a>

            <!-- Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ url('/about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('categories') ? 'active' : '' }}" href="{{ url('/categories') }}">Categories</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('catalogues') ? 'active' : '' }}" href="{{ url('/catalogues') }}">Catalogues</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('packages') ? 'active' : '' }}" href="{{ url('/packages') }}">Packages</a></li>


                    <!-- Booking Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('booking', 'mybooking') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown">
                            Booking
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item {{ request()->is('booking') ? 'active' : '' }}" href="{{ url('/booking') }}">Book Appointment</a></li>
                            <li><a class="dropdown-item {{ request()->is('mybooking') ? 'active' : '' }}" href="{{ url('/mybooking') }}">My Bookings</a></li>

                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ url('/contact') }}">Contact</a></li>
                </ul>

               

                        <!-- Notifications -->
                       
<div class="d-flex align-items-center">
    @if(session()->has('client_id'))
        <!-- Notification Bell (Compact) -->
        @php
            $unreadCount = \App\Models\Notification::where('client_id', session('client_id'))
            ->where('is_read', 'no')
            ->count();
        @endphp
        <a href="{{ url('/notifications') }}" class="position-relative me-3">
            <i class="bi bi-bell fs-5 text-primary"></i>
            @if($unreadCount > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.55rem; padding: 0.25em 0.4em;">
                    {{ $unreadCount }}
                </span>
            @endif
        </a>

        <!-- Logged In -->
        <a href="{{ url('/profile') }}" class="me-3 fw-bold text-decoration-none text-dark">Hi, {{ session('client_name') }}</a>
        <a href="{{ url('/logout') }}" class="btn btn-primary">Logout</a>
    @else
        <a href="{{ url('/login') }}" class="btn btn-primary me-2">Login</a>
        <a href="{{ url('/registration') }}" class="btn btn-primary">Register</a>
    @endif
</div>
                    

                </div>
            </div>

        </div>
    </nav>
</div>
<!-- Navbar End -->

<!-- Bootstrap JS -->
<script src="{{ asset('website/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
