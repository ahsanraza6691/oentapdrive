@extends('admin_dashboard.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form theme-form">
                            <form id="" action="{{route('banner.update',$banners->id) }}" method="POST" enctype="multipart/form-data">
                                {{-- <input id="hidden" type="hidden" name="hidden"> --}}
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="banner_id" value="{{ $banners->id }}">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Select Page.*</label>
                                            <select  name="page_id" for="exampleFormControlInput10" class="form-control btn-square type" id="service" readonly>
                                             @foreach ($pages as $service )
                                                 <option value="{{$service->id}}" {{$service->id == $banners->id ? 'selected' : ''}} class="form-control btn-square" id="exampleFormControlInput10">{{$service->page_name}}</option>
                                             @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @if($banners->id ==1)
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Title1</label>
                                            <input class="form-control" type="text" placeholder="Enter  Title Name" data-bs-original-title="" title="" name="title1" value="{{$banners->title1}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Title2</label>
                                            <input class="form-control" type="text" placeholder="Enter  Title Name" data-bs-original-title="" title="" name="title2" value="{{$banners->title2}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Title3</label>
                                            <input class="form-control" type="text" placeholder="Enter  Title Name" data-bs-original-title="" title="" name="title3" value="{{$banners->title3}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Banner Image</label>
                                            <input class="form-control" type="file" placeholder="Upload Banner Image" data-bs-original-title="" title="" name="banner_image[]" multiple>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" value="{{$banners->banner_image}}" name="old_banner">
                                 @foreach (json_decode($banners->banner_image) as $key => $image)
                                <img src="{{ url('public/banner/' . $image) }}"
                                    alt="" height="100px" width="100px">
                                @endforeach
                                <br><br><br>
                                @else
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Banner Image</label>
                                            <input class="form-control" type="file" placeholder="Upload Banner Image" data-bs-original-title="" title="" name="banner_image">
                                        </div>
                                    </div>
                                </div>
                                <img src="{{ url('public/banner/' . $banners->banner_image) }}"   alt="" height="100px" width="100px"> <br><br><br>
                                @endif
                                <div class="row">
                                    <div class="col">
                                        <div>
                                            <button type="submit" class="btn btn-success me-3">Update</button>
                                            <a class="btn btn-danger" href="{{ route('banner.index') }}"
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
