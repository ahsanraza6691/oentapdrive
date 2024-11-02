@extends('admin_dashboard.layouts.master')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="form theme-form">
                        <form id="" action="{{route('portfolio.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>Select Service.*</label>
                                        <select  name="type" for="exampleFormControlInput10" class="form-control btn-square type" id="service">
                                         @foreach ($services as $service )
                                             <option value="{{$service->id}}" class="form-control btn-square" id="exampleFormControlInput10">{{$service->service_name}}</option>
                                         @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="image">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label>Image</label>
                                        <input  type="file" class="form-control"  data-bs-original-title="" title="" name="image">
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="image_thumbnail">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="">Thumbnail Image</label>
                                        <input  type="file" class="form-control" type="file"  data-bs-original-title="" title="" name="image_thumbnail">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="" id="video">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="">Video</label>
                                        <input  type="file" class="form-control" type="file"  data-bs-original-title="" title="" name="video">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div>
                                        <button type="submit" id="" class="btn btn-success me-3">Add</button>
                                        <a class="btn btn-danger" href="{{route('portfolio.index')}}" data-bs-original-title="" title="">Cancel</a>
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
    <script>
    // $(document).ready(function() {
    //     $('.type').on('change', function() {
    //       var service = $('#service').val();
    //      if(service == 2){
    //         $("#image_thumbnail").hide();
    //         $("#image").hide();
    //         $("#video").css("visibility", "visible");
    //      }
    //   });
    // });
    </script>

@endsection

