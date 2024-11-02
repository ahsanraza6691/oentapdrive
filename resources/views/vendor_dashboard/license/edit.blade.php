@extends('admin_dashboard.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form theme-form">
                            <form id="" action="{{route('brand.update',$brands->id) }}" method="POST" enctype="multipart/form-data">
                                {{-- <input id="hidden" type="hidden" name="hidden"> --}}
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="brand_id" value="{{ $brands->id }}">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Brand Name</label>
                                            <input class="form-control" type="text" placeholder="Enter Brand Name" data-bs-original-title="" title="" name="brand_name" value="{{$brands->brand_name}}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Brand Models</label>
                                            <input class="form-control" type="text" placeholder="Enter Brand Models" data-bs-original-title="" title="" name="brand_models" value="{{$brands->brand_models}}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Upload Brand Image</label>
                                            <input class="form-control" type="file" data-bs-original-title="" title="" name="image"  >
                                        </div>
                                    </div>
                                </div>
                                <img src="{{ asset('brands/' . $brands->brand_image) }}"   alt="" height="50px" width="50px"> <br><br><br>
                                <div class="row">
                                    <div class="col">
                                        <div>
                                            <button type="submit" id="" class="btn btn-success me-3">Update</button>
                                            <a class="btn btn-danger" href="{{route('brand.index')}}" data-bs-original-title="" title="">Cancel</a>
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
    @push('scripts')
    <script>
        var id = ($('select[name="parent_category_id"]').val());
        $.ajax({
        type: "GET",
        url: '{{route('get_main_category')}}',
        data:  {'id':id},
        success: function(response) {
            // console.log(response.clients);
            $('#main-category_id').html('');
            if(response!='') {
                $.each(response.maincategory, function(value,i) {
                    var select = (i.id == i.main_category_name ? 'selected="selected"' : '');
                    // console.log(test);
                    $('#main-category_id').append(`<option  value ="${i.id}" ${select}>${i.main_category_name}</option>`);

                });
                }else
                {
                    $('#main-category_id').append('<h3>No Category Found</h3>');
                }
            }
        });
    </script>
    <script>
        $(document).ready(function(){
        $('#parent_category_id').on('change', function(){
            var id = $(this).val();
            $.ajax({
            type: "GET",
            url: '{{route('get_main_category')}}',
            "dataSrc": "",
            data:  {'id':id},
            // dataType: 'json',
            //  cache: false,
            success: function(response) {
                // console.log(response.clients);
                // $("#pageloader").hide();
                $('#main-category_id').html('');
                // $("#main-category_id").append(`<optgroup label="Please Select Parent Category">`);
                if(response!='') {
                    $.each(response.maincategory, function(value,i) {
                        $('#main-category_id').append(`<option  value ="${i.id}" >${i.main_category_name}</option>`);
                    });
                    }else
                    {
                        $('#main-category_id').append('<h3>No Category Found</h3>');
                    }
                 }
            });
        });
    });
    </script>
    <script>
        $(document).ready(function(){
        var id = ($('select[name="parent_category_id"]').val());
        // alert(id);
        // $('#parent_category_id').on('change', function(){
            // var id = $(this).val();
            $.ajax({
            type: "GET",
            url: '{{route('get_brand_name')}}',
            "dataSrc": "",
            data:  {'id':id},
            success: function(response) {
                // console.log(response.clients);
                // $("#pageloader").hide();
                $('#brand_id').html('');
                if(response!='') {
                    $.each(response.brand, function(value,i) {
                        // console.log(i);
                        var select = ('{{$brands->id}}' == i.id ? 'selected="selected"' : '');
                        $('#brand_id').append(`<option  value ="${i.id}"  ${select}>${i.brand_name}</option>`);
                    });
                    }else
                    {
                        $('#brand_id').append('<h3>No Category Found</h3>');
                    }
                 }
            });
        });
    // });
    </script>
    @endpush
@endsection
