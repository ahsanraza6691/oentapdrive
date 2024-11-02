@extends('admin_dashboard.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-xl-12 p-0 left-btn"><a class="btn btn-gradient" data-bs-original-title="" title=""
                                href="{{ route('social.create') }}">Create</a></div>

                        <h5>Social List </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">
                                <div class="dataTables_length" id="basic-1_length"><label>Show <select name="basic-1_length"
                                            aria-controls="basic-1" class="">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select> entries</label></div>
                                <div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="search"
                                            class="" placeholder="" aria-controls="basic-1" data-bs-original-title=""
                                            title=""></label></div>
                                <table class="display dataTable no-footer" id="basic-1" role="grid"
                                    aria-describedby="basic-1_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                colspan="1" aria-sort="ascending">
                                                S.NO</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Facebook</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Twitter</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Instagram</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending"> Linkedin</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                colspan="1" aria-label="Action: activate to sort column ascending"
                                                style="width: 120.016px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($social as $value)
                                            <tr role="row" class="odd">
                                                <td>
                                                    {{ $value->id ?? null }}
                                                </td>
                                                <td>
                                                    {{ $value->facebook ?? null }}
                                                </td>

                                                <td>
                                                    {!! $value->twitter ?? null !!}
                                                </td>
                                                <td>
                                                    {{ $value->instagram ?? null }}
                                                </td>
                                                <td>
                                                    {{ $value->linkedin ?? null }}
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0);" class="deletesocial"
                                                        data-id="{{ $value->id }}">
                                                        <button class="btn btn-danger btn-xs" type="submit"
                                                            data-original-title="btn btn-danger btn-xs">Delete</button></a>

                                                    <a href="{{ route('social.edit', $value->id) }}"> <button
                                                            class="btn btn-success btn-xs" type="button"
                                                            data-original-title="btn btn-danger btn-xs" title=""
                                                            data-bs-original-title="">Edit</button></a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="dataTables_info" id="basic-1_info" role="status" aria-live="polite">Showing 1
                                    to
                                    10 of 10 entries</div>
                                <div class="dataTables_paginate paging_simple_numbers" id="basic-1_paginate"><a
                                        class="paginate_button previous disabled" aria-controls="basic-1" data-dt-idx="0"
                                        tabindex="0" id="basic-1_previous" data-bs-original-title=""
                                        title="">Previous</a><span><a class="paginate_button current"
                                            aria-controls="basic-1" data-dt-idx="1" tabindex="0" data-bs-original-title=""
                                            title="">1</a></span><a class="paginate_button next disabled"
                                        aria-controls="basic-1" data-dt-idx="2" tabindex="0" id="basic-1_next"
                                        data-bs-original-title="" title="">Next</a></div>
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

                $(".deletesocial").on("click", function() {
                    var id = $(this).attr("data-id");
                    $.ajax({
                        url: "{{route('social.destroy',"id")}}",
                        data: {
                            "id": id,
                            "_token": "{{ csrf_token() }}"
                        },
                        type: 'DELETE',
                        success: function(result) {
                            toastr.success('Social Link  Delete Sucessfully');
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
