@extends('admin_dashboard.layouts.master')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="form theme-form">
                        <form id="" action="{{route('app-banners.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                           
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>Title</label>
                                        <input class="form-control" type="text" placeholder="Enter  Title Name" data-bs-original-title="" title="" name="title">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>Upload Images</label>
                                        <input class="form-control" type="file" data-bs-original-title="" title="" name="images"  multiple required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div>
                                        <button type="submit" id="" class="btn btn-success me-3">Add</button>
                                        <a class="btn btn-danger" href="{{route('app-banners.index')}}" data-bs-original-title="" title="">Cancel</a>
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

