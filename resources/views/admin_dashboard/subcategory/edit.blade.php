@extends('admin_dashboard.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form theme-form">
                            <form id="" action="{{ route('sub-category.update', $sub_category->id) }}" method="POST">
                                {{-- <input id="hidden" type="hidden" name="hidden"> --}}
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="sub_id" value="{{ $sub_category->id }}">

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Select Parent Category.*</label>
                                            <select name="parent_category_id" for="exampleFormControlInput10"
                                                class="form-control btn-square type" id="parent_category_id">
                                                @foreach ($parent_categories as $parents)
                                                    <option value="{{ $parents->id }}"
                                                        {{ $parents->id == $sub_category->parent_category_id ? 'selected' : '' }}
                                                        class="form-control btn-square" id="exampleFormControlInput10">
                                                        {{ $parents->parent_category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Select Main Category.*</label>
                                            <select id="main-category_id" for="exampleFormControlInput10"
                                                class="form-control btn-square type" name="main_category_id">

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Select Brand.*</label>
                                            <select id="brand_id" for="exampleFormControlInput10" class="form-control btn-square type" name="brand_id">
                                                @foreach ($brands as $brand)
                                                    <option id="brand_category_id" value="{{$brand->id}}" class="form-control btn-square" >{{$brand->brand_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Sub Category Name</label>
                                            <input class="form-control" type="text" placeholder="Enter Sub Category Name"
                                                data-bs-original-title="" title="" name="sub_category_name"
                                                value="{{ $sub_category->sub_category_name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Sub Category Image</label>
                                            <input class="form-control" type="file" data-bs-original-title=""
                                                title="" name="image" accept="image*">
                                        </div>
                                        @if (empty($sub_category->image))
                                            <img src="{{ asset('assets/No-image.jpg') }}" alt="" height="100px"
                                                width="100px"> <br><br><br>
                                        @else
                                            <img src="{{ url('public/sub-category/' . $sub_category->image) }}"
                                                alt="" height="100px" width="100px"> <br><br><br>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div>
                                            <button type="submit" class="btn btn-success me-3">Update</button>
                                            <a class="btn btn-danger" href="{{ route('sub-category.index') }}"
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
            var id = ($('select[name="parent_category_id"]').val());
            $.ajax({
                type: "GET",
                url: '{{ route('get_main_category') }}',
                data: {
                    'id': id
                },
                beforeSend: function() {
                    $("#preloaderSmall").removeClass('loader-active');
                },
                success: function(response) {
                    $("#preloaderSmall").addClass('loader-active');
                    // console.log(response.clients);
                    $('#main-category_id').html('');
                    if (response != '') {
                        $.each(response.maincategory, function(value, i) {
                            var select = (i.id == i.main_category_name ? 'selected="selected"' : '');
                            // console.log(test);
                            $('#main-category_id').append(
                                `<option  value ="${i.id}" ${select}>${i.main_category_name}</option>`);

                        });
                    } else {
                        $('#main-category_id').append('<h3>No Category Found</h3>');
                    }
                }
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#parent_category_id').on('change', function() {
                    var id = $(this).val();
                    $.ajax({
                        type: "GET",
                        url: '{{ route('get_main_category') }}',
                        "dataSrc": "",
                        data: {
                            'id': id
                        },
                        beforeSend: function() {
                            $("#preloaderSmall").removeClass('loader-active');
                        },
                        success: function(response) {
                            $("#preloaderSmall").addClass('loader-active');
                            // console.log(response.clients);
                            // $("#pageloader").hide();
                            $('#main-category_id').html('');
                            // $("#main-category_id").append(`<optgroup label="Please Select Parent Category">`);
                            if (response != '') {
                                $.each(response.maincategory, function(value, i) {
                                    $('#main-category_id').append(
                                        `<option  value ="${i.id}" >${i.main_category_name}</option>`
                                        );
                                });
                            } else {
                                $('#main-category_id').append('<h3>No Category Found</h3>');
                            }
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
