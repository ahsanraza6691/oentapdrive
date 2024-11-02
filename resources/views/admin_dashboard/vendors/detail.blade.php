@extends('admin_dashboard.layouts.master')
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
    <h3 class="welcome-dashboard-heading glitch glitch layers" data-text="Inquiry Details">Vendor Details</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Vendor</li>
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
                                <h4 class="details_heading">
                                   Name
                                </h4>
                            </div>
                            <div class="col-md-9 mb-3">
                                <p class="details_para">
                                  {{$detail->name}}
                                </p>
                            </div>
                            
                            
                            <div class="col-md-3 mb-3">
                                <h4 class="details_heading">
                                    Company Name
                                </h4>
                            </div>
                            <div class="col-md-9 mb-3">
                                <p class="details_para">
                                    {{ $detail->company_name }}
                                </p>
                            </div>

                            <div class="col-md-3 mb-3">
                                <h4 class="details_heading">
                                    Main Address
                                </h4>
                            </div>
                            <div class="col-md-9 mb-3">
                                <p class="details_para">
                                    {{ $detail->main_address }}
                                </p>
                            </div>
                            
                            
                            <div class="col-md-3 mb-3">
                                <h4 class="details_heading">
                                    Phone
                                </h4>
                            </div>
                            <div class="col-md-9 mb-3">
                                <p class="details_para">
                                    {{ $detail->contact }}
                                </p>
                            </div>
                            
                             <div class="col-md-3 mb-3">
                                <h4 class="details_heading">
                                    Email
                                </h4>
                            </div>
                            <div class="col-md-9 mb-3">
                                <p class="details_para">
                                    {{ $detail->email }}
                                </p>
                            </div>
                            <div class="col-md-3 mb-3">
                                <h4 class="details_heading">
                                    Job Title
                                </h4>
                            </div>
                            <div class="col-md-9 mb-3">
                                <p class="details_para">
                                    {{ $detail->job_title }}
                                </p>
                            </div>
                            <div class="col-md-3 mb-3">
                                <h4 class="details_heading">
                                    Country
                                </h4>
                            </div>
                            <div class="col-md-9 mb-3">
                                <p class="details_para">
                                    {{ $detail->country }}
                                </p>
                            </div>
                            <div class="col-md-3 mb-3">
                                <h4 class="details_heading">
                                    City
                                </h4>
                            </div>
                            <div class="col-md-9 mb-3">
                                <p class="details_para">
                                    {{ $detail->city }}
                                </p>
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <h4 class="details_heading">
                                   Fleet Size
                                </h4>
                            </div>
                            <div class="col-md-9 mb-3">
                                <p class="details_para">
                                   {{ $detail->fleet_size }}
                                </p>
                            </div>
                            <div class="col-md-3 mb-3">
                                <h4 class="details_heading">
                                   Whatsapp Leads
                                </h4>
                            </div>
                            <div class="col-md-9 mb-3">
                                <p class="details_para">
                                   {{ $whatsapp_leads }}
                                </p>
                            </div>

                            <div class="col-md-3 mb-3">
                                <h4 class="details_heading">
                                  Call Leads
                                </h4>
                            </div>
                            <div class="col-md-9 mb-3">
                                <p class="details_para">
                                   {{ $call_leads }}
                                </p>
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <h4 class="details_heading">
                                   Company License
                                </h4>
                            </div>
                            <div class="col-md-9 mb-3">
                                <p class="details_para">
                                    <a href="{{asset('company_license/'.$detail->company_license)}}" target="_blank"><img  src="{{asset('company_license/'.$detail->company_license)}}" width="100px" height="70px"></a>
                                </p>
                            </div>

                            <div class="col-md-3 mb-3">
                                <h4 class="details_heading">
                                   Company Logo
                                </h4>
                            </div>
                            <div class="col-md-9 mb-3">
                                <p class="details_para">
                                    <a href="{{asset('company_logo/'.$detail->company_logo)}}" target="_blank"><img  src="{{asset('company_logo/'.$detail->company_logo)}}" width="100px" height="70px"></a>
                                </p>
                            </div>
                            <div class="col-md-3 mb-3">
                                <h4 class="details_heading">
                                   Trade License
                                </h4>
                            </div>
                            <div class="col-md-9 mb-3">
                                <p class="details_para">
                                    <a href="{{asset('license/'.$detail->trade_license)}}" target="_blank"><img  src="{{asset('license/'.$detail->trade_license)}}" width="100px" height="70px"></a>
                                </p>
                            </div>
                            <div class="col-md-3 mb-3">
                                <h4 class="details_heading">
                                License Expiry
                                </h4>
                            </div>
                            <div class="col-md-9 mb-3">
                                <p class="details_para">
                                   {{ $detail->license_expiry_date }}
                                </p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- Individual column searching (text inputs) Ends-->
        </div>
        <div class="row">
            <div class="col">
                <div>
                    <a class="btn btn-success" href="{{ route('vendor-index') }}"
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
