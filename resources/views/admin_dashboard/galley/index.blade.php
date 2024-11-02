@extends('admin_dashboard.layouts.master')
@section('content')

<div class="container-fluid">
    <div class="row">
        <!-- Individual column searching (text inputs) Starts-->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Gallery List </h5>
                    <div class=""><a class="btn btn-gradient" data-bs-original-title="" title=""
                            href="{{route('create-gallery')}}">Add</a></div>

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
                                        aria-label="Details: activate to sort column ascending">Image Title</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label="Image: activate to sort column descending">
                                            Image</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1"
                                            aria-label="Details: activate to sort column ascending">Status</th>
                                        <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                                            aria-label="Action: activate to sort column ascending"
                                            style="width: 120.016px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gallery as $key=>$value)
                                        <tr role="row" class="odd">
                                            <td>
                                                {{$value->id}}
                                            </td>
                                            <td>
                                                {{$value->image_title}}
                                            </td>
                                            <td class="sorting_1">
                                                <img src="{{ url('public/images/' . $value->image_name)}}" alt=""
                                                    height="100px" width="150px"></td>
                                            <td>
                                                <a href="{{ route('gallery-status', ['id' => $value->id]) }}">
                                                    @if ($value->status == 1)
                                                        <button class="btn btn-info btn-sm" id="status"><i class="fa fa-thumbs-up"></i></button>
                                                    @else
                                                        <button class="btn btn-danger btn-sm" id="status"><i class="fa fa-thumbs-down"></i></button>
                                                    @endif
                                                </a>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);" class="delete" data-id="{{$value->id }}">
                                                    <button class="btn btn-danger btn-xs" type="submit"
                                                        data-original-title="btn btn-danger btn-xs">Delete
                                                    </button>
                                                </a>

                                                <a href="{{route('edit-gallery',$value->id)}}"> <button
                                                        class="btn btn-success btn-xs" type="button"
                                                        data-original-title="btn btn-danger btn-xs" title=""
                                                        data-bs-original-title="">Edit</button>
                                                </a>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){

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

        $(".delete").on("click", function(){
            var id = $(this).attr("data-id");
            $.ajax({
              url: "{{ route('gallery.delete',"id") }}",
              data: {"id": id,"_token": "{{ csrf_token() }}"},
              type: 'post',
              success: function(result){
                toastr.success('Your Image Deleted Sucessfully');
                setTimeout(() => {
                    location.reload();
                }, 1000);
              }
            });
        });
    })
</script>
@endsection
