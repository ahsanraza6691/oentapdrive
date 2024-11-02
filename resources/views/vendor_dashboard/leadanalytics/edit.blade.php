@extends('admin_dashboard.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form theme-form">
                            <form id="" action="{{route('main-category.update',$main_category->id) }}" method="POST">
                                {{-- <input id="hidden" type="hidden" name="hidden"> --}}
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="main_id" value="{{ $main_category->id }}">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Select Parent Category.*</label>
                                            <select  name="parent_category_id" for="exampleFormControlInput10" class="form-control btn-square type" id="service">
                                                @foreach ($parent_categories as $parents )
                                                    <option value="{{$parents->id}}" {{$parents->id == $main_category->parent_category_id ? 'selected' : ''}} class="form-control btn-square" id="exampleFormControlInput10">{{$parents->parent_category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Main Category Name</label>
                                            <input class="form-control" type="text" placeholder="Enter Main Category Name" data-bs-original-title="" title="" name="main_category_name" value="{{$main_category->main_category_name}}">
                                        </div>
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
