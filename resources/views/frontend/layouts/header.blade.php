<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <link rel="icon" type="image/x-icon" href="assets/images/logo/favsss.png" /> --}}

    @if (isset($details))
        <meta property="og:title"
              content="{{ $details->get_brand_name->brand_name ?? '' }} {{ $details->model_name ?? '' }} {{ $details->make_year ?? '' }}">
        <meta property="og:description" content="Your Description Here">
        <meta property="og:image" content="{{ asset('images/') }}/{{ $details->get_images[0]->images }}">
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="630" />
    @endif

    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- include the CSS file for Owl Carousel -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- include the CSS file for Owl Carousel default theme -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- @notifyCss --}}
    <link style="width: 100%" rel="icon" href="{{asset('assets/images/fav.png')}}" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        .otp-input,
        .email-otp-input {
            width: 40px;
            height: 40px;
            text-align: center;
            font-size: 18px;
            margin: 0 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
            transition: border-color 0.3s;
        }

        .otp-input:focus,
        .email-otp-input:focus {
            border-color: #007bff;
        }

        .user_img {
            cursor: pointer;
        }

        .new_dropdown_menu {
            width: 7.6rem !important;
            right: 0px !important;
            left: 20px !important;
        }

        .fixed-navbar {
            position: fixed !important;
            top: 0;
            width: 100%;
            background-color: #333333;
            animation: fadeInDown 0.5s;
        }

        @keyframes fadeInDown {
            from {
                transform: translateY(-100%);
            }
            to {
                transform: translateY(0);
            }
        }
        .navbar{
            background-color: var(--secondary);
        }

        .nav_sticky {
            position: sticky;
            top: 0;
            left: 0;
            z-index: 999;
        }

        .new_head{
            /* position: absolute;
            z-index: 9999;
            background-color: transparent; */
        }
        @media(max-width: 768px){
            .login_modal_body{
                height: 500px;
                overflow: scroll;
            }
            .modal_zindex{
                z-index: 99999;
            }
        }




        ul.submenu-wrapper {
            position: absolute !important;
            top: 41px !important;
            left: 5 !important;
            list-style-type: none !important;
            padding: 0px 1px !important;
            min-width: 260px !important;
            background: #fcfcfc !important;
            border-radius: 6px !important;
            -webkit-transform: rotateX(-90deg) !important;
            transform: rotateX(-90deg) !important;
            -webkit-perspective: 200px !important;
            perspective: 200px !important;
            opacity: 0 !important;
            visibility: hidden !important;
            -webkit-transition: 0.3s ease-in !important;
            transition: 0.3s ease-in !important;
            z-index: 50 !important;
            -webkit-transform-origin: 0% 0% !important;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px !important;
            transform-origin: 0% 0% !important;
        }
        .lease_li .submenu-wrapper {
            min-width: 315px;
        }
        ul.submenu-wrapper li {
            padding: 7px 10px !important;
            border-bottom: 1px solid #e7e1e1 !important;
        }
        ul.submenu-wrapper li:last-child {
            padding: 9px 10px !important;
            border-bottom: none !important;
        }
        ul.submenu-wrapper a {
            padding: 0px 10px !important;
        }
        ul.submenu-wrapper li:last-child {
            padding: 9px 10px !important;
            border-bottom: none !important;
        }
        .fleet_li:hover > .submenu-wrapper {
            -webkit-transform: rotateX(0deg) !important;
            transform: rotateX(0deg) !important;
            opacity: 1 !important;
            visibility: visible !important;
        }
        .submenu{
            padding: 0px !important;
        }



        /* Existing CSS for the wide sub-menu */
        .wide-sub-menu {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            width: 100%;
            padding: 30px 60px;
            border-bottom: 1px solid #bfbfbf75;
            background: #fff;
            position: fixed;
            top: 72px;
            left: 0;
            right: 0;
            z-index: -2;
            visibility: hidden;
            opacity: 0;
            transition: visibility 0s linear 250ms, opacity 250ms linear; /* Ensure visibility transition after fade-out */
        }

        .wide-sub-menu-rent {
            position: absolute;
            width: 100%;
            /*padding: 10px 0px;*/
            border-bottom: 1px solid #bfbfbf75;
            background: #fff;
            /*position: fixed;*/
            top: 57px;
            left: -20px;
            right: 0;
            z-index: -2;
            visibility: hidden;
            opacity: 0;
            transition: visibility 0s linear 250ms, opacity 250ms linear; /* Ensure visibility transition after fade-out */
            border-radius: 10px;
        }



        /* CSS for hover state with fade-in effect */
        #navbar li.nw_submenu:hover > ul.wide-sub-menu {
            visibility: visible;
            opacity: 1;
            z-index: 2;
            transition: opacity 150ms linear; /* Only fade-in opacity */
            background: linear-gradient(90deg, rgb(236 234 230) 0%, rgb(228 225 220) 100%);
            box-shadow: 0 0 10px rgba(37, 37, 37, 0.12);
        }

        #navbar li.nw_submenu:hover > ul.wide-sub-menu-rent {
            visibility: visible;
            opacity: 1;
            z-index: 2;
            transition: opacity 150ms linear; /* Only fade-in opacity */
            background: #fff;
            box-shadow: 0 0 10px rgba(37, 37, 37, 0.12);
        }

        /* Keyframes for fade-in animation */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                visibility: hidden;
                z-index: -2;
            }
            100% {
                opacity: 1;
                visibility: visible;
                z-index: 2;
            }
        }

        /* Keyframes for fade-out animation */
        @keyframes fadeOut {
            0% {
                opacity: 1;
                visibility: visible;
                z-index: 2;
            }
            100% {
                opacity: 0;
                visibility: hidden;
                z-index: -2;
            }
        }

        /* Existing CSS for sub-menu headings and items */
        #navbar li.nw_submenu .wide-sub-menu .wide-sub-menu-inner-main-heading {
            border-bottom: 2px solid #bfbfbf75;
            width: 50%;
            display: block;
            padding-bottom: 10px;
            margin-bottom: 45px;
            height: 40px;
        }
        .wide-sub-menu-inner-main-heading,
        .wide-sub-menu-inner-item-box-heading {
            color: #fff;
        }
        .wide-sub-menu-inner-item-box p {
            color: #dbdbdb;
        }
        a.brand_drop {
            color: #212121;
            font-size: 20px;
            margin-top: 5px;
        }

        @media(min-width: 768px){
            .navbar .brand_menu li {
                width: 20%;
                display: flex;
                align-items: center;
                margin-top: 13px;
            }
            .wide-sub-menu-rent {
                min-width: 660px;
            }
            .new-submenu-desktop {
                min-width: 900px;
            }
        }
        @media(max-width: 768px){
            .navbar .brand_menu {
                width: 100%;
                padding-left: 20px;
            }
        }
        .navbar .brand_menu {
            width: 100%;
            padding-left: 110px;
        }
        .brand_drop:hover {
            color: #68665f !important;
        }



        ul.submenu-wrapper {
            position: absolute;
            top: 41px;
            left: 5;
            list-style-type: none;
            padding: 0px 1px;
            min-width: 260px;
            background: #fcfcfc;
            border-radius: 6px;
            -webkit-transform: rotateX(-90deg);
            transform: rotateX(-90deg);
            -webkit-perspective: 200px;
            perspective: 200px;
            opacity: 0;
            visibility: hidden;
            -webkit-transition: 0.3s ease-in;
            transition: 0.3s ease-in;
            z-index: 50;
            -webkit-transform-origin: 0% 0%;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            transform-origin: 0% 0%;
        }
        .fleet_li:hover > .submenu-wrapper {
            -webkit-transform: rotateX(0deg);
            transform: rotateX(0deg);
            opacity: 1;
            visibility: visible;
        }
        .new-submenu-desktop {
            display: flex;
            flex-wrap: wrap;
        }

        .new-submenu-desktop ul li {
            padding: 5px 0px;
            border-bottom: 1px solid #bfbfbf75;
        }
        .new-submenu-desktop ul li a:hover {
            color: #FFBA00 !important;
        }
        .new-submenu-desktop h6{
            font-size: 14px;
            color: #727171;

        }

        .new-submenu-desktop .col-sm-4.bg-gray {
            border: none;
            background: #f6f6f6;
        }
        .new-submenu-desktop .col-sm-4 {
            padding: 20px;
            border-right: 1px solid #bfbfbf75;
        }
        .border_radius_10{
            border-radius: 10px;
        }
        .border_none{
            border: none !important;
        }


    </style>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-N4RRTT5F');</script>
<!-- End Google Tag Manager -->
  <meta name="google-site-verification" content="qWp4ndLf_-nwSyjg9JdPIJQyFoa-3i6GrRA0tUzHXlQ" />
  <!-- Google tag (gtag.js) --> <script async src="https://www.googletagmanager.com/gtag/js?id=G-RQZ461ZLKR"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-RQZ461ZLKR'); </script>

</head>

<body>
  <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N4RRTT5F"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<header class="nav_sticky">
    <nav id="navbar" class="navbar navbar-expand-lg w-100 py-3 {{ request()->routeIs('home') ? 'new_head' : '' }}">
        <div class="container">
            <a class="navbar-brand fw-bold py-0" href="{{ route('home') }}">
                <!-- Wheels On Click -->
                <img src="{{ asset('assets/images/logo.png') }}" alt="" class="header-logo" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-4">
                    <li class="nav-item dropdown fleet_li nw_submenu">
                        <a class="nav-link dropdown-toggle text-light" href="#" data-bs-toggle="dropdown">
                            <!--<i class="fa-solid fa-id-card"></i> -->
                            Rent A Car
                        </a>

                        <ul style="width: fit-content" class="wide-sub-menu-rent">
                            <li>
                                <div class="container ">
                                    <div class="row new-submenu-desktop ">
                                        <div class="col-sm-4">
                                            <h6>Categories</h6>
                                            <ul>
                                                <li><a class="text-dark" href="{{route('rent-cheap-economy-cars-dubai')}}">Economy Cars</a></li>
                                                <li><a class="text-dark" href="{{route('luxury-car-rental-dubai')}}">Luxury Car Rental Dubai</a></li>
                                                <li><a class="text-dark" href="{{route('rent-sports-cars-in-dubai')}}">Sports Car Rental Dubai</a></li>
                                                <li><a class="text-dark" href="{{route('rent-special-edition-car-dubai')}}">Special Edition</a></li>
                                                <li><a class="text-dark" href="{{route('rent-muscles-cars-in-dubai')}}">Muscle Cars</a></li>
                                                <li><a class="text-dark" href="{{route('rent-hybrid-electrical-cars-dubai')}}">Electric Cars</a></li>
                                            </ul>
                                            <h6 class="mt-4">Other</h6>
                                            <ul>
                                                <li><a class="text-dark" href="{{route('list-your-rental-cars')}}">List Your Cars</a></li>
                                                <li class="border_none"><a class="text-dark" href="{{route('companies')}}">Directory</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <h6>Body Types</h6>
                                            <ul>
                                                <li><a class="text-dark" href="{{ route('car-rentals', ['type' => 'suv']) }}">SUV</a></li>
                                                <li><a class="text-dark" href="{{ route('car-rentals', ['type' => 'sedan']) }}">Sedan</a></li>
                                                <li><a class="text-dark" href="{{ route('car-rentals', ['type' => 'crossover']) }}">Crossover</a></li>
                                                <li><a class="text-dark" href="{{ route('car-rentals', ['type' => 'convertible']) }}">Convertible</a></li>
                                                <li><a class="text-dark" href="{{ route('car-rentals', ['type' => 'compact']) }}">Compact</a></li>
                                                <li><a class="text-dark" href="{{ route('car-rentals', ['type' => 'coupe']) }}">Coupe</a></li>
                                                <li><a class="text-dark" href="{{ route('car-rentals', ['type' => 'van']) }}">Van</a></li>
                                                <li><a class="text-dark" href="{{ route('car-rentals', ['type' => 'special-needs']) }}">Special Needs</a></li>
                                                <li><a class="text-dark" href="{{ route('car-rentals', ['type' => 'hybrid']) }}">Hybrid</a></li>
                                                <li><a class="text-dark" href="{{ route('car-rentals', ['type' => 'pickup-truck']) }}">Pickup Truck</a></li>
                                                {{-- <li class="border_none"><a class="text-dark" href="#">Bus</a></li> --}}
                                            </ul>
                                        </div>
                                        <div class="col-sm-4 bg-gray">
                                            <h6>Rental by Period</h6>
                                            <ul>
                                                <li>
                                                    <a class="text-dark" href="#">Daily Car Rental</a>
                                                </li>

                                                <li><a class="text-dark" href="#">Weekly Car Rental</a></li>

                                                <li><a class="text-dark" href="#">Monthly Car Rental</a></li>


                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                     
                    </li>
                    <li class="nav-item dropdown nw_submenu">
                        <a class="nav-link dropdown-toggle text-light" href="#"
                           data-bs-toggle="dropdown">
                            <!--<i class="fa-solid fa-id-card text-light"></i> -->
                            Car Brands
                        </a>
                        <ul style="width: auto" class="wide-sub-menu">
                            <div class="brand_menu">
                                @foreach ($brands as $brand)
                                    <li>
                                        <a class="dropdown-item brand_drop"
                                           href="{{ route('brand-car-rental', ['brand' => urlencode($brand->slug)]) }}">
                                            <img src="{{ asset('brands/' . $brand->brand_image) }}"
                                                 alt="">
                                            {{ $brand->brand_name }}</a>
                                    </li>
                                @endforeach

                            </div>

                        </ul>

                    </li>
                    <li class="nav-item dropdown fleet_li">
                        <a class="nav-link dropdown-toggle text-light" href="#"
                           data-bs-toggle="dropdown">
                            <!--<i class="fa-solid fa-id-card text-light"></i> -->
                            Car with Driver
                        </a>
                        <ul class="submenu-wrapper dropdown-menu">
                            @foreach ($services as $service_type)


                                <li>
                                    <a class="dropdown-item" href="{{route('car-with-driver',['service_type' => $service_type])}}">
                                        {{$service_type}} <strong class="float-end">»</strong></a>
                                    {{-- <ul class="submenu dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Hourly-Basis</a></li>
                                        <li>
                                            <a class="dropdown-item" href="#">Airport Transfer </a>
                                        </li>
                                    </ul> --}}
                                </li>
                            @endforeach

                        </ul>
                    </li>

                </ul>

                <div class="d-flex" style="position: relative">
                    <ul class="mb-0 d-flex align-items-center">
                        @if (!Auth::check())
                            <li class="nav-item">
                                <a class="btn nav_btn" href="#" class="login" data-bs-toggle="modal" data-bs-target="#login">
                                    Login / Signup
                                </a>
                                {{-- <div class="login_poppup d-flex" id="login_poppup_main">
                                    Log in now to unlock exclusive deals
                                    <div>
                                        <i onclick="loginPoppup()" class="fa fa-times ms-4" aria-hidden="true"></i>
                                    </div>
                                </div> --}}
                            </li>
                        @endif
                        @if (Auth::check())
                            <li class="ms-2">
                                <div class="dropdown">
                                    <img class="user_img" data-bs-toggle="dropdown" aria-expanded="false"
                                         src="{{ asset('assets/images/user.png') }}" alt="">
                                    <span class="text-light">&nbsp; {{Auth::user()->name}}</span>
                                    <ul class="dropdown-menu new_dropdown_menu">
                                        @if (Auth::check() && Auth::user()->role == 3)
                                            <li><a class="dropdown-item"
                                                   href="{{ route('my-profile') }}">Dashboard</a></li>
                                            <li><a class="dropdown-item"
                                                   href="{{ route('wishlist') }}">Wishlist</a></li>
                                            <li><a class="dropdown-item"
                                                   href="{{ route('user-logout') }}">Logout</a></li>
                                        @endif
                                        @if (Auth::check() && Auth::user()->role == 2)
                                            <li><a class="dropdown-item"
                                                   href="{{ route('vendor-dashboard') }}">Dashboard</a></li>
                                            <li><a class="dropdown-item" href="{{ route('rent-car.index') }}">Car
                                                    Listing</a>
                                                <form id="logout-form" action="{{ route('vendor-logout') }}" method="POST">
                                                @csrf
                                            </li>
                                            <li>
                                                <button class="dropdown-item" type="submit">

                                                    Logout</button></li>
                                            </form>
                                        @endif

                                        @if (Auth::check() && Auth::user()->role == 1)
                                            <li><a class="dropdown-item"
                                                   href="{{ route('admin-home') }}">Dashboard</a></li>

                                        @endif
                                        {{-- <li><a class="dropdown-item" href="#">Something </a></li> --}}
                                    </ul>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- Modal -->
<!-- Modal -->
<div class="modal fade modal_zindex" id="login" tabindex="-1" aria-labelledby="loginLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title me-auto" id="loginLabel">Sign up / Login to OneTapDrive</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body login_modal_body">
                <div class="container-fluid">
                    <div class="row  login_modal">
                        <div class="col-md-6">
                            <div>
                                <img class="w-100" src={{ asset('assets/images/login-img.webp') }}
                                    alt="">
                                <p>Ease your car rental search across the world

                                    Access exclusive features with a free account

                                    View saved cars, contacted listings and more</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <div>
                                    <button class="btn btn-primary w-100 facebook_bg_color">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="28.449" height="27.332"
                                             viewBox="0 0 28.449 27.332">
                                            <path id="Icon_awesome-facebook" data-name="Icon awesome-facebook"
                                                  d="M29.012,14.312A13.991,13.991,0,0,0,14.787.563,13.991,13.991,0,0,0,.563,14.312a13.907,13.907,0,0,0,12,13.583V18.286H8.951V14.312h3.614V11.282c0-3.446,2.122-5.349,5.373-5.349a22.626,22.626,0,0,1,3.184.268V9.584H19.328a2.022,2.022,0,0,0-2.318,2.147v2.581h3.945l-.631,3.975H17.01v9.608A13.907,13.907,0,0,0,29.012,14.312Z"
                                                  transform="translate(-0.563 -0.563)" fill="#fff"></path>
                                        </svg>
                                        Sign in with Facebook</button>
                                </div>
                                <div class="mt-2">
                                    {{-- <a href="{{ route('auth.google') }}" class="btn btn-primary w-100 google_bg_color">

                                        <img class="bg-light rounded-circle p-1"
                                            src={{ asset('assets/images/google.png') }} alt="">
                                        &nbsp;Sign in with Google</a> --}}



                                    <a href="{{ Route('login.google-redirect') }}" class="btn btn-primary w-100 google_bg_color">

                                        <img class="bg-light rounded-circle p-1"
                                             src={{ asset('assets/images/google.png') }} alt="">
                                        &nbsp;Sign in with Google</a>


                                </div>
                                <div class="mt-4">
                                    <div class="orboxsep" bis_skin_checked="1">
                                        <div bis_skin_checked="1">Or</div>
                                    </div>
                                </div>
                                <form id="emailOtp">
                                    @csrf
                                    <div>
                                        <input placeholder="Email" id="email" name="email"
                                               class="form-control" type="email" required>
                                    </div>
                                    <button type="submit" class="btn btn-otp w-100" role="button">
                                        Send OTP
                                    </button>
                                </form>
                                <button class="btn sign-mobile">
                                    Sign in with Mobile No.
                                </button>
                                <button class="btn apple-signin">
                                    Sign in with Apple
                                </button>
                                <p class="text-center">
                                    By continuing, you agree to our <br>
                                    <a href="#" target="_blank">Terms Of Service</a> and <a href="#"
                                                                                            target="_blank">Privacy Policy.</a>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="otp" tabindex="-1" aria-labelledby="otpLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title me-auto" id="otpLabel">Sign up / otp to  OneTapDrive</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="otpModal">
                <div class="container-fluid">
                    <div class="row otp_modal">
                        <div class="col-md-6">
                            <div>
                                <img class="w-100" src={{ asset('assets/images/login-img.webp') }}
                                    alt="">
                                <p>Ease your car rental search across the world

                                    Access exclusive features with a free account

                                    View saved cars, contacted listings and more</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <h4>Verification Code</h4>
                                <p>An OTP is sent to your email</p>
                                <a href="" id="otpemail"></a>
                                <h6 class="mt-4">ENTER 4 DIGIT OTP</h6>
                                <form id="verifyOtp">
                                    @csrf
                                    <div class="d-flex align-items-center justify-content-center">
                                        <input type="text" class="otp-input" name="otp_code[]" pattern="\d"
                                               maxlength="1">
                                        <input type="text" class="otp-input" name="otp_code[]" pattern="\d"
                                               maxlength="1" disabled>
                                        <input type="text" class="otp-input" name="otp_code[]" pattern="\d"
                                               maxlength="1" disabled>
                                        <input type="text" class="otp-input" name="otp_code[]" pattern="\d"
                                               maxlength="1" disabled>
                                    </div>
                                    <input type="hidden" id="verificationCode">
                                    <input type="hidden" id="emailverificationCode">
                                    <button class="btn btn-otp w-100" role="button">
                                        Verify
                                    </button>
                                </form>
                                <p class="text-center">
                                    Haven't received it yet?
                                    <a href="#" target="_blank">Resend</a>
                                </p>
                                <p class="text-center">
                                    In case you don't find our email in your inbox, please check your Spam folder.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@yield('content')

{{-- footer --}}
<footer>
    <div class="footer_wrap">
        <div class="content_wrap pt-5 pb-3">
            <div class="row">
                <div class="col-lg-3">
                    <img width="190px" class="mb-3" src="{{ asset('assets/images/logo.png') }}"
                         alt="" />
                    <p>
                        Find the best deals for budget and luxury / sports car rentals,
                        chauffeur service and driver on hire service. Headquartered in
                        Dubai, our services are available in select cities across the
                        globe.
                    </p>
                    <!--<div class="d-flex align-items-center">-->
                    <!--    <div>-->
                <!--        <img width="120px" src="{{asset('assets/images/play-store.png')}}" alt="">-->
                    <!--    </div>-->
                    <!--    <div>-->
                <!--        <img width="100px" src="{{asset('assets/images/app-store.png')}}" alt="">-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
                <div class="col-lg-2">
                    <ul>
                        <li><a href="{{ route('faq') }}">Dubai Car Rental FAQs</a></li>
                        <li><a href="{{ route('blogs') }}">Car Rental Blog</a></li>
                        <li><a href="{{ route('list-your-rental-cars') }}">List your rental cars</a></li>
                        <li><a href="{{ route('brands') }}">Rent by Brand</a></li>
                        <li><a href="#">Yacht Rental</a></li>
                        <li><a href="{{ route('desert-safari') }}">Desert Safari Dubai</a></li>
                        <li><a href="{{ route('car-with-driver') }}">Car with Driver</a></li>
                        <li><a href="#">Car Rental App</a></li>
                        <li><a href="#">Ramadan Car Rental Offers</a></li>
                    </ul>
                </div>
                <div class="col-lg-2">
                    <ul>
                        <li><a href="{{ route('about-us') }}">About Us</a></li>
                        <li><a href="{{ route('terms-and-conditions') }}">Terms & Conditions</a></li>
                        <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('terms-of-use') }}">Terms of Use</a></li>
                        <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
                        <li><a href="#">Sitemap XML</a></li>
                    </ul>
                </div>
                <div class="col-lg-2">
                    <ul>
                        <li>
                            <h3>For Inquiries And Support</h3>
                            <a href="tel:+971585672509">+971585672509</a>
                            <a href="mailto:info@onetapdrive.com">info@onetapdrive.com</a>
                        </li>
                        <li>
                            <h3>For Car with Driver</h3>
                            <a href="tel:+971585672509">+971585672509</a>
                        </li>
                        <li>
                            <h3>Advertise With Us</h3>
                            <a href="tel:+971585672509">+971585672509</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <ul>
                        <li>
                            <h3>Address</h3>
                            <p>
                                1501, Bayswater Tower, Marasi Drive, Business Bay, Dubai, UAE
                            </p>
                        </li>
                        <li>
                            <div class="map">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2822.7806761080233!2d-93.29138368446431!3d44.96844997909819!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x52b32b6ee2c87c91%3A0xc20dff2748d2bd92!2sWalker+Art+Center!5e0!3m2!1sen!2sus!4v1514524647889"
                                    width="600" height="450" frameborder="0" style="border: 0"
                                    allowfullscreen></iframe>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="d-flex flex-wrap align-items-center justify-content-center">
                    <div class="ms-2">
                        <img class="bg-light p-2" width="63px" src="{{asset('assets/images/visa.png')}}" alt="">
                    </div>
                    <div class="ms-2">
                        <img class="bg-light p-2" width="50px" src="{{asset('assets/images/master-card.webp')}}" alt="">
                    </div>
                    <div class="ms-2">
                        <img class="bg-light p-2" width="50px" src="{{asset('assets/images/union-pay.png')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="d-flex flex-wrap align-items-center justify-content-center footer_icons">
                    <div class="ms-2">
                        <i class="fab fa-facebook p-1" aria-hidden="true"></i>
                    </div>
                    <div class="ms-2">
                        <i class="fab fa-instagram p-1" aria-hidden="true"></i>
                    </div>
                    <div class="ms-2">
                        <i class="fab fa-linkedin p-1" aria-hidden="true"></i>
                    </div>
                    <div class="ms-2">
                        <i class="fab fa-tiktok p-1" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

{{-- @include('notify::components.notify')
  @notifyJs --}}
<script src="{{ asset('js/index.js') }}?time={{time()}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    @if (Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}"
    switch (type) {
        case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;
        case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;
        case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;
        case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
    }
    @endif
</script>
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            toastr.error('{{ $error }}');
        </script>
    @endforeach
@endif
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var otpInputs = document.querySelectorAll(".otp-input");

        function setupOtpInputListeners(inputs) {
            inputs.forEach(function(input, index) {
                input.addEventListener("input", function() {
                    var currentIndex = Array.from(inputs).indexOf(this);
                    var inputValue = this.value.trim();

                    if (!/^\d$/.test(inputValue)) {
                        this.value = "";
                        return;
                    }

                    if (inputValue && currentIndex < 3) {
                        inputs[currentIndex + 1].removeAttribute("disabled");
                        inputs[currentIndex + 1].focus();
                    }

                    updateOTPValue(inputs);
                });

                input.addEventListener("keydown", function(ev) {
                    var currentIndex = Array.from(inputs).indexOf(this);

                    if (!this.value && ev.key === "Backspace" && currentIndex > 0) {
                        inputs[currentIndex - 1].focus();
                    }
                });
            });
        }

        function updateOTPValue(inputs) {
            var otpValue = "";

            inputs.forEach(function(input) {
                otpValue += input.value;
            });

            document.getElementById("verificationCode").value = otpValue;
            document.getElementById("emailverificationCode").value = otpValue;
        }

        setupOtpInputListeners(otpInputs);

        otpInputs[0].focus(); // Set focus on the first OTP input field
    });
</script>

<script>
    $('#emailOtp').on('submit', function(e) {
        e.preventDefault();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var form = $("#emailOtp");
        var email = $("#email").val();
        $.ajax({
            type: "POST",
            url: '{{ route('email-otp') }}',
            data: form.serialize(),
            // beforeSend: function() {
            //     $("#preloaderSmall").removeClass('loader-active');
            // },
            success: function(response, data) {
                $('#otpemail').val('');
                // $("#preloaderSmall").addClass('loader-active');
                if (response.status == 200) {
                    $('#otp').modal('show');
                    $('#login').modal('hide');
                    $('#otpemail').text(email);
                    toastr.success('OTP sent on email !');
                }
            }
        })
    });
</script>




<a href="" id="otpemail"></a>

<script>
    $('#verifyOtp').on('submit', function(e) {
        e.preventDefault();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var form = $("#verifyOtp");
        $.ajax({
            type: "POST",
            url: '{{ route('email-verify') }}',
            data: form.serialize(),
            success: function(response, data) {
                if (response.status == 200) {
                    toastr.success('Otp verified successfully !');
                    window.location.href = "{{ route('my-profile') }}"
                }
                if (response.status == 502) {
                    toastr.error('Incorrect OTP code  !');
                }
            }
        })
    });



    // dropdown

    $(document).ready(function() {
        $(".button").click(function() {
            $(".dropdown a").removeClass("clicked");
            $(".dropdown a").children("span").removeClass("clicked");
            $(".arrow").toggleClass("open");
            $(".dropdown").toggleClass("open");
        });

        $(".dropdown a").click(function() {
            $(".dropdown a").removeClass("clicked");
            $(".dropdown a").children("span").removeClass("clicked");
            $(this).toggleClass("clicked");
            $(this).children("span").toggleClass("clicked");
        });
    });

    // for navbar

    //     window.addEventListener('scroll', function() {
    //     const header = document.querySelector('header');

    //     if (window.scrollY > 50) {
    //         header.classList.add('fixed-navbar');
    //     } else {
    //         header.classList.remove('fixed-navbar');
    //     }
    // });

    document.addEventListener('DOMContentLoaded', function() {
        var isHomePage = window.location.pathname === '/';
        if (isHomePage) {
            document.querySelector('.navbar').classList.add('new_head');
        }
    });

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    function loginPoppup(){
        var login_poppup_main = document.getElementById("login_poppup_main")
        login_poppup_main.classList.add('d-none')

    }

</script>
</body>

</html>
