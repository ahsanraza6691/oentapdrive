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
                        <h5>Coupon List </h5>
                        <div class=""><a class="btn btn-gradient" data-bs-original-title="" title=""
                                         href="{{ route('coupon.create') }}">Add</a></div>

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
                                            aria-label="Details: activate to sort column ascending">Coupon Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="basic-1"
                                            aria-label="Details: activate to sort column ascending">Coupon  Amount</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1"
                                            aria-label="Details: activate to sort column ascending">Percentage</th>
                                        <th class="sorting" tabindex="0" aria-controls="basic-1"
                                            aria-label="Details: activate to sort column ascending">Coupon  Type</th>
                                        <th class="sorting" tabindex="0" aria-controls="basic-1"
                                            aria-label="Details: activate to sort column ascending">Expiry Date</th>
                                        <th class="sorting" tabindex="0" aria-controls="basic-1"
                                            aria-label="Details: activate to sort column ascending">Usage/Limit</th>
                                        <th class="sorting" tabindex="0" aria-controls="basic-1"
                                            aria-label="Details: activate to sort column ascending"> Status</th>
                                        <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                            colspan="1" aria-label="Action: activate to sort column ascending"
                                            style="width: 120.016px;">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($coupons as $value)
                                        <tr role="row" class="odd">
                                            <td>
                                                {{ $value->id ?? null }}
                                            </td>
                                            <td>
                                                {{ $value->coupon_code ?? null }}
                                            </td>
                                            <td>
                                                RM{{ $value->coupon_amount ?? 0 }}
                                            </td>
                                            <td>
                                                {{ $value->percentage ?? 0 }}%
                                            </td>
                                            <td>
                                                @if($value->discount_type == 1)
                                                    Fixed Cart Discount
                                                @endif
                                                {{-- @if ($value->discount_type == 2)
                                                Percentage Discount
                                                @endif --}}
                                                @if ($value->discount_type == 2)
                                                    Fixed Product Discount
                                                @endif
                                            </td>
                                            <td>
                                                {{ $value->expiry_date ?? null }}
                                            </td>
                                            <td>
                                                0/{{ $value->usage_limit_per_coupon ?? null }}
                                            </td>
                                            <td>
                          <a href="{{ route('coupon-status', $value->id) }}">
                                                    @if ($value->status == 1)
                                                        <button class="btn btn-info btn-sm" id="status"><i
                                                                    class="fa fa-thumbs-up"></i></button>
                                                    @else
   <button class="btn btn-danger btn-sm" id="status"><i class="fa fa-thumbs-down"></i></button>
                                                    @endif
                                                </a>
                                            </td>
                                            <td class="editDelete">
                                                <form action="{{ route("coupon.destroy", $value->id) }}" method="post">

                                                    @method("DELETE")

                                                    @csrf
                                                    <a href="#">
                                                        <button class="btn btn-danger btn-xs" type="submit"
                                                                data-original-title="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete coupon ?');" >Delete</button></a>
                                                </form>

                                                {{-- <a href="{{ route('coupon.edit', $value->id) }}"> <button
                                                        class="btn btn-success btn-xs" type="button"
                                                        data-original-title="btn btn-danger btn-xs" title=""
                                                        data-bs-original-title="">Edit</button></a> --}}
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
