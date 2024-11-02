

@extends('layouts.authentication.master')
@section('title', 'Sign-up-one')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
<div class="container-fluid p-0">
    <div class="row m-0">
       <div class="col-12 p-0">
          <div class="login-card">
             <div>

        <div class="login-main">
        <form class="theme-form" method="POST" action="{{ route('register') }}">
            @csrf
            <div><a class="logo" href="{{ route('login') }}"><img class="img-fluid for-light" src="{{asset('assets/images/logo/login.png')}}" alt="looginpage"><img class="img-fluid for-dark" src="{{asset('assets/images/logo/logo_dark.png')}}" alt="looginpage"></a></div>
            <h4>Create your account</h4>
                     <p>Enter your personal details to create account</p>
            <div class="form-group">
            <label class="col-form-label">Your Name</label>
                    <input class="form-control" type="text" name="name"  required="" placeholder="Enter your name">
            </div>
            <!-- Email Address -->

            <div class="form-group">
                <label class="col-form-label">Email Address</label>
                <input class="form-control" type="email" id="email" name="email" required="" placeholder="Test@gmail.com">
             </div>

            <!-- Password -->
            <div class="form-group">
                <label class="col-form-label">Password</label>
                <input class="form-control" type="password" id="password" name="password" required="" placeholder="*********">
             </div>
             {{-- <div class="form-group">
                <label class="col-form-label">confirm Password</label>
                <input class="form-control" type="password" id="password" name="password_confirmation" required="" placeholder="*********">
             </div> --}}
            <!-- Remember Me -->
            <div class="form-group mb-0">
                {{-- @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif --}}
                @if (Route::has('login'))
                <p class="mt-4 mb-0">Already have an account?<a class="ms-2" href="{{ route('login') }}">Log in</a></p>
            @endif
                <button class="btn btn-primary btn-block" type="submit">Sign Up</button>

            </div>
        </form>
    </div>
</div>
</div>
</div>
</div>
</div>
@endsection
@section('script')
@endsection
