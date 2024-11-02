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
                                                aria-label="Details: activate to sort column ascending">Package Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Status</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending"> Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr role="row" class="odd">
                                                <td>
                                                    1
                                                </td>
                                                <td>
                                                    Standard Package
                                                </td>
                                                <td>
                                                    Pending
                                                </td>
                                                <td>
                                                    03/11/2024
                                                </td>

                                            </tr>

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
