@extends('admin_dashboard.layouts.master')
@section('content')
    <style>
        td.editDelete {
            display: flex;
            gap: 10px;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Company Car Refreshes List </h5>
                        <div class=""><a class="btn btn-gradient" data-bs-original-title="" title=""
                                         href="{{ route('add-refreshes') }}">Add</a></div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">
                                <table data-order='[[ 0, "desc" ]]' class="display dataTable no-footer" id="basic-1" role="grid"
                                       aria-describedby="basic-1_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1"
                                            colspan="1" aria-sort="ascending">
                                            S.NO</th>
                                        <th class="sorting" tabindex="0" aria-controls="basic-1"
                                            aria-label="Details: activate to sort column ascending">Company Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="basic-1"
                                            aria-label="Details: activate to sort column ascending">Active Car Lisitng</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1"
                                            aria-label="Details: activate to sort column ascending">Total Cars Listing</th>
                                        <th class="sorting" tabindex="0" aria-controls="basic-1"
                                            aria-label="Details: activate to sort column ascending">Total Refreshes</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1"
                                            aria-label="Details: activate to sort column ascending">Used Refreshes</th>
                                        <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                            colspan="1" aria-label="Action: activate to sort column ascending"
                                            style="width: 120.016px;">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($users as $value)
                                        <tr role="row" class="odd">
                                            <td>
                                               {{$loop->iteration}}
                                            </td>
                                            <td>
                                                {{ $value->company_name ?? null }}
                                            </td>

                                            @php
                                                $count_active =  \App\Models\BackendModels\Product::where('user_id', $value->id)->where('status',1)->count();
                                            @endphp
                                            <td>
                                                {{ $count_active?? 0 }}
                                            </td>

                                            @php
                                                $total_count =  \App\Models\BackendModels\Product::where('user_id', $value->id)->count();
                                            @endphp
                                            <td>
                                                {{ $total_count }}
                                            </td>
                                            <td>
                                                {{$value->refresh_cars}}
                                            </td>

                                            <td>
                                                {{$value->used_refreshes}}
                                            </td>

                                            <td class="editDelete">
                                                {{-- <form action="{{ route("coupon.destroy", $value->id) }}" method="post">

                                                    @method("DELETE")

                                                    @csrf
                                                    <a href="#">
                                                        <button class="btn btn-danger btn-xs" type="submit"
                                                                data-original-title="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete coupon ?');" >Delete</button></a>
                                                </form> --}}

                                                <a href="{{ route('refreshes-edit', $value->id) }}"> <button
                                                        class="btn btn-success btn-xs" type="button"
                                                        data-original-title="btn btn-danger btn-xs" title=""
                                                        data-bs-original-title="">Edit</button></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
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

            $(".deletebrand").on("click", function() {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "{{route('brand.destroy',"id")}}",
                    data: {
                        "id": id,
                        "_token": "{{ csrf_token() }}"
                    },
                    type: 'DELETE',
                    success: function(result) {
                        toastr.success('Brand Deleted Sucessfully');
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                });
            });
        })
    </script>
@endsection
