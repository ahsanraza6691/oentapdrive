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
                            <button class="nav-link stocks" id="pillsStockTab" data-bs-toggle="pill"
                                data-bs-target="#pillsStock" type="button" role="tab" aria-controls="pillsStockTab"
                                aria-selected="true">Stocks</button>
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
                                                <select id="main-category_id" for="exampleFormControlInput10"
                                                    class="form-control btn-square type" name="main_category_id">

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Select Main Category.*</label>
                                                <select id="main-category_id" for="exampleFormControlInput10"
                                                    class="form-control btn-square type" name="main_category_id">

                                                </select>
                                            </div>
                                        </div>
                                    </div> --}}
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
                                    {{-- <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Select Brand.*</label>
                                                <select id="brand_id" for="exampleFormControlInput10"
                                                    class="form-control btn-square type" name="brand_id">

                                                </select>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Product Name</label>
                                                <input class="form-control" id="product_name" type="text"
                                                    placeholder="Enter Product Title" data-bs-original-title=""
                                                    title="" name="product_name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Product SKU</label>
                                                <input class="form-control" id="sku" type="number"
                                                    placeholder="Enter Product SKU" data-bs-original-title=""
                                                    title="" name="sku">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Product SKU</label>
                                                <input class="form-control" id="sku" type="number"
                                                    placeholder="Enter Product SKU" data-bs-original-title=""
                                                    title="" name="sku">
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Product Price</label>
                                                <input class="form-control" type="number" id="price"
                                                    placeholder="Enter Product Price" data-bs-original-title=""
                                                    title="" name="price">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Enter Discount If any</label>
                                                <input class="form-control" id="discount" type="number" id="discount"
                                                    placeholder="Enter Product Discount Price" data-bs-original-title=""
                                                    title="" name="discount">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Enter Discount If any</label>
                                                <input class="form-control" id="discount" type="number" id="discount"
                                                    placeholder="Enter Product Discount Price" data-bs-original-title=""
                                                    title="" name="discount">
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Total Price</label>
                                                <input class="form-control" type="number" id="total_price"
                                                    placeholder="Enter Product Price" data-bs-original-title=""
                                                    title="" name="total_price">
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Image </label>
                                                <input type="file" class="form-control" id="product_image"
                                                    name="product_image">
                                            </div>
                                        </div> --}}
                                    </div>
                                    {{-- <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Image </label>
                                                <input type="file" class="form-control" id="product_image"
                                                    name="product_image">
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="">Short Description</label>
                                                <textarea class="form-control editor" name="short_description" id="short_description" cols="30"
                                                    rows="10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="">Product Description</label>
                                                <textarea class="form-control editor" name="description" id="description" cols="30" rows="10"></textarea>
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
                                            <div class="add_item row align-center">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput10">Attribute Name.*</label>

                                                        <input type="text" name="attribute"
                                                            class="form-select btn-square" id="attribute"
                                                            placeholder="Attribute">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput10">Attribute Value.*</label>
                                                        <input type="text" name="attribute_value" id="attribute_value"
                                                            class="form-control for-height-input">

                                                    </div>
                                                </div>
                                                <div class="col-md-2" style="padding-top: 28px; padding-bottom: 28px;">
                                                    <div class="form-group">
                                                        <span class="btn btn-success addeventmore">
                                                            <i class="fa fa-plus-circle"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="list-items"></div>
                                    </div>
                                </div>
                            </div>
                    </form>

                    <div class="tab-pane fade" id="pillsStock" role="tabpanel" aria-labelledby="pillsStockTab">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">

                                        <label>Add Attibutes(size,color)</label>
                                        <div class="" id="stock">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pillsTags" role="tabpanel" aria-labelledby="pillsTagsTab">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form id="multiple_tags">
                                        @csrf
                                        <div class="mb-3" id="tags_name">
                                            <input type="hidden" id="tags_id" name="tags_id">
                                            <input type="text" name="tags_value" class="form-control" id="tags_value"
                                                placeholder="Enter Tags">
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
                                    <form id="multi_image" enctype="multipart/form-data">
                                        @csrf
                                        <div class="upload__box">
                                            <div class="upload__btn-box">
                                                <label class="upload__btn">
                                                    <p>+ Upload Multiple Product Images</p>
                                                    <input type="hidden" id="multiple_image_id"
                                                        name="multiple_image_id">
                                                    <input type="file" name="image[]" id="multi_photo" class="upload__inputfile"
                                                        multiple>
                                                </label>
                                                {{-- <button class="startUploadButton">Start Upload</button>
                                            <button class="cancelUploadButton">Cancel Upload</button>
                                            <button class="imageDeleteButton">Delete</button> --}}
                                            </div>
                                        </div>
                                        <div class="upload__img-wrap">
                                            <div class="uploadImage">
                                                <div id="image_preview"></div>
                                            </div>
                                            {{-- <div class="imageName">
                                                <span>Image Name</span>
                                            </div> --}}
                                            <div>
                                                <button class="startUploadButton smallButton">Save</button>
                                                {{-- <button class="imageDeleteButton smallButton">Delete</button> --}}
                                            </div>
                                        </div>
                                    </form>
                                    <form id="product_image" enctype="multipart/form-data">
                                        @csrf
                                        <div class="upload__box">
                                            <div class="upload__btn-box">
                                                <label class="upload__btn">
                                                    <p>+ Upload Main Product Image</p>
                                                    <input type="hidden" id="main_image_id"
                                                        name="main_image_id">
                                                    <input type="file" name="single_image" id="single_photo" class="upload__inputfile"
                                                        >
                                                </label>
                                                {{-- <button class="startUploadButton">Start Upload</button>
                                            <button class="cancelUploadButton">Cancel Upload</button>
                                            <button class="imageDeleteButton">Delete</button> --}}
                                            </div>
                                        </div>
                                        <div class="upload__img-wrap">
                                            <div class="uploadImage">
                                                <img id="imgPreview" src="#" alt="pic" />

                                            </div>
                                            {{-- <div class="imageName">
                                                <span>Image Name</span>
                                            </div> --}}
                                            <div>
                                                <button class="startUploadButton smallButton singleimage">Save</button>
                                                {{-- <button class="imageDeleteButton smallButton">Delete</button> --}}
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
        <script>
            // $(document).ready(function(){
            //     $('.test_class').on("click",function(){
            //      var origional_id = $("#data-id").val();
            //      console.log(origional_id);
            //      return false;
            //     })
            // });
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
                        // dataType: 'json',
                        //  cache: false,
                        success: function(response) {
                            // $("#pageloader").hide();
                            $('#main-category_id').html('');
                            // $("#main-category_id").append(`<optgroup label="Please Select Parent Category">`);
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
            var id = ($('select[name="parent_category_id"]').val());
            $.ajax({
                type: "GET",
                url: '{{ route('get_main_category') }}',
                data: {
                    'id': id
                },
                success: function(response) {
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
            var id = ($('select[name="main_category_id"]').val());
            $.ajax({
                type: "GET",
                url: '{{ route('get_sub_category') }}',
                data: {
                    'id': id
                },
                success: function(response) {
                    // console.log(response.clients);
                    $('#sub-category_id').html('');
                    if (response != '') {
                        $.each(response.subcategory, function(value, i) {
                            var select = (i.id == i.sub_category_name ? 'selected="selected"' : '');
                            // console.log(test);
                            $('#sub-category_id').append(
                                `<option  value ="${i.id}" ${select}>${i.sub_category_namee}</option>`);

                        });
                    } else {
                        $('#sub-category_id').append('<h3>No Category Found</h3>');
                    }
                }
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
                        success: function(response) {
                            // $("#pageloader").hide();
                            $('#sub-category_id').html('');
                            // $("#main-category_id").append(`<optgroup label="Please Select Parent Category">`);
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

        {{-- brand  --}}
        <script>
            $(document).ready(function() {
                $('#main-category_id').on('click', function() {
                    var id = $(this).val();
                    $.ajax({
                        type: "GET",
                        url: '{{ route('get_brand_name') }}',
                        "dataSrc": "",
                        data: {
                            'id': id
                        },
                        // dataType: 'json',
                        //  cache: false,
                        success: function(response) {
                            // console.log(response.clients);
                            // $("#pageloader").hide();
                            $('#brand_id').html('');
                            // $("#main-category_id").append(`<optgroup label="Please Select Parent Category">`);
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
            });
        </script>

        <script type="text/javascript">
            $('.extra-fields-customer').click(function() {
                $('.customer_records').clone().appendTo('.customer_records_dynamic');
                $('.customer_records_dynamic .customer_records').addClass('single remove');
                $('.single .extra-fields-customer').remove();
                $('.single').append(
                    '<span  class="btn btn-danger remove-field btn-remove-customer"><i class="fa fa-minus-circle"></i></span>'
                );
                $('.customer_records_dynamic > .single').attr("class", "remove");

                $('.customer_records_dynamic input').each(function(val, index) {
                    var count = 0;
                    var fieldname = $(this).attr("name");
                    $(this).attr('name', fieldname + index);
                    count++;
                });

            });

            $(document).on('click', '.remove-field', function(e) {
                $(this).parent('.remove').remove();
                e.preventDefault();
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

        <script>
            $(document).ready(function() {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $(".stocks").on('click', function(e) {
                    e.preventDefault();
                    // alert(product_image);
                    var form = $("#product");
                    let arr = Array.from($(".data_counter"));
                    let item = arr[arr.length - 1];
                    console.log($(".data_counter").length);
                    $.ajax({
                        enctype: 'multipart/form-data',
                        url: "{{ route('product.store') }}",
                        type: 'POST',
                        data: form.serialize() + "&list_count=" + $(".data_counter").length,
                        dataType: 'JSON',
                        success: function(response, data) {
                            $('#stock').html('');
                            $.each(response.get_products_attributes, function(value, i) {
                                $('#stock').append(
                                    `
                                        <form id="quantity" class="quantityBox">
                                            @csrf
                                        <input type="hidden"  id="data-id" value="${i.id}">

                                        <input class="form-control" name="attribute_value" type="text" value="${i.attribute_value}"
                                                placeholder="Enter Labels">


                                            <input class="form-control" id="stock_value" name="stock[]" type="text"
                                                placeholder="Enter Quantity">

                                                <button  type="button" class="btn btn-success test_class" id="save_data" data-id="${i.id}">save</button>

                                         </form>`
                                );
                            });
                            if (response.status == 400) {
                                // work here for stock adding using html using each loop
                                $.each(response.errors, function(prefix, val) {
                                    toastr.error(val[0]);
                                });
                            } else {
                                toastr.success('Your Product has been sent successfully');
                                $('#product')[0].reset();
                            }
                        }
                    });

                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                var counter = 0;
                $(document).on("click", ".addeventmore", function() {

                    var html = `
                    <div class="row remove_list_${counter}">
                        <div class="add_item row align-center">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleFormControlInput10">Attribute Name.*</label>
                                        <input  type="text"  name="attribute${counter}" id="attribute${counter}" class="form-select btn-square data_counter"
                                        placeholder="Attribute" data-counter="${counter}" onchange="changeServiceType(this);">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleFormControlInput10">Attribute Value.*</label>
                                    <input type="text" name="attribute_value${counter}" id="attribute_value${counter}"
                                        class="form-control for-height-input">

                                </div>
                            </div>
                            <div class="col-md-2" style="padding-top: 28px; padding-bottom: 28px;">
                                <div class="form-group">
                                    <span class="btn btn-success addeventmore">
                                        <i class="fa fa-plus-circle"></i></span>
                                        <span class="btn btn-danger" onclick="removeItem(${counter})"><i
                                                            class="fa fa-minus-circle"></i></span>
                                </div>

                            </div>
                        </div>
                    </div>
                    `;


                    counter++;

                    $("#list-items").append(html);
                    // var whole_extra_item_add = $('#whole_extra_item_add').html();
                    // $(this).closest(".add_item").append(whole_extra_item_add);
                    // whole_extra_item_add.find()
                    // counter++;
                    // $("#attribute").attr("id", "attribute" + counter);
                    // $("#attribute").attr("name", `attribute${counter}`);
                    // $("#attribute_value").attr("id", "attribute_value" + counter);
                    // $("#attribute_value").attr("name", "attribute_value" + counter);
                    // localStorage.setItem('count_item', counter);

                });

                // $(document).on("click", '.removeeventmore', function(event) {
                //     $(this).closest(".delete_whole_extra_item_add").remove();
                //     counter -= 1
                // });
            });


            function removeItem(row_id) {

                $(".remove_list_" + row_id).remove();
            }
        </script>
        <script>
            $(document).ready(function() {
                $(document).on("click", "#save_data", function() {

                    // var origional_id = $("#data-id").val();
                    //  var id = $("#data-id").val();
                    var id = $(this).attr('data-id');
                    // return false;
                    // var stock = $("#stock_value").val();
                    // used for same input name with different value
                    var pqid = $(this).parent("form").find("#stock_value").val();
                    // alert(pqid);
                    // return fasle;
                    $.ajax({
                        url: "{{ route('save_quantity', 'id') }}",
                        type: 'GET',
                        data: {
                            "id": id,
                            "stock": pqid,
                        },
                        success: function(response, data) {
                            console.log(response);
                            // console.log(response);
                            if (response.status == 400) {
                                $.each(response.errors, function(prefix, val) {
                                    toastr.error(val[0]);
                                });
                            } else {
                                toastr.success('Product Quantity saved');
                                $('#quantity')[0].reset();
                            }
                        }
                    });
                });
            });
        </script>



        <script>
            $(document).ready(function() {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $('.tags').on('click', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: "{{ route('get_products') }}",
                        type: 'GET',
                        dataType: 'JSON',
                        success: function(response, data) {
                            var products = response.get_products;
                            var tags_id = $("#tags_id").val(products.id);
                            var multiple_image_id = $("#multiple_image_id").val(products.id);
                            var main_image_id = $("#main_image_id").val(products.id);
                            if (response.status == 400) {} else {
                                // toastr.success('tags');
                                $('#tags')[0].reset();
                            }
                        }
                    });

                });
            });
        </script>

        <script>
            $(document).ready(function() {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $('.save_tags').on('click', function(e) {
                    e.preventDefault();
                    var id = $("#tags_id").val();
                    var tags_value = $("#tags_value").val();
                    $.ajax({
                        url: "{{ route('save_tags', 'id') }}",
                        type: 'GET',
                        data: {
                            "id": id,
                            "tags_value": tags_value
                        },
                        dataType: 'JSON',
                        success: function(response, data) {
                            var products = response.get_products;
                            var multiple_image_id = $("#multiple_image_id").val(products.id);
                            var single_image_id = $("#single_image_id").val(products.id);
                            if (response.status == 400) {} else {
                                // toastr.success('tags');
                                $('#tags')[0].reset();
                            }
                        }
                    });

                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $("#multi_image").on('submit', function(e) {
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var formData = new FormData(this);
                    var id = $("#multiple_image_id").val();
                    // alert(id);
                    // formData.append(id);
                    // alert(id);
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('multiple_image') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,

                        success: function(response, data) {
                            if (response.status == 400) {
                                $.each(response.errors, function(prefix, val) {
                                    toastr.error(val[0]);
                                });
                            } else {
                                toastr.success('Images Uploaded Successfully !');
                                $('#multi_image')[0].reset();
                            }
                        }

                    });
                });
            });
        </script>
        <script>
            $(document).ready(() => {
                $("#multi_photo").change(function () {
                    var total_file=document.getElementById("multi_photo").files.length;
                    for(var i=0;i<total_file;i++)
                    {
                    $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'><br>");
                    }
                });
            });
        </script>
        <script>
            $(document).ready(() => {
                $("#single_photo").change(function () {
                    const file = this.files[0];
                    if (file) {
                        let reader = new FileReader();
                        reader.onload = function (event) {
                            $("#imgPreview")
                              .attr("src", event.target.result);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });
        </script>
         <script>
            $(document).ready(function() {
                $("#product_image").on('submit', function(e) {
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var formData = new FormData(this);
                    var id = $("#main_image_id").val();
                    // alert(id);
                    // formData.append(id);
                    // alert(id);
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('single_image') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,

                        success: function(response, data) {
                            if (response.status == 400) {
                                $.each(response.errors, function(prefix, val) {
                                    toastr.error(val[0]);
                                });
                            } if(response.status == 200){
                                toastr.success('Product Main Image Uploaded Successfully!');
                                $('#product_image')[0].reset();
                            }
                        }

                    });
                });
            });
        </script>
    @endpush
@endsection


{{-- main stock --}}
{{-- $('#stock').append(
`
<form id="quantity" class="quantityBox">
    @csrf
    <input type="hidden" id="data-id" value="${i.id}">
    <div class="col-md-4">
        <input class="form-control" name="attribute_value" type="text" value="${i.attribute_value}"
            placeholder="Enter Labels">
    </div>
    <div class="col-md-4">
        <input class="form-control" id="stock_value" name="stock[]" type="text" placeholder="Enter Quantity">
    </div>
    <div class="col-md-2" style="padding-top: 20px; padding-bottom: 20px;">
        <button type="button" class="btn btn-success test_class" id="save_data" data-id="${i.id}">save</button>
    </div>
</form>`
); --}}
