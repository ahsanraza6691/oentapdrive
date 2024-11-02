@extends('admin_dashboard.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form theme-form">
                            <form id="" action="{{route('app-banners.update',$edit->id) }}" method="POST" enctype="multipart/form-data">
                                {{-- <input id="hidden" type="hidden" name="hidden"> --}}
                                @csrf
                                @method('PUT')
                              
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Title1</label>
                                            <input class="form-control" type="text" placeholder="Enter  Title Name" data-bs-original-title="" title="" name="title" value="{{$edit->title}}">
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>App Images</label>
                                            <input class="form-control" type="file" placeholder="Upload Banner Image" data-bs-original-title="" title="" name="images[]" multiple>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" value="{{$edit->image}}" name="old_banner">
                                 @foreach (json_decode($edit->image) as $key => $image)
                                <img src="{{ asset('appimages/' . $image) }}"
                                    alt="" height="100px" width="100px">
                                @endforeach
                                <br><br><br>
                               
                                <div class="row">
                                    <div class="col">
                                        <div>
                                            <button type="submit" class="btn btn-success me-3">Update</button>
                                            <a class="btn btn-danger" href="{{ route('app-banners.index') }}"
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
