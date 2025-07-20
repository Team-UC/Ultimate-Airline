<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navbar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" xintegrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
<link rel="stylesheet" href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('slick/slick.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('slick/slick-theme.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('css/datepicker.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/tooplate-style.css') }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* --- Top Bar Styling --- */
        .top-bar {
            background-color: #1a1a1a;
            color: #adb5bd;
            font-size: 0.85rem;
            padding: 0.5rem 0;
        }

        .top-bar a {
            color: #adb5bd;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .top-bar a:hover {
            color: #ffffff;
        }

        .top-bar .social-icons a {
            margin-right: 1rem;
        }

        .top-bar .contact-info span {
            margin-left: 1.5rem;
        }
        
        .top-bar .contact-info .fa-solid {
            margin-right: 0.5rem;
        }

        /* --- Main Navbar Styling --- */
        .main-navbar {
            background-color: #212529;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }

        .navbar-nav .nav-link {
            color: #ffffff;
            font-weight: 500;
            margin: 0 0.5rem;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: #dc3545;
        }

        /* --- Auth Buttons Styling --- */
        .auth-buttons .btn {
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
        }

        .auth-buttons .btn-login {
            color: #ffffff;
            background-color: transparent;
            border: 1px solid transparent;
        }
        
        .auth-buttons .btn-login:hover {
            color: #dc3545;
        }

        .auth-buttons .btn-signup {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #ffffff;
        }
        
        .auth-buttons .btn-signup:hover {
            background-color: #bb2d3b;
            border-color: #b02a37;
        }
        
        /* Toggler icon color */
        .navbar-toggler {
            border-color: rgba(255,255,255,0.1);
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.55%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
    </style>
</head>
<body>

    <header>
        <!-- Top contact and social bar -->
        <div class="top-bar d-none d-lg-block">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <div class="contact-info d-flex">
                    <span><i class="fa-solid fa-phone"></i> +977 98xxxxxxxx</span>
                    <span><i class="fa-solid fa-envelope"></i> info@yourwebsite.com</span>
                </div>
            </div>
        </div>

        <!-- Main navigation bar -->
        <nav class="navbar navbar-expand-lg main-navbar navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="#">  <img src="https://ultimatecoder.in/images/logo.png" style="width:50px;" alt="Site logo"> ULTIMATE AIRLINES</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <!-- <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Tours</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Destinations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li> -->
                    </ul>
                    <div class="auth-buttons d-flex align-items-center">
                        <a href="#" class="btn btn-login"><i class="fa-solid fa-right-to-bracket me-1"></i> Log In</a>
                        <a href="#" class="btn btn-signup ms-2"><i class="fa-solid fa-user-plus me-1"></i> Sign Up</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
