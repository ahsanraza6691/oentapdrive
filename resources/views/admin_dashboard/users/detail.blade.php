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
    <h3 class="welcome-dashboard-heading glitch glitch layers" data-text="Inquiry Details">User Details</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">User</li>
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
                        <div class="table-responsive product-table">
                            <table class="display" id="basic-1">
                                <thead>

                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $detail->name }}</td>
                                    </tr>
                                    {{-- <tr>
                                        <th>Comapny Name</th>
                                        <td>{{ $detail->company_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Job Title</th>
                                        <td>{{ $detail->company_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Fleet Size</th>
                                        <td>{{ $detail->fleet_size }}</td>
                                    </tr> --}}
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $detail->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Contact</th>
                                        <td>{{ $detail->contact }}</td>
                                    {{-- </tr> <tr>
                                        <th>Country</th>
                                        <td>{{ $detail->country }}</td>
                                    </tr>
                                    </tr> <tr>
                                        <th>City</th>
                                        <td>{{ $detail->city }}</td>
                                    </tr> --}}
                                    </tr>
                                    {{-- <tr>
                                        <th>Company License</th>
                                        <td><img src="{{asset('company_license/'.$detail->company_license)}}"></td>
                                    </tr>
                                    <tr>
                                        <th>Company Logo</th>
                                        <td><img src="{{asset('company_logo/'.$detail->company_logo)}}"></td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Individual column searching (text inputs) Ends-->
        </div>
        <div class="row">
            <div class="col">
                <div>
                    <a class="btn btn-success" href="{{ route('users-index') }}"
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
