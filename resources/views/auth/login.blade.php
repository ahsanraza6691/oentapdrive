@extends('layouts.authentication.master')
@section('title', 'Login')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
<style>
    .login-card {
    background-repeat: no-repeat !important;
    background-size: cover !important;
    /* background: url('https://bigvalley.co/wp-content/uploads/2020/10/Ecommerce-2000x1500-1-e1603836627139.jpg') !important; */
}
.login-card {
    width: 100% !important;
    height: 100% !important;
    background-size: cover !important;
    background-position: center !important;
}
.btn-primary {
    background-color: #ffffff !important;
    border-color:rgba(0, 0, 0, 0.8) !important;
    color: rgba(0, 0, 0, 0.8) !important;
    margin-top: 12px;
}
.login-card .login-main {
    background-color: rgba(0, 0, 0, 0.8) !important;
}
.login-card .login-main .theme-form h4 {
    color: white !important;
}
.login-card .login-main .theme-form p {
    color: #ffffff !important;
    margin-bottom: 20px !important;
}
.login-card .login-main .theme-form label {
    color: white !important;
}

</style>
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card">
                    <div>
                        <div class="login-main">
                            <form class="theme-form" method="POST" action="{{ route('login') }}">
                                @csrf
                                {{-- <div><a class="logo" href="{{ route('login') }}"><img class="img-fluid for-light" src="{{asset('assets/images/logo/login.png')}}" alt="looginpage"><img class="img-fluid for-dark" src="{{asset('assets/images/logo/logo_dark.png')}}" alt="looginpage"></a></div> --}}
                                <h4 class="align-center">Rent a Car  Admin Dashboard</h4>
                                {{-- <h7>Login to account</h7> --}}
                                <p>Enter your email & password to login</p>
                                <!-- Email Address -->

                                <div class="form-group">
                                    <label class="col-form-label">Email Address</label>
                                    <input class="form-control" type="email" id="email" name="email"
                                        placeholder="Test@gmail.com" value="{{ old('email') }}">
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <input class="form-control" type="password" id="password" name="password"
                                        placeholder="*********">
                                </div>

                                <!-- Remember Me -->
                                <div class="form-group mb-0">

                                    @if (Route::has('register'))
                                        {{-- <p class="mt-4 mb-0">Don't have an account?<a class="ms-2" href="{{ route('register') }}">register</a></p> --}}
                                    @endif
                                    <button class="btn btn-primary btn-block" type="submit">Log in</button>

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
