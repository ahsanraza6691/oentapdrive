@extends('admin_dashboard.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        {{-- <div class="col-xl-12 p-0 left-btn"><a class="btn btn-gradient" data-bs-original-title="" title=""
                                href="{{ route('banner.create') }}">Create</a></div> --}}

                        <h5>Banner Images List </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">
                                <table class="display dataTable no-footer" id="basic-1" role="grid"
                                    aria-describedby="basic-1_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                colspan="1" aria-sort="ascending">
                                                S.NO</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending"> Page name</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Banner Image</th>
                                            {{-- <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending"> Status</th> --}}
                                            <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                colspan="1" aria-label="Action: activate to sort column ascending"
                                                style="width: 120.016px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($banners as $value)
                                            <tr role="row" class="odd">
                                                <td>
                                                    {{ $value->id ?? null }}
                                                </td>
                                                <td>
                                                    {{ $value->get_page->page_name ?? null }}
                                                </td>

                                                @if ($value->id == 1)
                                                    <td class="d-flex">
                                                        @foreach (json_decode($value->banner_image) as $key => $image)
                                                            <div class="" style="width:150px; height:100px; margin:0px 6px;">
                                                                <img src="{{ url('public/banner/' . $image) }}"
                                                                    alt="" height="100%" width="100%"
                                                                    style="object-fit:contain;">
                                                            </div>
                                                        @endforeach
                                                    </td>
                                                @else
                                                    <td class="d-flex">
                                                        <div class="" style="width:150px; height:100px;margin:0px 6px;">
                                                            <img src="{{ url('public/banner/' . $value->banner_image) }}"
                                                                alt=""
                                                                height="100%" width="100%"
                                                                    style="object-fit:contain;">
                                                        </div>
                                                    </td>
                                                @endif

                                                <td>
                                                    {{-- <a href="javascript:void(0);" class="deletepage"
                                                        data-id="{{ $value->id }}">
                                                        <button class="btn btn-danger btn-xs" type="submit"
                                                            data-original-title="btn btn-danger btn-xs">Delete</button></a> --}}

                                                    <a href="{{ route('banner.edit', $value->id) }}"> <button
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

            $(".deletepage").on("click", function() {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "{{ route('banner.destroy', 'id') }}",
                    data: {
                        "id": id,
                        "_token": "{{ csrf_token() }}"
                    },
                    type: 'DELETE',
                    success: function(result) {
                        toastr.success('Banner Image  Deleted Sucessfully');
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                });
            });
        })
    </script>
@endsection
