<!-- resources/views/components/header.blade.php -->

<!-- load stylesheets -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
<link rel="stylesheet" href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('slick/slick.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('slick/slick-theme.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('css/datepicker.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/tooplate-style.css') }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<body>
    <div class="tm-main-content" id="top">
        <div class="tm-top-bar-bg"></div>
        <div class="tm-top-bar" id="tm-top-bar">
            <div class="container">
                <div class="row">
                    <div class="top-bar d-none d-lg-block">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="social-icons">
                    <a href="https://www.facebook.com/"><i class="fab fa-facebook"></i> </a>
                    <a href="https://x.com/"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <div class="contact-info d-flex">
                    <span><i class="fa-solid fa-phone"></i> +977 98xxxxxxxx</span>
                    <span><i class="fa-solid fa-envelope"></i> info@yourwebsite.com</span>
                </div>
            </div>
        </div>
                    <nav class="navbar navbar-expand-lg narbar-light">
                        <a class="navbar-brand mr-auto" href="{{url('/')}}">
                            <!-- <img src="{{ asset('img/logo.png') }}" alt="Site logo"> -->
                            <img src="https://ultimatecoder.in/images/logo.png" style="width:50px;" alt="Site logo"> 
                            Ultimate Airline 
                        </a>
                        <button type="button" id="nav-toggle" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#mainNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                                                  
                    </nav>            
                </div>
            </div>
        </div>
    </div>
</body>
