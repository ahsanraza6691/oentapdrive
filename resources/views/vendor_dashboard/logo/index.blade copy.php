@extends('admin_dashboard.layouts.master')
{{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@2.8.2/dist/alpine.min.js"></script> --}}
@section('content')
@if (session('success'))
      <div class="alert alert-success">
         {!! session('success') !!}
      </div>
@endif
<form action="{{route('logo.store')}}" method="post" class="row signup_wallet"  enctype="multipart/form-data">
    @csrf

    <!-- main_logo -->
    <div class="form-group col-md-12 mb-5">
        <label for="">Main Logo</label>
        <div class="thumbnail col-md-2">
            <img src="{{ url('public/uploads/logos/' . $navLogo) }}" class="original_main_logo" alt="navlogo" width="50%">
            <input type="hidden" name="old_main_logo" value="{{$navLogo}}">
        </div>
        <input type="file" name="main_logo" placeholder="Upload Main Logo" class="form-control image_input">
    </div>
    <!-- favicon_logo -->
    <div class="form-group col-md-12 mb-5">
        <label for="">Favicon Logo</label>
        <div class="thumbnail col-md-2">
            <img src="{{url('public/uploads/logos/'.$favicon)}}" class="original_favicon_logo" alt="" width="50%">
            <input type="hidden" name="old_favicon_logo" value="{{$favicon}}">

        </div>
        <input type="file" name="favicon_logo" placeholder="Upload Favicon Logo" class="form-control image_input">
    </div>

    <!-- footer_logo -->
    <div class="form-group col-md-12 mb-5">
        <label for="">Footer Logo</label>
        <div class="thumbnail col-md-2">
            <img src="{{url('public/uploads/logos/'. $footerLogo)}}" class="original_footer_logo" alt="" width="50%">
            <input type="hidden" name="old_footer_logo" value="{{$footerLogo}}">

        </div>
        <input type="file" name="footer_logo" placeholder="Upload Footer Logo" class="form-control image_input">
    </div>


    <!-- submit button -->
    <div class="col-md-10"></div>
    <div class="form-group col-md-2 text-center">
        <button type="submit" class="btn btn-primary form-control">Save</button>
    </div>
</form>

<script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
{{-- script --}}
<script>
    $("document").ready(function(){
    setTimeout(function(){
       $("div.alert").remove();
    }, 2000 ); // 5 secs

});
    </script>

@endsection
