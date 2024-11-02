@extends('admin_dashboard.layouts.master')
@section('content')
<style>
    .badge-success{
        color: #55b054 !important;
        background-color: #ffffff !important;
    }
</style>

{{-- <div id="order_id"></div> --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Order Management </h5>
                        <div class="my-4"></div>

                    </div>
                    {{-- update work 19 --}}
                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">
                                <table  data-order='[[ 0, "desc" ]]'  class="display dataTable no-footer" id="basic-1" role="grid"
                                    aria-describedby="basic-1_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                colspan="1" aria-sort="ascending">
                                                ORDER ID</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">First Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Last Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                               aria-label="Details: activate to sort column ascending">Order Date</th>
                                                {{-- <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Total</th> --}}
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending"> Order Status</th>
                                                {{-- update work 17 --}}
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">User Status</th>
                                                {{-- <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Billing To</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Shipping To</th> --}}
                                            <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                colspan="1" aria-label="Action: activate to sort column ascending"
                                                style="width: 120.016px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr role="row" class="odd">
                                                <td>
                                                    {{ $order->id }}
                                                </td>
                                                <td>
                                                    {{ $order->user->first_name ?? 'N/A' }}
                                                </td>
                                                <td>
                                                    {{ $order->user->last_name ?? 'N/A' }}
                                                </td>
                                                <td>
                                                    {{ $order->created_at }}
                                                </td>
                                                {{-- <td>
                                                    ${{ $order->total_price + $order->delivery_fee }}
                                                </td> --}}
                                                <td>
                                                {{-- update work 1 --}}
                                                    {{-- @if($order->order_status == 1)
                                                    <span class="span badge rounded-pill pill-badge-warning">Pending</span>
                                                    @endif --}}
                                                    {{-- update work 1 --}}
                                                    @if($order->order_status == 2)
                                                    <span class="span badge rounded-pill pill-badge-primary">Dispatched</span>
                                                    @endif
                                                    @if($order->order_status == 3 && $order->check_cancel_status != 2)
                                                    <span class="span badge rounded-pill pill-badge-success">Delivered</span>
                                                    @endif
                                                    @if($order->order_status == 4)
                                                    <span class="span badge rounded-pill pill-badge-danger">Cancelled</span>
                                                    @endif
                                                    {{-- update work 19 --}}
                                                    @if($order->order_status == 5)
                                                    <span class="span badge rounded-pill pill-badge-info">On Hold</span>
                                                    @endif
                                                        {{-- update work 16 --}}
                                                    @if(($order->order_status != 1 && $order->order_status != 2) && $order->order_status != 3 && $order->order_status != 4
                                                     && $order->order_status != 5 && $order->order_status != 6 && $order->order_status != 7 && $order->order_status != 8 && $order->order_status != 9 && $order->order_status != 10)
                                                     N/A
                                                    @endif

                                                    @if($order->order_status == 6)
                                                        <span class="span badge rounded-pill pill-badge-warning">Pending</span>
                                                    @endif
                                                    {{-- update work 1 --}}
                                                    @if($order->check_cancel_status == 1 && $order->order_status == 1)
                                                    <span class="span badge rounded-pill pill-badge-info">Requested for cancellation</span>
                                                    @elseif($order->check_cancel_status != 1 && $order->order_status == 1 )
                                                    <span class="span badge rounded-pill pill-badge-warning">Pending</span>
                                                    @endif
                                                     @if($order->check_cancel_status == 2 && $order->order_status == 3)
                                                        <span class="span badge rounded-pill pill-badge-danger">Requested for Refund</span>
                                                     @endif
                                                    {{-- @if($order->check_cancel_status != 3 && $order->order_status == 3)
                                                     <span class="span badge rounded-pill pill-badge-warning">Pending</span>
                                                    @endif --}}
                                                    {{-- update work 1 --}}
                                                    {{-- update work home --}}
                                                      @if($order->order_status == 9)
                                                        <span class="span badge rounded-pill pill-badge-warning">Pending</span>
                                                     @endif

                                                     @if($order->order_status == 10)
                                                        <span class="span badge rounded-pill pill-badge-warning">Pending</span>
                                                    @endif

                                                    @if(($order->order_status != 1 && $order->order_status != 2) &&
                                                    $order->order_status != 3 && $order->order_status != 4 &&
                                                    $order->order_status != 5 && $order->order_status != 6 && $order->order_status != 7 && $order->order_status != 8 && $order->order_status != 9 && $order->order_status != 10)
                                                    N/A
                                                    @endif

                                                </td>
                                                <td>
                                                    @if($order->order_verification == 1)
                                                    <span class="span badge rounded-pill pill-badge-success badge-success"><img src="{{ asset('icons/verified.png') }}" alt="verified" width="16px"> Received</span>
                                                    @else
                                                    <span class="span badge rounded-pill pill-badge-danger">Unreceived</span>
                                                    @endif
                                                </td>
                                                {{-- <td>
                                                    @if (!empty($order->billing_address->address))

                                                    {{ Str::limit($order->billing_address->address, 11, '...') }}
                                                    @else
                                                    N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (!empty($order->shipping_address->address))
                                                    {{ Str::limit($order->shipping_address->address, 11, '...') }}
                                                    @else
                                                    N/A
                                                    @endif
                                                </td> --}}
                                                <td>
                                                    <a href="{{ route('orderManagement.show',$order->id) }}"><i class="icon-eye"></i></a>
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



{{-- @if (Session::has('Update_Faqs'))
    <script>
        toastr.success('Faqs Updated', '{{ Session::get('Update_Faqs') }}', 'success')
    </script>
@endif --}}

    @endsection
