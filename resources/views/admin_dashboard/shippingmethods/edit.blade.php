@extends('admin_dashboard.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form theme-form">
                            <form id="" action="{{route('shipping-method.update',$ship_method->id) }}" method="POST">
                                {{-- <input id="hidden" type="hidden" name="hidden"> --}}
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="method_id" value="{{ $ship_method->id }}">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Shipping Title.*</label>
                                            <input class="form-control" type="text" placeholder="Enter Shipping Title" data-bs-original-title="" title="" name="shipping_title" value="{{$ship_method->shipping_title}}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Shipping Fee</label>
                                            <input class="form-control" type="number" placeholder="Enter Shipping Fee" data-bs-original-title="" title="" name="shipping_price" value="{{$ship_method->shipping_price}}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div>
                                            <button type="submit" id="" class="btn btn-success me-3">Update</button>
                                            <a class="btn btn-danger" href="{{route('shipping-method.index')}}" data-bs-original-title="" title="">Cancel</a>
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
@endsection
