@php
$favicon = App\Models\BackendModels\Logo::where("type", "Favicon")->first();
@endphp
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{url('public/logos/'.$favicon->image)}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{url('public/logos/'.$favicon->image)}}" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

     <title>Admin | Login</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">


    @include('layouts.authentication.css')
    <script>
        toastr.options = {
            "positionClass": "toast-top-right",
            "showDuration": "9000",
            "hideDuration": "9000",
            "timeOut": "9000",
            "extendedTimeOut": "9000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>
    @yield('style')
  </head>
  <body>
    <!-- login page start-->
    @yield('content')
    <!-- latest jquery-->
    @include('layouts.authentication.script')

    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch(type){
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

        @if($errors->any())

    @foreach($errors->all() as $error)
    <script>
        toastr.error('{{$error}}');
    </script>
    @endforeach
    @endif
  </body>
</html>
