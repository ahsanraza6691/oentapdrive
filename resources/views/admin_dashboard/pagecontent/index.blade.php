@extends('admin_dashboard.layouts.master')
<style>

/* Automatic Serial Number Row */
.css-serial {
 counter-reset: serial-number; /* Set the serial number counter to 0 */
}
.css-serial td:first-child:before {
 counter-increment: serial-number; /* Increment the serial number counter */
 content: counter(serial-number); /* Display the counter */
}
</style>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Page Content List </h5>
                        {{-- <div class=""><a class="btn btn-gradient" data-bs-original-title="" title=""
                                href="{{ route('page-content.create') }}">Create</a></div> --}}

                    </div>
                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">
                                <table class="display dataTable no-footer css-serial" id="basic-1" role="grid"
                                    aria-describedby="basic-1_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                colspan="1" aria-sort="ascending">
                                                S.NO</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending"> Page name</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Section name</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending"> Title</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending"> Image</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                colspan="1" aria-label="Action: activate to sort column ascending"
                                                style="width: 120.016px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cms as $value)
                                            <tr role="row" class="odd">
                                                <td>
                                                    &nbsp;
                                                </td>
                                                <td>
                                                    {{ $value->get_page->page_name ?? null }}
                                                </td>
                                                <td>
                                                    {{ $value->section_name ?? null }}
                                                </td>
                                                <td>
                                                    {{ Str::limit($value->title1,20) ?? null }}
                                                </td>
                                                <td>
                                                    <img src="{{ url('public/content/' . $value->image) }}"
                                                        alt="" height="100" width="100" style="object-fit:cover;">
                                                </td>

                                                <td>
                                                    {{-- <a href="javascript:void(0);" class="deletecontent"
                                                        data-id="{{ $value->id }}">
                                                        <button class="btn btn-danger btn-xs" type="submit"
                                                            data-original-title="btn btn-danger btn-xs">Delete</button></a> --}}

                                                    <a href="{{ route('page-content.edit', $value->id) }}"> <button
                                                            class="btn btn-success btn-xs" type="button"
                                                            data-original-title="btn btn-danger btn-xs" title=""
                                                            data-bs-original-title="">Edit</button></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                            @foreach ($privacy as $value )
                                                <tr role="row" class="odd">
                                                    <td>
                                                         &nbsp;
                                                    </td>
                                                    <td>
                                                        Privacy Policy
                                                    </td>
                                                    <td>Privacy Policy</td>
                                                    <td>
                                                        {{ Str::limit($value->title,20) ?? null }}
                                                    </td>
                                                    <td></td>
                                                    <td><a href="{{ route('privacy-policy.edit', $value->id) }}"> <button
                                                        class="btn btn-success btn-xs" type="button"
                                                        data-original-title="btn btn-danger btn-xs" title=""
                                                        data-bs-original-title="">Edit</button></a></td>
                                                </tr>
                                            @endforeach
                                            @foreach ($terms as $value )
                                            <tr role="row" class="odd">
                                                <td>
                                                     &nbsp;
                                                </td>
                                                <td>
                                                   Terms & Conditions
                                                </td>
                                                <td> Terms & Conditions</td>
                                                <td>
                                                    {{ Str::limit($value->title,20) ?? null }}
                                                </td>
                                                <td></td>
                                                <td><a href="{{ route('terms-conditions.edit', $value->id) }}"> <button
                                                    class="btn btn-success btn-xs" type="button"
                                                    data-original-title="btn btn-danger btn-xs" title=""
                                                    data-bs-original-title="">Edit</button></a></td>
                                            </tr>
                                        @endforeach
                                        @foreach ($offers as $value )
                                            <tr role="row" class="odd">
                                                <td>
                                                   &nbsp;
                                                </td>
                                                <td>
                                                    {{ $value->get_page->page_name ?? null }}
                                                </td>
                                                <td>  {{$value->section_name}}</td>
                                                <td>
                                                    {{ Str::limit($value->title,20) ?? null }}
                                                </td>
                                                <td class="d-flex">
                                                    <div class="" style="width:150px; height:100px;margin:0px 6px;">
                                                        <img src="{{ url('public/offers/' . $value->image1) }}"
                                                            alt="" height="100" width="100"
                                                            style="object-fit:cover;">
                                                    </div>

                                                </td>
                                                {{-- <td><div class="" style="width:150px; height:100px;margin:0px 6px;">
                                                    <img src="{{ url('public/offers/' . $value->image2) }}"
                                                        alt="" height="100%" width="100%"
                                                        style="object-fit:contain;">
                                                </div></td> --}}
                                                <td><a href="{{ route('offers.edit', $value->id) }}"> <button
                                                    class="btn btn-success btn-xs" type="button"
                                                    data-original-title="btn btn-danger btn-xs" title=""
                                                    data-bs-original-title="">Edit</button></a></td>
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

                $(".deletecontent").on("click", function() {
                    var id = $(this).attr("data-id");
                    $.ajax({
                        url: "{{route('page-content.destroy',"id")}}",
                        data: {
                            "id": id,
                            "_token": "{{ csrf_token() }}"
                        },
                        type: 'DELETE',
                        success: function(result) {
                            toastr.success('Page Content Deleted Sucessfully');
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                    });
                });
            })
        </script>
 @endsection
