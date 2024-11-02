@extends('vendor_dashboard.layouts.master')
@section('content')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/owlcarousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/rating.css') }}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <!-- <h3>Inquiry Details</h3> -->
    <h3 class="welcome-dashboard-heading glitch glitch layers" data-text="Inquiry Details">Inquiry Details</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Inquiry</li>
    <li class="breadcrumb-item active"> Management</li>
@endsection

@section('content')
<style>
   .deteleButton {
    background-color: #C1272D;
    color: #fff !important;
    font-family: Poppins-Regular;
    font-size: 11px;
    border-radius: 22px !important;
    outline: none;
    border: none;
    padding: 10px 20px !important;
}
.deteleButton a {
    color: #fff !important;
}
.editButton {
background-color: #22B573;
    color: #fff !important;
    font-family: Poppins-Regular;
    font-size: 11px;
    border-radius: 22px !important;
    outline: none;
    border: none;
    padding: 10px 20px !important;
}
.editButton a {
    color: #fff !important;
}
.round-cstm-btn-green {
            border-radius: 30px !important;
            padding: 10px 20px !important;
            font-family: Poppins-Regular;
            background-color: #00a808 !important;
            border: none;
        }

        .round-cstm-btn-red a,
        .round-cstm-btn-green a {
            color: #fff;
            font-size: 14px;
        }
        .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper {
    height: 100% !important;
}
.details_heading {
    font-size: 18px;
}

.details_para {
    font-size: 15px;
}
</style>
    <div class="container-fluid" style="color: #000;">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">

                        {{-- <div class="row">
                            <div class="col-md-8">
                                <h5>Inquiry Management</h5>
                            </div>
                            <div class="col-md-4" align="right">
                                <a class="btn btn-primary" href="{{ route('InquiryCreate') }}"> <i
                                        data-feather="plus-square"> </i> Create</a>
                            </div>
                        </div> --}}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <h3 class="details_heading">
                                    Car Name
                                </h3>
                            </div>
                            <div class="col-md-9 mb-3">
                                <p class="details_para">
                                    {{ $detail->get_product->brand_name ?? '' }} {{ $detail->get_product->model_name ?? '' }} {{ $detail->get_product->make_year ?? '' }}
                                </p>
                            </div>
                            
                            
                            <div class="col-md-3 mb-3">
                                <h3 class="details_heading">
                                    Name
                                </h3>
                            </div>
                            <div class="col-md-9 mb-3">
                                <p class="details_para">
                                    {{ $detail->name }}
                                </p>
                            </div>
                            
                            
                            <div class="col-md-3 mb-3">
                                <h3 class="details_heading">
                                    Phone
                                </h3>
                            </div>
                            <div class="col-md-9 mb-3">
                                <p class="details_para">
                                    {{ $detail->contact }}
                                </p>
                            </div>
                            
                             <div class="col-md-3 mb-3">
                                <h3 class="details_heading">
                                    Email
                                </h3>
                            </div>
                            <div class="col-md-9 mb-3">
                                <p class="details_para">
                                    {{ $detail->email }}
                                </p>
                            </div>
                            
                            @if(!empty($detail->pickup_location))
                            <div class="col-md-3 mb-3">
                                <h3 class="details_heading">
                                    Pick up Location
                                </h3>
                            </div>
                            <div class="col-md-9 mb-3">
                                <p class="details_para">
                                   {{ $detail->pickup_location }}
                                </p>
                            </div>
                            @endif
                            
                            @if(!empty($detail->dropoff_location))
                            <div class="col-md-3 mb-3">
                                <h3 class="details_heading">
                                   Dropoff Location
                                </h3>
                            </div>
                            <div class="col-md-9 mb-3">
                                <p class="details_para">
                                   {{ $detail->dropoff_location }}
                                </p>
                            </div>
                            @endif
                            @if(!empty($detail->pickup_date))
                            <div class="col-md-3 mb-3">
                                <h3 class="details_heading">
                                    Pickup Date
                                </h3>
                            </div>
                            <div class="col-md-9 mb-3">
                                <p class="details_para">
                                   {{ $detail->pickup_date }}
                                </p>
                            </div>
                            @endif
                            @if(!empty($detail->pickup_time))
                            <div class="col-md-3 mb-3">
                                <h3 class="details_heading">
                                    Pickup Time
                                </h3>
                            </div>
                            <div class="col-md-9 mb-3">
                                <p class="details_para">
                                   {{ $detail->pickup_time }}
                                </p>
                            </div>
                            @endif
                            @if(!empty($detail->return_date))
                            <div class="col-md-3 mb-3">
                                <h3 class="details_heading">
                                    Return Date
                                </h3>
                            </div>
                            <div class="col-md-9 mb-3">
                                <p class="details_para">
                                   {{ $detail->return_date }}
                                </p>
                            </div>
                            @endif
                            @if(!empty($detail->return_time))
                            <div class="col-md-3 mb-3">
                                <h3 class="details_heading">
                                    Return Time
                                </h3>
                            </div>
                            <div class="col-md-9 mb-3">
                                <p class="details_para">
                                   {{ $detail->return_time }}
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Individual column searching (text inputs) Ends-->
        </div>
        <div class="row">
            <div class="col">
                <div>
                    <a class="btn btn-success" href="{{ route('enquiries') }}"
                        data-bs-original-title="" title="">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/rating/jquery.barrating.js') }}"></script>
    <script src="{{ asset('assets/js/rating/rating-script.js') }}"></script>
    <script src="{{ asset('assets/js/owlcarousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/ecommerce.js') }}"></script>
    <script src="{{ asset('assets/js/product-list-custom.js') }}"></script>
@endsection
