@extends('admin_dashboard.layouts.master')
@section('content')
    <style>
        .customer_records,
        .remove {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .tabsBox {
            padding: 20px;
        }

        div.tabsContent {
            margin-top: 20px;
        }

        button#pillsProductTab,
        button#pillsVariationTab,
        button#pillsStockTab,
        button#pillsTagsTab,
        button#pillsImageTab {
            border: none;
            padding: 10px 30px;
            color: #000000;
            font-size: 14px;
            background-color: #c1c1c194;
            margin-right: 10px;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background-color: #ff2446 !important;
            color: #fff !important;
        }

        .upload__btn p {
            margin-bottom: 0px;
        }

        .upload__btn {
            display: inline-block;
            color: #fff;
            text-align: center;
            min-width: 116px;
            padding: 5px;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid;
            background-color: #4045ba;
            border-color: #4045ba;
            border-radius: 4px;
            line-height: 26px;
            font-size: 14px;
        }

        .upload__inputfile {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }

        .uploadImage {
            width: 65px;
            height: 45px;
            border-radius: 6px;
            overflow: hidden;
            margin-right: 16px;
        }

        .uploadImage img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .img-bg {
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;
            padding-bottom: 100%;
        }

        .upload__img-wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 65%;
            margin: 16px 0px;
        }

        button.startUploadButton {
            color: #fff;
            min-width: 116px;
            padding: 5px;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid;
            background-color: #0d6efd;
            border-color: #0d6efd;
            border-radius: 4px;
            line-height: 26px;
            font-size: 14px;
        }

        button.cancelUploadButton {
            color: #fff;
            min-width: 116px;
            padding: 5px;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid;
            background-color: #7e7e7e8f;
            border-color: #c1c1c194;
            border-radius: 4px;
            line-height: 26px;
            font-size: 14px;
        }

        button.imageDeleteButton {
            color: #fff;
            min-width: 116px;
            padding: 5px;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid;
            background-color: #dc3545;
            border-color: #dc3545;
            border-radius: 4px;
            line-height: 26px;
            font-size: 14px;
        }

        .smallButton {
            min-width: 75px !important;
            font-size: 12px !important;
            line-height: 20px !important;
        }

        .form-select {
            background-image: unset !important;
        }

        form.quantityBox {
            display: flex !important;
            align-items: center !important;
            gap: 20px !important;
            margin: 24px 0px;
        }

        #next {
            display: flex;
            flex-wrap: wrap;
            justify-content: start;
            width: 100%;
        }

        .review-img-box .remove {
            display: block;
            color: #ff2446;
            text-align: center !important;
            font-size: 20px;
        }

        /* CUSTOM PRELOADER */

        .loader-bg {
            width: 100%;
            height: 100%;
            background: #ffffff;
            position: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999999999;

        }

        .loader-bg h3 {
            position: fixed;
            color: #ff8801;
            font-size: 24px;
            text-transform: uppercase;
            font-family: montserratSemiBold;
        }

        .loader {
            width: 8em;
            height: 8em;
            font-size: 22px;
            box-sizing: border-box;
            border-top: 0.3em solid #ff2446;
            border-radius: 50%;
            position: relative;
            animation: rotating 2s ease-in-out infinite;
            --direction: 1;
        }

        .loader span {
            position: absolute;
            color: #ff2446;
            width: inherit;
            height: inherit;
            text-align: center;
            line-height: 10em;
            font-family: sans-serif;
            animation: rotating 2s linear infinite;
        }

        .loader::before,
        .loader::after {
            content: '';
            position: absolute;
            width: inherit;
            height: inherit;
            border-radius: 50%;
            box-sizing: border-box;
            top: -0.2em;
        }

        .loader::before {
            border-top: 0.3em solid #ff2446;
            transform: rotate(120deg);
        }

        .loader::after {
            border-top: 0.3em solid #ff8801;
            transform: rotate(240deg);
        }

        @keyframes rotating {
            50% {
                transform: rotate(calc(180deg));
            }

            100% {
                transform: rotate(calc(360deg));
            }
        }

        .loader-bg {
            display: none;
        }

        /* END OF CUSTOM PRELOADER */

        /* updated work */

        .editImages {
            width: 60px;
            height: 50px;
            overflow: hidden;
        }

        .editImages img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .editImagesBox {
            display: flex;
            gap: 20px;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        position: unset !important;
        border-right:unset !important
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover, .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:focus {
    background-color: #7366ff;
    color: #fff;
}
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card tabsBox">
                    <ul class="nav nested nav-pills mb-3" id="pills-tab" role="tablist">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pillsProductTab" data-bs-toggle="pill"
                                data-bs-target="#pillsProduct" type="button" role="tab" aria-controls="pillsProductTab"
                                aria-selected="true">Product</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pillsVariationTab" data-bs-toggle="pill"
                                data-bs-target="#pillsVariation" type="button" role="tab"
                                aria-controls="pillsVariationTab" aria-selected="false">Variations</button>
                        </li>

                     
                        <li class="nav-item" role="presentation">
                            <button class="nav-link tags" id="pillsTagsTab" data-bs-toggle="pill"
                                data-bs-target="#pillsTags" type="button" role="tab" aria-controls="pillsTagsTab"
                                aria-selected="true" id="tags">Tags</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link save_tags" id="pillsImageTab" data-bs-toggle="pill"
                                data-bs-target="#pillsImage" type="button" role="tab" aria-controls="pillsImageTab"
                                aria-selected="false">Images</button>
                        </li>

                    </ul>
                    <form id="product" enctype="multipart/form-data">
                        <div class="tab-content tabsContent" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pillsProduct" role="tabpanel"
                                aria-labelledby="pillsProductTab">
                                @csrf
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Select Parent Category.*</label>
                                                <select id="parent_category_id" name="parent_category_id"
                                                    for="exampleFormControlInput10" class="form-control btn-square type">
                                                    @foreach ($parent_categories as $parents)
                                                        <option id="parent_category_id" value="{{ $parents->id }}"
                                                            {{ $parents->id == $products->parent_category_id ? 'selected' : '' }}
                                                            class="form-control btn-square">
                                                            {{ $parents->parent_category_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Select Main Category.*</label>
                                                <input type="hidden" id="main_cat_id" name="main_cat_id">
                                                <select id="main-category_id" for="exampleFormControlInput10"
                                                    class="form-control btn-square type" name="main_category_id">

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Select Sub Category.*</label>
                                                <select id="sub-category_id" for="exampleFormControlInput10"
                                                    class="form-control btn-square type" name="sub_category_id">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Select Brand.*</label>
                                                <select id="brand_id" for="exampleFormControlInput10"
                                                    class="form-control btn-square type" name="brand_id">

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Product Name</label>
                                                <input class="form-control" id="product_name" type="text"
                                                    placeholder="Enter Product Title" data-bs-original-title=""
                                                    value="{{ $products->product_name }}" title=""
                                                    name="product_name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Product SKU</label>
                                                <input class="form-control" id="sku" type="text"
                                                    placeholder="Enter Product SKU" data-bs-original-title=""
                                                    title="" name="sku" value="{{ $products->sku }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Product Price</label>
                                                <input class="form-control" type="number" id="price"
                                                    placeholder="Enter Product Price" data-bs-original-title=""
                                                    title="" name="price" value="{{ $products->price }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Enter Discount If any</label>
                                                <input class="form-control" id="discount" type="number" id="discount"
                                                    placeholder="Enter Product Discount Price" data-bs-original-title=""
                                                    title="" name="discount" value="{{ $products->discount }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Total Price</label>
                                                <input class="form-control" type="number" id="total_price"
                                                    placeholder="Enter Product Price" data-bs-original-title=""
                                                    title="" name="total_price"
                                                    value="{{ $products->total_price }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Product Quantity</label>
                                                <input class="form-control" id="quantity" type="text"
                                                    placeholder="Enter Product Quantity" data-bs-original-title=""
                                                    title="" name="quantity" value="{{ $products->quantity }}">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="">Short Description</label>
                                                <textarea class="form-control" name="short_description" id="short_description">{!! $products->short_description !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="">Product Description</label>
                                                <textarea class="form-control" name="full_desc" id="full_desc" cols="30" rows="10">{!! $products->description !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pillsVariation" role="tabpanel"
                                aria-labelledby="pillsVariationTab">
                                <div class="container">
                                    <div class="rows">
                                        <div class="row">
                                            @foreach ($attributes as $value)
                                                <input type="hidden" id="edit_data" name="edit_data"
                                                    value="{{ $products->id }}">
                                                <div class="add_item row align-center">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput10">Attribute Name.*</label>
                                                            <input type="text" name="attribute[]"
                                                                class="form-select btn-square" id="attribute"
                                                                placeholder="Attribute" value="{{ $value->attribute }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput10">Attribute
                                                                Value.*</label>
                                                            <input type="text" name="attribute_value[]"
                                                                id="attribute_value" class="form-control for-height-input"
                                                                value="{{ $value->attribute_value }}">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-2"
                                                        style="padding-top: 28px; padding-bottom: 28px;">
                                                        <div class="form-group">
                                                            <span class="btn btn-success addeventmore">
                                                                <i class="fa fa-plus-circle"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div id="list-items"></div>
                                    </div>
                                </div>
                            </div>
                    </form>

             
                    <div class="tab-pane fade" id="pillsTags" role="tabpanel" aria-labelledby="pillsTagsTab">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form id="multiple_tags">
                                        @csrf
                                        <div class="mb-3" id="tags_name">
                                            <input type="hidden" id="tag_id" name="tag_id">
                                            @if(!empty($products->tags))
                                            <select class="form-control js-example-tokenizer" name="tags_value" id="tags_value" multiple="multiple">
                                                @foreach (json_decode($products->tags) as  $val)
                                                    <option selected="selected">{{$val}}</option>
                                                @endforeach

                                               </select>
                                               @endif
                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pillsImage" role="tabpanel" aria-labelledby="pillsImageTab">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">

                                    <form id="product_image" enctype="multipart/form-data">
                                        @csrf
                                        <div class="upload__box">
                                            <div class="upload__btn-box">
                                                <label class="upload__btn">
                                                    <p>+ Upload Main Product Image</p>
                                                    <input type="hidden" id="main_image_id" name="main_image_id">
                                                    <input type="file" name="single_image" id="single_photo"
                                                        class="upload__inputfile">
                                                        <input type="hidden" name="old-multiple" value="{{$products->multiple_image}}">
                                                </label>
                                                {{-- <button class="startUploadButton">Start Upload</button>
                                            <button class="cancelUploadButton">Cancel Upload</button>
                                            <button class="imageDeleteButton">Delete</button> --}}
                                            </div>
                                            <div class="upload__img-wrap" id="singlephoto">

                                            </div>
                                        </div>
                                        <div class="upload__img-wrap">

                                            {{-- <div class="uploadImage"> --}}
                                            {{-- update work --}}
                                            <div class="editImagesBox">
                                                <div class="editImages">
                                                    <div id="imgPreview"></div>
                                                </div>
                                                @if (!empty($products->image))
                                                    <div class="editImages">
                                                        <img src="{{ url('public/products/' . $products->image) }}"
                                                            alt="">
                                                    </div>
                                                @endif
                                            </div>
                                            {{-- update work --}}
                                            {{-- </div> --}}
                                            {{-- <div class="imageName">
                                                <span>Image Name</span>
                                            </div> --}}
                                            <div>
                                                <button class="startUploadButton smallButton singleimage">Save</button>
                                                {{-- <button class="imageDeleteButton smallButton">Delete</button> --}}
                                            </div>

                                        </div>
                                    </form>
                                    <form id="multi_image" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{ $products->multiple_image }}"
                                            name="old_multiple">
                                        <div class="upload__box">
                                            <div class="upload__btn-box">
                                                <label class="upload__btn">
                                                    <p>+ Upload Multiple Product Images</p>
                                                    <input type="hidden" id="multiple_image_id"
                                                        name="multiple_image_id">
                                                    <input type="file" name="image[]" id="multi_photo"
                                                        class="upload__inputfile" multiple>
                                                </label>
                                                {{-- <button class="startUploadButton">Start Upload</button>
                                            <button class="cancelUploadButton">Cancel Upload</button>
                                            <button class="imageDeleteButton">Delete</button> --}}
                                            </div>
                                            <div class="upload__img-wrap" id="next">

                                            </div>

                                        </div>
                                        <div class="upload__img-wrap">
                                            {{-- update work --}}
                                            {{-- <div class="uploadImage"> --}}
                                            <div class="editImagesBox">
                                                @if (!empty($products->multiple_image))
                                                    @foreach (json_decode($products->multiple_image) as $key => $image)
                                                        <div class="editImages">
                                                            <img src="{{ url('public/products/' . $image) }}"
                                                                alt="">

                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>


                                            {{-- </div> --}}
                                            <div>
                                                <button class="startUploadButton smallButton">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                  
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>


    <!-- {{-- script start --}} -->

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
       $(".js-example-tokenizer").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        })
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
                            $(".loader-bg").removeClass('loader-active');
                        },
                        success: function(response) {
                            $(".loader-bg").addClass('loader-active');
                            $('#main-category_id').html('');
                            if (response != '') {
                                $.each(response.maincategory, function(value, i) {
                                    $('#main-category_id').append(
                                        `<option   value ="${i.id}" >${i.main_category_name}</option>`
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
        <script>
            $(document).ready(function() {
                var id = ($('select[name="parent_category_id"]').val());
                $.ajax({
                    type: "GET",
                    url: '{{ route('get_main_category') }}',
                    data: {
                        'id': id
                    },
                    beforeSend: function() {
                        $(".loader-bg").removeClass('loader-active');
                    },
                    success: function(response) {
                        $(".loader-bg").addClass('loader-active');
                        $('#main-category_id').html('');
                        if (response != '') {
                            $.each(response.maincategory, function(value, i) {
                                var main_cat_id = $("#main_cat_id").val(i.id);
                                var select = (i.id == i.main_category_name ? 'selected="selected"' :
                                    '');
                                $('#main-category_id').append(
                                    `<option  value ="${i.id}" ${select}>${i.main_category_name}</option>`
                                    );

                            });
                        } else {
                            $('#main-category_id').append('<h3>No Category Found</h3>');
                        }
                    }
                });
            });
        </script>
        <script>
            setTimeout(() => {
                var id = ($('select[name="main_category_id"]').val());
                $.ajax({
                    type: "GET",
                    url: '{{ route('get_sub_category') }}',
                    data: {
                        'id': id
                    },
                    beforeSend: function() {
                        $(".loader-bg").removeClass('loader-active');
                    },
                    success: function(response) {
                        $(".loader-bg").addClass('loader-active');
                        $('#sub-category_id').html('');
                        if (response != '') {
                            $.each(response.subcategory, function(value, i) {
                                var select = (i.id == i.sub_category_name ? 'selected="selected"' :
                                    '');
                                $('#sub-category_id').append(
                                    `<option  value ="${i.id}" ${select}>${i.sub_category_name}</option>`
                                    );

                            });
                        } else {
                            $('#sub-category_id').append('<h3>No Category Found</h3>');
                        }
                    }
                });
            }, 1000);
        </script>


        {{-- brand  --}}
        <script>
            $(document).ready(function() {
                var id = ($('select[name="parent_category_id"]').val());
                $.ajax({
                    type: "GET",
                    url: '{{ route('get_brand_name') }}',
                    "dataSrc": "",
                    data: {
                        'id': id
                    },
                    beforeSend: function() {
                        $(".loader-bg").removeClass('loader-active');
                    },
                    success: function(response) {
                        $(".loader-bg").addClass('loader-active');
                        $('#brand_id').html('');
                        if (response != '') {
                            $.each(response.brand, function(value, i) {
                                $('#brand_id').append(
                                    `<option  value ="${i.id}" >${i.brand_name}</option>`
                                );
                            });
                        } else {
                            $('#brand_id').append('<h3>No Category Found</h3>');
                        }
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('#main-category_id').on('click', function() {
                    var id = $(this).val();
                    $.ajax({
                        type: "GET",
                        url: '{{ route('get_sub_category') }}',
                        "dataSrc": "",
                        data: {
                            'id': id
                        },
                        beforeSend: function() {
                            $(".loader-bg").removeClass('loader-active');
                        },
                        success: function(response) {
                            $(".loader-bg").addClass('loader-active');
                            $('#sub-category_id').html('');
                            if (response != '') {
                                $.each(response.subcategory, function(value, i) {
                                    $('#sub-category_id').append(
                                        `<option  value ="${i.id}" >${i.sub_category_name}</option>`
                                    );
                                });
                            } else {
                                $('#sub-category_id').append('<h3>No Category Found</h3>');
                            }
                        }
                    });
                });
            });
        </script>

      
        <script>
            $(":input").on("keyup change", function(e) {
                var price = $("#price").val();
                var discount = $("#discount").val();
                var total = price - discount;
                console.log(total);
                var final = $("#total_price").val(total);

            })
        </script>

    @endpush
@endsection
