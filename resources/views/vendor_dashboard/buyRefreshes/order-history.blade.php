@extends('vendor_dashboard.layouts.master')
@section('content')
    <style>
        td.editDelete {
            display: flex;
            gap: 10px;
        }

        .productsetting {
            margin-left: 63%;
        }

        .productsetting a {
            padding: 10px;
        }

        .power_icon {
            padding: 5px 10px 5px 12px;
            background: #343A40;
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
        a.power_icon:hover {
            color: #fff;
        }

        .bg_orange {
            background-color: #FF581B !important;
        }

        .reload_icon {
            padding: 1px 3px;
            border-radius: 5px;
            font-size: 16px;
            background-color: #FF581B !important;

        }
        /* .power_icon_data{
                text-align: center;

            } */
    </style>


    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Order History </h5>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">
                                <table data-order='[[ 0, "desc" ]]' class="display dataTable no-footer" id="basic-1"
                                    role="grid" aria-describedby="basic-1_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                colspan="1" aria-sort="ascending">
                                                S.NO</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Package</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Price</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Item</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Quantity</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">To Account</th>            
                                            <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Receipt</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Status</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Purchase Date</th>    
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @forelse($userOrderHistory as $history)
                                                <tr role="row" class="odd">
                                                    <td>
                                                        {{$history->id}}
                                                    </td>
                                                    <td>
                                                        {{$history->packageItem->package->name}}
                                                    </td>
                                                    <td>
                                                        {{$history->packageItem->currency}} {{$history->packageItem->price}}
                                                    </td>
                                                    <td>
                                                        {{$history->packageItem->item}}
                                                    </td>
                                                    <td>
                                                        {{$history->packageItem->qty}}
                                                    </td>
                                                
                                                    <td>
                                                        {{$history->company_account_no}}
                                                    </td>
                                                    <td>
                                                        <img src="{{ asset('storage/' . $history->receipt) }}" alt="Receipt Image">
                                                    </td>
                                                    <td>
                                                        {{$history->status}}
                                                    </td>
                                                    <td>
                                                        {{ $history->created_at->format('d M Y') }}
                                                    </td>

                                                </tr>
                                            @empty
                                                <tr role="row" class="odd">
                                                    <td>
                                                        No Order History
                                                    </td>
                                                
                                                </tr>
                                            @endforelse

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
@endsection
