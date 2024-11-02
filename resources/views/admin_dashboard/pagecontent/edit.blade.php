@extends('admin_dashboard.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form theme-form">
                            <form id="" action="{{route('page-content.update',$cms->id) }}" method="POST" enctype="multipart/form-data">
                                {{-- <input id="hidden" type="hidden" name="hidden"> --}}
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="page_content_id" value="{{ $cms->id }}">
                                {{-- <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Select Page.*</label>
                                            <select  name="page_id" for="exampleFormControlInput10" class="form-control btn-square type" id="service">
                                             @foreach ($pages as $service )
                                                 <option value="{{$service->id}}" {{$service->id == $cms->id ? 'selected' : '' }} class="form-control btn-square" id="exampleFormControlInput10">{{$service->page_name}}</option>
                                             @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Section name</label>
                                            <input class="form-control" type="text" placeholder="Enter  Section name" data-bs-original-title="" title="" name="section_name" value="{{$cms->section_name}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Title1</label>
                                            <input class="form-control" type="text" placeholder="Enter Title name" data-bs-original-title="" title="" name="title1" value="{{$cms->title1}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Title2</label>
                                            <input class="form-control" type="text" placeholder="Enter Title name" data-bs-original-title="" title="" name="title2" value="{{$cms->title2}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Title3</label>
                                            <input class="form-control" type="text" placeholder="Enter Title name" data-bs-original-title="" title="" name="title3" value="{{$cms->title3}}" required>
                                        </div>
                                    </div>
                                </div>
                                @if($cms->id == 1)
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Title4</label>
                                            <input class="form-control" type="text" placeholder="Enter Title name" data-bs-original-title="" title="" name="title4" value="{{$cms->title4}}" required>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Upload Image</label>
                                            <input class="form-control" type="file" placeholder="Upload Image" data-bs-original-title="" title="" name="image">
                                        </div>
                                    </div>
                                </div>
                                <img src="{{ url('public/content/' . $cms->image) }}"   alt="" height="100px" width="100px"> <br><br><br>

                                {{-- <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="">Description</label>
                                            <textarea class="form-control editor" name="description" id="" cols="30" rows="10">{!!$cms->description!!}</textarea>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="col">
                                        <div>
                                            <button type="submit" class="btn btn-success me-3">Update</button>
                                            <a class="btn btn-danger" href="{{ route('page-content.index') }}"
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
