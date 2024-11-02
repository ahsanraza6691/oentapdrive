@extends('admin_dashboard.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form theme-form">
                            <form id="" action="{{route('parent-category.update',$parents->id) }}" method="POST">
                                {{-- <input id="hidden" type="hidden" name="hidden"> --}}
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="parent_id" value="{{ $parents->id }}">

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Parent Category Name</label>
                                            <input class="form-control" type="text" placeholder="Enter Parent Category Name" data-bs-original-title="" title="" name="parent_category_name" value="{{$parents->parent_category_name}}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div>
                                            <button type="submit" class="btn btn-success me-3">Update</button>
                                            <a class="btn btn-danger" href="{{ route('parent-category.index') }}"
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
