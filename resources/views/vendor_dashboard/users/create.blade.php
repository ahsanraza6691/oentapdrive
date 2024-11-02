@extends('admin_dashboard.layouts.master')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="form theme-form">
                        <form id="" action="{{route('user-store')}}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="1">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>First Name</label>
                                        <input class="form-control" type="text" placeholder="Enter First Name" data-bs-original-title="" title="" name="first_name" value="{{old('first_name')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>Last Name</label>
                                        <input class="form-control" type="text" placeholder="Enter Last Name" data-bs-original-title="" title="" name="last_name" value="{{old('last_name')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="">Email</label>
                                        <input class="form-control" type="email" placeholder="Enter Email" data-bs-original-title="" title="" name="email" value="{{old('email')}}">
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>User Name</label>
                                        <input class="form-control" type="text" placeholder="Enter User Name" data-bs-original-title="" title="" name="user_name" value="{{old('user_name')}}">
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="">Contact</label>
                                        <input class="form-control" type="number" placeholder="Enter Contact" data-bs-original-title="" title="" name="contact" value="{{old('contact')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="">Address</label>
                                        <input class="form-control" type="text" placeholder="Enter Address" data-bs-original-title="" title="" name="address" value="{{old('address')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="">Password</label>
                                        <input class="form-control" type="password" placeholder="Enter Password" data-bs-original-title="" title="" name="password" value="{{old('password')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="">Confirm Password</label>
                                        <input class="form-control" type="password" placeholder="Retype Password" data-bs-original-title="" title="" name="confirm_password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div>
                                        <button type="submit" id="" class="btn btn-success me-3">Add</button>
                                        <a class="btn btn-danger" href="{{route('user-index')}}" data-bs-original-title="" title="">Cancel</a>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- {{-- script start --}} -->
@endsection

