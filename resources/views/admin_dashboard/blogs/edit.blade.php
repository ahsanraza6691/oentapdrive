@extends('admin_dashboard.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form theme-form">
                            <form id="" action="{{route('blog-update',$blog->id) }}" method="POST" enctype="multipart/form-data">
                                {{-- <input id="hidden" type="hidden" name="hidden"> --}}
                                @csrf
                                {{-- @method('PUT') --}}
                                <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Title</label>
                                            <input class="form-control" type="text" placeholder="Enter Blog Title" data-bs-original-title="" title="" name="title" value="{{$blog->title}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Date</label>
                                            <input class="form-control" type="date" placeholder="Enter Blog Date" data-bs-original-title="" title="" name="date" value="{{$blog->date}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Upload Image</label>
                                            <input class="form-control" type="file" placeholder="Upload Image" data-bs-original-title="" title="" name="image">
                                        </div>
                                    </div>
                                </div>
                                <img src="{{ url('public/blog/' . $blog->image) }}"   alt="" height="100px" width="100px"> <br><br><br>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="">Description</label>
                                            <textarea class="form-control editor" name="description" id="" cols="30" rows="10">{!! $blog->description !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div>
                                            <button type="submit" class="btn btn-success me-3">Update</button>
                                            <a class="btn btn-danger" href="{{ route('blog-index') }}"
                                                data-bs-original-title="" title="">Cancel</a>
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
