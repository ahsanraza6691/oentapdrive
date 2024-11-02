@extends('admin_dashboard.layouts.master')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="form theme-form">
                        <form id="" action="{{route('configuration.store')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>Copy Right</label>
                                        <input class="form-control" type="text" placeholder="Enter Copyright" data-bs-original-title="" title="" name="copy_right" value="{{old('copy_right')}}">
                                    </div>
                                </div>
                            </div>
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
                                        <label for="">Email</label>
                                        <input class="form-control" type="email" placeholder="Enter Email" data-bs-original-title="" title="" name="email" value="{{old('email')}}">
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
                                        <label for="">Map Link</label>
                                        <input class="form-control" type="text" placeholder="Enter Embeded Map Link" data-bs-original-title="" title="" name="map_link" value="{{old('map_link')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="">Shipping Fee</label>
                                        <input class="form-control" type="number" placeholder="Enter Shipping Fee" data-bs-original-title="" title="" name="shipping_fee" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="">Short Description</label>
                                        <textarea class="form-control editor" name="short_description" id="" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div>
                                        <button type="submit" id="" class="btn btn-success me-3">Add</button>
                                        <a class="btn btn-danger" href="{{route('configuration.index')}}" data-bs-original-title="" title="">Cancel</a>
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

