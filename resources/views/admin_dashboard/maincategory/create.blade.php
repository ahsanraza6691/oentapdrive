@extends('admin_dashboard.layouts.master')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="form theme-form">
                        <form id="" action="{{route('main-category.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>Select Brand .*</label>
                                        <select  name="parent_category_id" for="exampleFormControlInput10" class="form-control btn-square type" id="service">
                                         @foreach ($brands as $brand )
                                             <option value="{{$brand->id}}" class="form-control btn-square" id="exampleFormControlInput10">{{$brand->brand_name}}</option>
                                         @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>Model  Name</label>
                                        <input class="form-control" type="text" placeholder="Enter Model Name" data-bs-original-title="" title="" name="model_name" required>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>Make  Year</label>
                                        <select  name="make_year" for="exampleFormControlInput11" class="form-control btn-square type" id="make_year">
                                                @php
                                                    $currentYear = date('Y');
                                                    $startYear = 2000; // Change this to your desired start year
                                                @endphp

                                                @for ($year = $currentYear; $year >= $startYear; $year--)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endfor
                                            </select>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>Upload Model Image</label>
                                        <input class="form-control" type="file" data-bs-original-title="" title="" name="image" accept="image/*"  >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div>
                                        <button type="submit" id="" class="btn btn-success me-3">Add</button>
                                        <a class="btn btn-danger" href="{{route('main-category.index')}}" data-bs-original-title="" title="">Cancel</a>
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
@endsection

