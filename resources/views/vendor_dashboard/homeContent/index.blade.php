@extends('admin_dashboard.layouts.master')


@section('content')

<div class="container-fluid">
    <div class="row">
        <!-- Individual column searching (text inputs) Starts-->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-xl-12 p-0 left-btn"><a class="btn btn-gradient" data-bs-original-title="" title="" href="{{route('create_content')}}" target="_blank">Create</a></div>

                    <h5>Individual column searching (text inputs) </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive product-table">
                        <div id="basic-1_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="basic-1_length"><label>Show <select name="basic-1_length" aria-controls="basic-1" class=""><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div><div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="search" class="" placeholder="" aria-controls="basic-1" data-bs-original-title="" title=""></label></div><table class="display dataTable no-footer" id="basic-1" role="grid" aria-describedby="basic-1_info">
                            <thead>
                                <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Image: activate to sort column descending" style="width: 46px;">Image</th><th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1" aria-label="Details: activate to sort column ascending" style="width: 407.703px;">Details</th><th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1" aria-label="Amount: activate to sort column ascending" style="width: 55.8906px;">Amount</th><th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1" aria-label="Stock: activate to sort column ascending" style="width: 57.9688px;">Stock</th><th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 68.4219px;">Start date</th><th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 120.016px;">Action</th></tr>
                            </thead>
                            <tbody>

                                <tr role="row" class="odd">
                                    <td class="sorting_1"><img src="http://localhost/Laravel/Cuba/public/assets/images/ecommerce/product-table-1.png" alt=""></td>
                                    <td>
                                        <h6> Red Lipstick </h6>
                                        <span>Interchargebla lens Digital Camera with APS-C-X Trans CMOS Sens</span>
                                    </td>
                                    <td>$10</td>
                                    <td class="font-success">In Stock</td>
                                    <td>2011/04/25</td>
                                    <td>
                                        <button class="btn btn-danger btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" data-bs-original-title="">Delete</button>
                                        <button class="btn btn-success btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" data-bs-original-title="">Edit</button>
                                    </td>
                                </tr><tr role="row" class="even">
                                    <td class="sorting_1"><img src="http://localhost/Laravel/Cuba/public/assets/images/ecommerce/product-table-2.png" alt=""></td>
                                    <td>
                                        <h6> Pink Lipstick </h6>
                                        <p>Interchargebla lens Digital Camera with APS-C-X Trans CMOS Sens</p>
                                    </td>
                                    <td>$10</td>
                                    <td class="font-primary">Low Stock</td>
                                    <td>2011/04/25</td>
                                    <td>
                                        <button class="btn btn-danger btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" data-bs-original-title="">Delete</button>
                                        <button class="btn btn-success btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" data-bs-original-title="">Edit</button>
                                    </td>
                                </tr><tr role="row" class="odd">
                                    <td class="sorting_1"><img src="http://localhost/Laravel/Cuba/public/assets/images/ecommerce/product-table-3.png" alt=""></td>
                                    <td>
                                        <h6> Gray Lipstick </h6>
                                        <p>Interchargebla lens Digital Camera with APS-C-X Trans CMOS Sens</p>
                                    </td>
                                    <td>$10</td>
                                    <td class="font-danger">out of stock</td>
                                    <td>2011/04/25</td>
                                    <td>
                                        <button class="btn btn-danger btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" data-bs-original-title="">Delete</button>
                                        <button class="btn btn-success btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" data-bs-original-title="">Edit</button>
                                    </td>
                                </tr><tr role="row" class="even">
                                    <td class="sorting_1"><img src="http://localhost/Laravel/Cuba/public/assets/images/ecommerce/product-table-4.png" alt=""></td>
                                    <td>
                                        <h6> Green Lipstick </h6>
                                        <p>Interchargebla lens Digital Camera with APS-C-X Trans CMOS Sens</p>
                                    </td>
                                    <td>$10</td>
                                    <td class="font-primary">Low Stock</td>
                                    <td>2011/04/25</td>
                                    <td>
                                        <button class="btn btn-danger btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" data-bs-original-title="">Delete</button>
                                        <button class="btn btn-success btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" data-bs-original-title="">Edit</button>
                                    </td>
                                </tr><tr role="row" class="odd">
                                    <td class="sorting_1"><img src="http://localhost/Laravel/Cuba/public/assets/images/ecommerce/product-table-5.png" alt=""></td>
                                    <td>
                                        <h6> Black Lipstick </h6>
                                        <p>Interchargebla lens Digital Camera with APS-C-X Trans CMOS Sens</p>
                                    </td>
                                    <td>$10</td>
                                    <td class="font-success">In Stock</td>
                                    <td>2011/04/25</td>
                                    <td>
                                        <button class="btn btn-danger btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" data-bs-original-title="">Delete</button>
                                        <button class="btn btn-success btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" data-bs-original-title="">Edit</button>
                                    </td>
                                </tr><tr role="row" class="even">
                                    <td class="sorting_1"><img src="http://localhost/Laravel/Cuba/public/assets/images/ecommerce/product-table-6.png" alt=""></td>
                                    <td>
                                        <h6> White Lipstick </h6>
                                        <p>Interchargebla lens Digital Camera with APS-C-X Trans CMOS Sens</p>
                                    </td>
                                    <td>$10</td>
                                    <td class="font-primary">Low Stock</td>
                                    <td>2011/04/25</td>
                                    <td>
                                        <button class="btn btn-danger btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" data-bs-original-title="">Delete</button>
                                        <button class="btn btn-success btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" data-bs-original-title="">Edit</button>
                                    </td>
                                </tr><tr role="row" class="odd">
                                    <td class="sorting_1"><img src="http://localhost/Laravel/Cuba/public/assets/images/ecommerce/product-table-1.png" alt=""></td>
                                    <td>
                                        <h6> light Lipstick </h6>
                                        <p>Interchargebla lens Digital Camera with APS-C-X Trans CMOS Sens</p>
                                    </td>
                                    <td>$10</td>
                                    <td class="font-danger">out of stock</td>
                                    <td>2011/04/25</td>
                                    <td>
                                        <button class="btn btn-danger btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" data-bs-original-title="">Delete</button>
                                        <button class="btn btn-success btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" data-bs-original-title="">Edit</button>
                                    </td>
                                </tr><tr role="row" class="even">
                                    <td class="sorting_1"><img src="http://localhost/Laravel/Cuba/public/assets/images/ecommerce/product-table-2.png" alt=""></td>
                                    <td>
                                        <h6> Gliter Lipstick </h6>
                                        <p>Interchargebla lens Digital Camera with APS-C-X Trans CMOS Sens</p>
                                    </td>
                                    <td>$10</td>
                                    <td class="font-danger">out of stock</td>
                                    <td>2011/04/25</td>
                                    <td>
                                        <button class="btn btn-danger btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" data-bs-original-title="">Delete</button>
                                        <button class="btn btn-success btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" data-bs-original-title="">Edit</button>
                                    </td>
                                </tr><tr role="row" class="odd">
                                    <td class="sorting_1"><img src="http://localhost/Laravel/Cuba/public/assets/images/ecommerce/product-table-3.png" alt=""></td>
                                    <td>
                                        <h6> green Lipstick </h6>
                                        <p>Interchargebla lens Digital Camera with APS-C-X Trans CMOS Sens</p>
                                    </td>
                                    <td>$10</td>
                                    <td class="font-success">In Stock</td>
                                    <td>2011/04/25</td>
                                    <td>
                                        <button class="btn btn-danger btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" data-bs-original-title="">Delete</button>
                                        <button class="btn btn-success btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" data-bs-original-title="">Edit</button>
                                    </td>
                                </tr><tr role="row" class="even">
                                    <td class="sorting_1"><img src="http://localhost/Laravel/Cuba/public/assets/images/ecommerce/product-table-4.png" alt=""></td>
                                    <td>
                                        <h6> Yellow Lipstick </h6>
                                        <p>Interchargebla lens Digital Camera with APS-C-X Trans CMOS Sens</p>
                                    </td>
                                    <td>$10</td>
                                    <td class="font-danger">out of stock</td>
                                    <td>2011/04/25</td>
                                    <td>
                                        <button class="btn btn-danger btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" data-bs-original-title="">Delete</button>
                                        <button class="btn btn-success btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" data-bs-original-title="">Edit</button>
                                    </td>
                                </tr></tbody>
                            </table><div class="dataTables_info" id="basic-1_info" role="status" aria-live="polite">Showing 1 to 10 of 10 entries</div><div class="dataTables_paginate paging_simple_numbers" id="basic-1_paginate"><a class="paginate_button previous disabled" aria-controls="basic-1" data-dt-idx="0" tabindex="0" id="basic-1_previous" data-bs-original-title="" title="">Previous</a><span><a class="paginate_button current" aria-controls="basic-1" data-dt-idx="1" tabindex="0" data-bs-original-title="" title="">1</a></span><a class="paginate_button next disabled" aria-controls="basic-1" data-dt-idx="2" tabindex="0" id="basic-1_next" data-bs-original-title="" title="">Next</a></div></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Individual column searching (text inputs) Ends-->
        </div>
    </div>


@endsection
