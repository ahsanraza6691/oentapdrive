@php

$favicon = App\Models\BackendModels\Logo::where("type", "Favicon")->first();
@endphp
<!DOCTYPE html>
<html lang="en"> 

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta name="description"
        content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{url('public/logos/'.$favicon->image)}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{url('public/logos/'.$favicon->image)}}" type="image/x-icon">
    <title>Admin Panel @yield('title')</title>
    <!-- Google font--> 
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />


    <!-- {{-- @include('layouts.authentication.css') --}} -->
    <!-- {{-- @include('layouts.simple.css') --}} -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-awesome.css')}}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/icofont.css')}}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/themify.css')}}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/flag-icon.css')}}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/feather-icon.css')}}">
    <!-- Plugins css start-->
    @yield('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/scrollbar.css')}}">
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{asset('assets/css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}">

    {{-- calender css --}}
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/chartist.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/dropzone.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/owlcarousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/rating.css')}}">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- {{-- toastr --}} -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

        <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    <style>
    /* Loader CSS */
    #preloaderSmall {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.9);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    #loaderSmall {
        display: flex;
        justify-content: center;
        align-items: center;
    }

  

   
    .zoom-in-zoom-out{animation:2s ease-out infinite zoom-in-zoom-out}@keyframes zoom-in-zoom-out{0%,100%{transform:scale(1,1)}50%{transform:scale(1.5,1.5)}}
</style>

    @yield('style')

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
</head>
{{-- <div class="loader-bg loader-active">
    <h3>Lotti</h3>
    <div class="loader">
        <span></span>
    </div>
  </div> --}}

<body>
    
    <!-- Loader Start -->
    <div id="preloaderSmall" class="loader-active">
        <div id="loaderSmall">
            <img class="zoom-in-zoom-out" width="100px" src="{{ asset('assets/images/logo-icon.png') }}" alt="Loader Icon">
        </div>
    </div>
    <!-- Loader End -->

    <div class="tap-top"><i data-feather="chevrons-up"></i></div>

    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        @include('admin_dashboard.layouts.header')

        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            @include('admin_dashboard.layouts.sidebar')
            <!-- Page Sidebar Ends-->

            {{-- <div id="preloaderSmall" class="loader-active">
                <div id="loaderSmall">
                </div>
                <div class="loaderSmallImage">
                    <img src="{{ asset('assets/images/fabIcon.webp') }}" alt="fabIcon">
                </div>
                </div> --}}


            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6">
                                @yield('breadcrumb-title')
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin-home') }}"> <i
                                                data-feather="home"></i></a></li>
                                    @yield('breadcrumb-items')
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid starts-->
                @yield('content')
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            @include('admin_dashboard.layouts.footer')
            <!-- {{-- cuba css --}} -->
            @include('admin_dashboard.layouts.script')
            <script>
        document.addEventListener("DOMContentLoaded", function() {
            var loader = document.getElementById('preloaderSmall');
            // Hide the loader once the page has fully loaded
            window.addEventListener('load', function() {
                loader.style.display = 'none';
            });
        });
    </script>
        </div>
    </div>
</body>
</html>
