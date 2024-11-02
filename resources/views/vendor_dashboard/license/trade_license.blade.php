@extends('vendor_dashboard.layouts.master')
@section('content')
    <style>
        td.editDelete {
            display: flex;
            gap: 10px;
        }
        .form-group.row{
            margin-bottom: 20px;
        }
    </style>
    <div class="container"> 
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Trade Licence</h5>


                    </div>
                    <div class="card-body">
                        <form action="{{route('upload-license')}}"  method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row align-items-center">
                                <label for="trade_licence" class="col-sm-4 col-form-label">Upload Trade Licence :</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" id="trade_licence" name="trade_licence" accept="image/*" required>
                                    @if(!empty(Auth::user()->trade_license))
                            <div class="mt-3">
                                <a href="{{asset('license/'.Auth::user()->trade_license)}}" target="_blank" ><img src="{{asset('license/'.Auth::user()->trade_license)}}" width="100px" height="70px" ></a>
                            </div>
                            @endif
                                </div>
                            </div>
                            

                            <div class="form-group row">
                                <label for="licence_expiry" class="col-sm-4 col-form-label">Licence Expiry Date :</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" id="licence_expiry" name="licence_expiry_date" value="{{Auth::user()->license_expiry_date}}">
                                    @if(!empty(Auth::user()->license_expiry_date))
                                    <div class="mt-3">
                                       {{Auth::user()->license_expiry_date}}
                                    </div>
                                    @endif
                                </div>
                            </div>

                         

                            <div class="row mt-5 justify-content-end">
                                <div class="col-8">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Individual column searching (text inputs) Ends-->
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>.

@endsection
