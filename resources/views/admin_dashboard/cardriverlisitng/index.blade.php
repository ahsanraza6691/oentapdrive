@extends('admin_dashboard.layouts.master')
@section('content')
<style>
    td.editDelete {
    display: flex;
    gap: 10px;
}
.productsetting{
    margin-left: 63%;
}
.productsetting a {
    padding: 10px;
}
.power_icon {
            padding: 10px 10px 10px 12px;
            background: #51bb25;
            color: #fff;
            border-radius: 5px;
            font-size: 16px;
        }
        .power_icon_red {
            padding: 10px 10px 10px 12px;
            background: red;
            color: #fff;
            border-radius: 5px;
            font-size: 16px;
        }
        a.power_icon_red:hover,
        a.power_icon:hover{
            color: #fff;
        }
</style>




    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Cars Listing </h5>
                        {{-- <div class="productsetting"><a class="btn btn-gradient" data-bs-original-title="" title=""
                            href="{{ route('product-setting') }}">Product Setting</a></div> --}}
                        {{-- <div class=""><a class="btn btn-gradient" data-bs-original-title="" title=""
                                href="{{ route('product.create') }}">Add</a></div> --}}

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
                                                aria-label="Details: activate to sort column ascending">Car Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Company Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Service Tpe</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending"> Status</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                colspan="1" aria-label="Action: activate to sort column ascending"
                                                style="width: 120.016px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $value)
                                            <tr role="row" class="odd">
                                                <td>
                                                    {{ $loop->iteration ?? null }}
                                                </td>
                                                <td>
                                                    {{ $value->brand_name . ' ' . $value->model_name . ' ' . $value->make_year ?? null }}
                                                </td>
                                                <td>
                                                    {{ $value->get_user->company_name ?? null }}
                                                </td>
                                                <td>
                                                    {{$value->service_type}}
                                                </td>
                                                <td>
                                                    @if ($value->status == 1)
                                                    Active
                                                    @else
                                                    In Active
                                                    @endif
                                                </td>

                                                <td  class="power_icon_data editDelete">

                                                    @if ($value->status == 1)
                                                    <a href="{{ route('car-driver-status', $value->id) }}" class="power_icon">
                                                        <i class="fa fa-power-off" aria-hidden="true"></i>
                                                    </a>
                                                    @else
                                                    <a href="{{ route('car-driver-status', $value->id) }}" class="power_icon_red">
                                                        <i class="fa fa-power-off" aria-hidden="true"></i>
                                                    </a>
                                                    @endif
                                                {{-- </td>
                                                <td class="editDelete"> --}}
                                                    <form action="#"
                                                        method="GET">



                                                        @csrf
                                                        <a href="#">
                                                            <button class="btn btn-danger btn-xs" type="submit"
                                                                data-original-title="btn btn-danger btn-xs"
                                                                onclick="return confirm('Are you sure you want to delete product ?');">Delete</button></a>
                                                    </form>

                                                    <a href="{{ route('car-with-driver-listing-details', ['id' => $value->id]) }}"> <button
                                                            class="btn btn-success btn-xs" type="button"
                                                            data-original-title="btn btn-danger btn-xs" title=""
                                                            data-bs-original-title="">View</button></a>
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

    @push('scripts')
    @if (session()->has('product_added'))
    <script> toastr.success("{{ session()->get('product_added') }}") </script>
    @endif

    @endpush

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

                $(".deleteproduct").on("click", function() {
                    var id = $(this).attr("data-id");
                    $.ajax({
                        url: "{{route('product.destroy',"id")}}",
                        data: {
                            "id": id,
                            "_token": "{{ csrf_token() }}"
                        },
                        type: 'DELETE',
                        success: function(result) {
                            toastr.success('Product Deleted Sucessfully');
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                    });
                });
            })
        </script>





    @endsection
