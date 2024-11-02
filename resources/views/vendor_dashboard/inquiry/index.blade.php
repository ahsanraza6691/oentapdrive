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
                        <h5>Contact Information </h5>


                    </div>
                    <div class="card-body ">
                        <h6>Account Details</h6>
                        <form action="{{route('update-account')}}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" readonly class="form-control" id="email"
                                        value="{{Auth::user()->email}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="whatsapp_num" class="col-sm-2 col-form-label">Whatsapp No:</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="whatsapp_number" id="whatsapp_num" placeholder="Enter Whatsapp Number..." value="{{Auth::user()->whatsapp_number}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="main_address" class="col-sm-2 col-form-label">Main address:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="main_address" id="main_address" value="{{Auth::user()->main_address}}" placeholder="Enter Main Address..." required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone_num" class="col-sm-2 col-form-label">Phone No:</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="phone_number" id="phone_num" value="{{Auth::user()->phone_number}}" placeholder="Enter Phone Number..." required>
                                </div>
                            </div>
                            <div class="row mt-5 justify-content-end">
                                <div class="col-10">
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


    <script>
        $(document).ready(function() {

            toastr.options = {
                'closeButton': true,
                'debug': false,
                'newestOnTop': false,
                'progressBar': false,
                'positionClass': 'toast-top-right',
                'preventDuplicates': false,
                'showDuration': '1000',
                'hideDuration': '1000',
                'timeOut': '5000',
                'extendedTimeOut': '1000',
                'showEasing': 'swing',
                'hideEasing': 'linear',
                'showMethod': 'fadeIn',
                'hideMethod': 'fadeOut',
            }

            $(".deleteinquiry").on("click", function() {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "{{ route('delete-contact', 'id') }}",
                    data: {
                        "id": id,
                        "_token": "{{ csrf_token() }}"
                    },
                    type: 'GET',
                    success: function(result) {
                        toastr.success('Inquiry Deleted Sucessfully');
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                });
            });
        })
    </script>



    {{-- @if (Session::has('Update_Faqs'))
    <script>
        toastr.success('Faqs Updated', '{{ Session::get('Update_Faqs') }}', 'success')
    </script>
@endif --}}
@endsection
