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
                        <h5>Car Brands/Models </h5>
                        <div class=""><a class="btn btn-gradient" data-bs-original-title="" title=""
                                href="{{ route('main-category.create') }}">Add</a></div>

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
                                                aria-label="Details: activate to sort column ascending">Brand Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Model</th>
                                                {{-- <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Year</th> --}}
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending">Image</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                aria-label="Details: activate to sort column ascending"> Status</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                colspan="1" aria-label="Action: activate to sort column ascending"
                                                style="width: 120.016px;">Action</th>
                                        </tr>
                                    </thead>
                                    {{-- <tbody>
                                        @foreach ($main_categories as $value)
                                            <tr role="row" class="odd">
                                                <td>
                                                    {{ $loop->iteration ?? null }}
                                                </td>
                                                <td>
                                                    {{ $value->get_parent_category->brand_name ?? null }}
                                                </td>
                                                <td>
                                                    {{ $value->main_category_name ?? null }}
                                                </td>
                                                <td>
                                                    {{ $value->make_year ?? null }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('main-category-status', $value->id) }}">
                                                        @if ($value->status == 1)
                                                            <button class="btn btn-info btn-sm" id="status"><i
                                                                    class="fa fa-thumbs-up"></i></button>
                                                        @else
                                                            <button class="btn btn-danger btn-sm" id="status"><i
                                                                    class="fa fa-thumbs-down"></i></button>
                                                        @endif
                                                    </a>
                                                </td>
                                                <td class="editDelete">
                                                    <form action="{{ route("main-category.destroy", $value->id) }}" method="post">

                                                        @method("DELETE")

                                                        @csrf
                                                        <a href="#">
                                                        <button class="btn btn-danger btn-xs" type="submit"
                                                            data-original-title="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete main category ?');" >Delete</button></a>
                                                    </form>

                                                    <a href="{{ route('main-category.edit', $value->id) }}"> <button
                                                            class="btn btn-success btn-xs" type="button"
                                                            data-original-title="btn btn-danger btn-xs" title=""
                                                            data-bs-original-title="">Edit</button></a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody> --}}
                                </table>


                                {{-- {!! $main_categories->links() !!} --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Individual column searching (text inputs) Ends-->
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#basic-1').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('main-category.index') }}',
            columns: [
                { data: 'iteration', name: 'iteration' },
                { data: 'brand_name', name: 'brand_name' },
                { data: 'main_category_name', name: 'main_category_name' },
                // { data: 'make_year', name: 'make_year' },
                {
                data: 'image',
                name: 'image',
                orderable: false,
                searchable: false,
                render: function(data) {
                    // Check if data is not null
                    if (data !== null) {
                        // Assuming data is a comma-separated list of image filenames or paths
                        var imageList = data.split(',');
                        var firstImage = imageList.length > 0 ? imageList[0] : '';

                        var imagePath = "{{ asset('model_image') }}" + '/' + firstImage;
                        return '<img src="' + imagePath + '" alt="image"  width="120"">';
                    } else {
                        // Handle the case where data is null (no image)
                        return 'No Image';
                    }
                },
            },
            { 
                    data: 'status', 
                    name: 'status',
                    render: function(data, type, full, meta) {
                        var statusButton = data == 1 
                            ? '<button class="btn btn-info btn-sm" id="status"><i class="fa fa-thumbs-up"></i></button>'
                            : '<button class="btn btn-danger btn-sm" id="status"><i class="fa fa-thumbs-down"></i></button>';
                        return '<a href="{{ route('main-category-status', ':id') }}'.replace(':id', full.id) + '">' + statusButton + '</a>';
                    }
                },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
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

                $(".deletemaincategory").on("click", function() {
                    var id = $(this).attr("data-id");
                    $.ajax({
                        url: "{{route('main-category.destroy',"id")}}",
                        data: {
                            "id": id,
                            "_token": "{{ csrf_token() }}"
                        },
                        type: 'DELETE',
                        success: function(result) {
                            toastr.success('Main Category Deleted Sucessfully');
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                    });
                });
            })
        </script>
@endsection
