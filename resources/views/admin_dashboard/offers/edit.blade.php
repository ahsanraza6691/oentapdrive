@extends('admin_dashboard.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form theme-form">
                            <form id="" action="{{route('offers.update',$offers->id) }}" method="POST" enctype="multipart/form-data">
                                {{-- <input id="hidden" type="hidden" name="hidden"> --}}
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="offer_id" value="{{ $offers->id }}">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Select Page.*</label>
                                            <select  name="page_id" for="exampleFormControlInput10" class="form-control btn-square type" id="service" readonly>
                                             @foreach ($pages as $service )
                                                 <option value="{{$service->id}}" {{$service->id == $offers->id ? 'selected' : ''}} class="form-control btn-square" id="exampleFormControlInput10">{{$service->page_name}}</option>
                                             @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Section</label>
                                            <input class="form-control" type="text" placeholder="Enter  Title Name" data-bs-original-title="" title="" name="section_name" value="{{$offers->section_name}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Title1</label>
                                            <input class="form-control" type="text" placeholder="Enter  Title Name" data-bs-original-title="" title="" name="title1" value="{{$offers->title1}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Title2</label>
                                            <input class="form-control" type="text" placeholder="Enter  Title Name" data-bs-original-title="" title="" name="title2" value="{{$offers->title2}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Title3</label>
                                            <input class="form-control" type="text" placeholder="Enter  Title Name" data-bs-original-title="" title="" name="title3" value="{{$offers->title3}}" required>
                                        </div>
                                    </div>
                                </div>
                                @if($offers->id == 1)
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Title4</label>
                                            <input class="form-control" type="text" placeholder="Enter  Title Name" data-bs-original-title="" title="" name="title4" value="{{$offers->title4}}" required>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Background Image</label>
                                            <input class="form-control" type="file" placeholder="Upload  Image" data-bs-original-title="" title="" name="image1">
                                        </div>
                                    </div>
                                </div>
                                <img src="{{ url('public/offers/' . $offers->image1) }}"   alt="" height="100px" width="100px"> <br><br><br>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Image </label>
                                            <input class="form-control" type="file" placeholder="Upload Banner Image" data-bs-original-title="" title="" name="image2">
                                        </div>
                                    </div>
                                </div>
                                <img src="{{ url('public/offers/' . $offers->image2) }}"   alt="" height="100px" width="100px"> <br><br><br>
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
