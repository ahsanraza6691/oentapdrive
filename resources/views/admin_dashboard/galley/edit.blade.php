@extends('admin_dashboard.layouts.master')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="form theme-form">
                        <form id="" action="{{route('update-gallery',$galleryedit->id)}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input name="gallery_id" value="{{$galleryedit->id}}" hidden>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>Image Title</label>
                                        <input class="form-control" type="text" placeholder="Page Name"
                                            data-bs-original-title="" title="" name="image_title" id="image_title"
                                            value="{{$galleryedit->image_title}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="">Old Image </label> <br>
                                        <img src="{{asset('images/'. $galleryedit->image_name) }}" width="200"
                                            height="100">
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="">Add New Image </label>
                                            <input type="file" name="image_name" class="form-control" id="">
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" id="save_gallery" class="btn btn-success me-3">Update</button>
                                    <a class="btn btn-danger" href="{{route('gallery.index')}}" data-bs-original-title="" title="">Cancel</a>
                                </div>
                            </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{{-- script start --}}
<script>
    $(document).ready(function () {
        // toastr css
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
        // toastr end
        $('#add_gallery').on('submit', function (event) {
            event.preventDefault();
            // required condition
            var image_title = $('#image_title').val();
            var image_name = $('#image_name').val();
            // alert(image_name);
            if (image_title == '') {
                toastr.error('Image title is required');
                return false;
            };
            if (image_name == '') {
                toastr.error('Image  is required');
                return false;
            };
            // end
            var url = $('#add_gallery').attr('action');
            $.ajax({
                url: url,
                method: 'POST',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    if (response.status == 200) {
                        toastr.success(response.message);
                        // location.reload()
                        setTimeout(() => {
                            window.location.href="{{route('gallery.index')}}"
                        }, 1000);
                    } else {
                        toastr.error('Upload again!')
                    }
                }
            });

        });
    });

</script>
@push('scripts')
<script>
    $("input[type='file']").on("change", function () {
        if(this.files[0].size > 3000000) {
            toastr.error("Please Upload file less than 3 Mb")
            $(this).val('');
        }
    });
    </script>
@endpush
@endsection
