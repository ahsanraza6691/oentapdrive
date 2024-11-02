@extends('layouts.authentication.master')
@section('title', 'Login')

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
        <form class="theme-form" method="POST" action="{{ route('password.email') }}">
            @csrf
            <div><a class="logo" href="{{ route('login') }}"><img class="img-fluid for-light" src="{{asset('assets/images/logo/login.png')}}" alt="looginpage"><img class="img-fluid for-dark" src="{{asset('assets/images/logo/logo_dark.png')}}" alt="looginpage"></a></div>

            <h4>Reset Your Password</h4>

            <!-- Email Address -->
            {{-- <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div> --}}
            <div class="form-group">
                <label class="col-form-label">Email Address</label>
                <input class="form-control" type="email" id="email" :value="old('email')"  name="email" required="" placeholder="Test@gmail.com">
             </div>
             <button class="btn btn-primary btn-block" type="submit">Email Password Reset Link</button>
            {{-- <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div> --}}
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
