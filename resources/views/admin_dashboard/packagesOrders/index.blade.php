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
                        <h5>Packages Orders </h5>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">
                                <table  class="display dataTable no-footer" id="basic-1" role="grid"
                                    aria-describedby="basic-1_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc">S.NO</th>
                                            <th class="sorting">headind 1</th>
                                            <th class="sorting">heading 2</th>
                                            <th class="sorting">heading 3</th>
                                            <th class="sorting">heading 4</th>
                                            <th class="sorting"> heading 5 </th>
                                            <th class="sorting"> heading 6</th>
                                            <th class="sorting" style="width: 120.016px;">heading 7</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                            <tr role="row" class="odd">
                                                <td>
                                                    01
                                                 </td>
                                                <td>
                                                   data 1
                                                </td>
                                                <td>
                                                    data 2
                                                </td>
                                                <td>
                                                    data 3
                                                </td>
                                                <td>
                                                    data 4
                                                </td>
                                                <td>
                                                    data 5
                                                </td>

                                                <td>
                                                    data 6
                                                </td>

                                                <td  class="power_icon_data editDelete">

                                                   <button class="btn btn-success btn-xs" type="button">
                                                        Approve
                                                    </button>

                                                    <button class="btn btn-danger btn-xs" type="button">
                                                        Decline
                                                    </button>
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

    @endsection
