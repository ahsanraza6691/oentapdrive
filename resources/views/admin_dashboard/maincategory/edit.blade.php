@extends('admin_dashboard.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form theme-form">
                            <form id="" action="{{route('main-category.update',$main_category->id) }}" method="POST" enctype="multipart/form-data">
                                {{-- <input id="hidden" type="hidden" name="hidden"> --}}
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="main_id" value="{{ $main_category->id }}" >
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Select Brand .*</label>
                                            <select  name="parent_category_id" for="exampleFormControlInput10" class="form-control btn-square type" id="service">
                                                @foreach ($parent_categories as $parents )
                                                    <option value="{{$parents->id}}" {{$parents->id == $main_category->brand_id ? 'selected' : ''}} class="form-control btn-square" id="exampleFormControlInput10">{{$parents->brand_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Model Name</label>
                                            <input class="form-control" type="text" placeholder="Enter Model Name" data-bs-original-title="" title="" name="model_name" value="{{$main_category->main_category_name}}" required>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Make Year</label>
                                            <input class="form-control" type="text" placeholder="Enter Make Year " data-bs-original-title="" title="" name="make_year" value="{{$main_category->make_year}}" required>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Upload  Image</label>
                                            <input class="form-control" type="file" data-bs-original-title="" title="" name="image"  accept="image/*" >
                                        </div>

                                        @if(!empty($main_category->image))
                                        <img src="{{asset('model_image/'.$main_category->image)}}" width="130px">
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div>
                                            <button type="submit" class="btn btn-success me-3">Update</button>
                                            <a class="btn btn-danger" href="{{ route('main-category.index') }}"
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
@endsection
