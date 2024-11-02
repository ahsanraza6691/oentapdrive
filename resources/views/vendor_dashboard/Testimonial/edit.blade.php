@extends('admin_dashboard.layouts.master')
@section('content')
<style>
    .footer {
    margin-left: -20px !important;
}
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="form theme-form">
                        <form id="" action="{{route('update-testimonial',$testimonialedit->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>Client Name</label>
                                        <input class="form-control" type="text" value="{{$testimonialedit->name ?? ''}}" placeholder="Page Name" data-bs-original-title="" title="" name="name" id="image_title">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="">Client Image </label>
                                            <input type="file" name="image" class="form-control" data-bs-original-title="" title="" id="image">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <img src="{{asset('testimonial/'. $testimonialedit->image) }}" alt="Avatar" class="" width="100px;" height="100px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Short Description</label>
                                            <input class="form-control" type="text" value="{{$testimonialedit->short_description ?? ''}}" placeholder="Short Description" data-bs-original-title="" title="" name="short_description" id="image_title">
                                        </div>
                                    </div>
                                </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="">Long Description </label>
                                        <textarea class="form-control editor" name="long_description" id="" cols="30" rows="10">{!!$testimonialedit->long_description ?? ''!!}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div>
                                        <button type="submit" id="" class="btn btn-success me-3">Update</button>
                                        <a class="btn btn-danger" href="{{route('testimonial-index')}}" data-bs-original-title="" title="">Cancel</a>
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

<!-- {{-- script start --}} -->
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
