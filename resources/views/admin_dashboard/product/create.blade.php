@extends('admin_dashboard.layouts.master')
@section('content')
    @php
        $data_attributes = App\Models\BackendModels\Attribute::latest()->get();
        foreach ($data_attributes as $key => $value) {
            $data = App\Models\BackendModels\Attribute::where(['product_id' => $value->id])
                ->latest()
                ->get();
        }
        
    @endphp
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
        button#pillsImageTab,
        button.cstm_buttons{
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
        .active_btn {
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
            margin-right: 16px;
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

        /* updated Work */

        .uploadImageSave {
            display: flex;
            align-items: center;
            justify-content: end;
            width: 65%;
            margin: 16px 0px;
        }

        .editImages {
            width: 50%;
            height: 50%;
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
            border-right: unset !important
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover,
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:focus {
            background-color: #7366ff;
            color: #fff;
        }

        /* update work 8 */
        .select-dropdown,
        .select-dropdown * {
            position: relative;
        }

        .select-dropdown {
            position: relative;
            color: grey;

        }

        .select-dropdown select {
            background-color: transparent;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            color: grey;
        }

        .select-dropdown select:active,
        .select-dropdown select:focus {
            outline: none;
            box-shadow: none;
            color: grey;
        }

        .select-dropdown:after {
            content: "";
            position: absolute;
            top: 50%;
            right: 8px;
            width: 0;
            height: 0;
            margin-top: -2px;
            border-top: 5px solid #aaa;
            border-right: 5px solid transparent;
            border-left: 5px solid transparent;

        }

        .plusButton {
            padding: 6px 16px !important;
        }

        .addForm {
            padding: 1rem;
            background-color: #f3f3f3;
            box-shadow: 0px 0px 19px -4px #a0a8ee;
            margin-bottom: 24px;
        }

        /* update work */

        .addForm h6 {
            margin-bottom: 16px;
        }

        .form-check-input[type=checkbox] {
            border-radius: 0px !important;
        }

        .form-check-input:checked {
            background-color: #ff2446 !important;
            border-color: #ff2446 !important;
        }

        .form-check-input:focus {
            box-shadow: unset !important;
        }

        .form-check-label a {
            color: #000000;
        }

        .selectButtons {
            display: flex;
            justify-content: space-between;
        }

        .saveRedBtn {
            background-color: #ff2446 !important;
            border-color: #ff2446 !important;
        }

        .accordion-button:focus {
            border-color: 1px solid #ffffff !important;
            box-shadow: unset !important;
        }

        .accordion-button:not(.collapsed) {
            color: #000000 !important;
            background-color: #ffffff !important;
            border: 1px solid #c1c1c194 !important;
        }

        .accordion-button {
            border: 1px solid #c1c1c194 !important;
            padding: 10px !important;
        }

        .form-group a span {
            color: #000000;
        }


        .removeBtn a {
            color: red;
            font-size: 14px !important;
        }

        .accordion-item:first-of-type .accordion-button {
            border-radius: 0px !important;
        }

        .accordion-header button {
            border: 1px solid #c1c1c194 !important;
        }

        button.removeBtn {
            display: flex;
            padding: 11.7px 1.25rem;
            border: 1px solid #c1c1c194 !important;

        }

        .accordion-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .selectDropdown select {
            padding: 9.5px 1.25rem;
            width: 120px;
            border-radius: 0px !important;
            font-size: 14px;
        }

        .uploadImage {
            width: 60px;
            height: 60px;
            overflow: hidden;
            border-radius: 10px;
        }

        .uploadImage img {
            width: 100%;
            height: 100%;
            object-fit: cover;

        }

        .select-dropdown.selectDropdown {
            margin-right: 6px !important;
        }

        .saveAndCancel {
            display: flex;
            gap: 10px;
        }



        .imageWrapper {
            width: 65px;
            height: 65px;
            overflow: hidden;
            border-radius: 10px;
        }

        .imageWrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        button.file-upload {
            border: none;
            margin: 20px 0px;
            padding: 0px;
        }

        input.file-input {
            background-color: #6860612e !important;
            color: #fff !important;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            width: 120px;
            font-size: 12px;
            cursor: pointer;
        }

        .schedule {
            color: #ff2446;
            text-decoration: underline;
            cursor: pointer;
        }

        ::-webkit-file-upload-button {
            display: none;
        }
        .validation-product{
  display: none;
}
.create-attribute-product{
    display: none;
}
.select2.select2-container.select2-container--default.select2-container--below{
            height: 100% !important;
            border: 1px solid #ced4da;
            outline:none;
            border-radius: 0.25rem;
            padding: 0.375rem 0.75rem;
        }
        .select2-container--default.select2-container--focus .select2-selection--multiple {
    border: none !important;
}
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card tabsBox" id="tabs_id">

                      
                    <ul class="nav nested nav-pills mb-3" id="pills-tab" role="tablist">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link active cstm_buttons">Product</button>
                        </li>


                        
                        @if (session()->has('var_product_id'))
                            <a href="{{ route('show.product_attributes') }}">
                                <button class="nav-link cstm_buttons">Attribute</button>
                            </a>
                        @else
                            <li class="nav-item validation create-attribute-product" role="presentation">
                                <button class="nav-link button cstm_buttons">Attribute</button>
                            </li>
                        @endif
                        
                        <li class="nav-item">
                            <button class="nav-link cstm_buttons validation-product">Variations</button>
                        </li>


                      

                    </ul>


                    <form id="productForm" action="{{route('product.store')}}"  method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-lg-6 col-md-6">
                                    <label for="">Product Type.*</label>
                                    <div class="select-dropdown">
                                        <select class="form-control" id="product_type" name="product_type" >
                                            <option  value="1" class="simple" {{ old('product_type') == 1 ? 'selected' : '' }} >Simple product</option>
                                            <option  value="2" class="variant" {{ old('product_type') == 2 ? 'selected' : '' }} >Variable product</option>
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
                                            title="" name="product_name" value="{{old('product_name')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label>Primary Image</label>
                                        <input type="file" name="image" id="image" class="form-control"  onchange="loadFile(event)">
                                        <img id="output" width="100px"/>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label>Product SKU</label>
                                        <input class="form-control" id="sku" type="text"
                                            placeholder="Enter Product SKU" data-bs-original-title=""
                                            title="" name="sku" value="{{old('sku')}}">
                                    </div>
                                </div> --}}
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label>Select Parent Category.*</label>
                                        <select id="parent_category_id" name="parent_category_id"
                                            for="exampleFormControlInput10" class="form-control btn-square type">
                                            @foreach ($parent_categories as $parents)
                                                <option id="parent_category_id" {{ old('parent_category_id') == $parents->id ? "selected" : "" }} value="{{ $parents->id }}"
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
                                            class="form-control btn-square type" name="main_category">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label>Select Sub Category.*</label>
                                        <select id="sub-category_id" for="exampleFormControlInput10"
                                            class="form-control btn-square type" name="sub_category">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label>Select Brand.*</label>
                                        <select id="brand_id" for="exampleFormControlInput10"
                                            class="form-control btn-square type" name="brand_name">
                                            @foreach ($brand as $key =>  $value)
                                                <option  {{ old('brand_name') == $value->id ? "selected" : "" }} value="{{ $value->id }}" >{{ $value->brand_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="row mt-4 mb-4" id="discounted_id">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput10">Regular price.*</label>
                                        <input type="number" class="form-control regularPrice salePrice" placeholder="Regular price" id="regular_price" name="regular_price" value="{{old('regular_price')}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput10">Sale price.* <span
                                                class="schedule">Schedule</span></label>
                                        <input type="number" class="form-control salePrice" placeholder="Sale price" id="sale_price" name="sale_price" value="{{old('sale_price')}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput10">Quantity.*</label>
                                        <input type="text" class="form-control quantity" placeholder="Quantity" id="quantity" name="quantity" value="{{old('quantity')}}">
                                    </div>
                                </div>


                            </div>
                            <div class="row mt-4 mb-4 data" id="sale">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput10">Sale start
                                            date.*</label>
                                        <input type="date" class="form-control"
                                            placeholder="Sale start date" id="sale_start" name="sale_start">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput10">Sale end date.*</label>
                                        <input type="date" class="form-control"
                                            placeholder="Sale end date" id="sale_end" name="sale_end">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6" id="stock_status">
                                    <div class="mb-3">
                                        <label>Stock status</label>
                                        <select class="form-control" name="stock" id="shipping">
                                            <option value="1">In Stock</option>
                                            <option value="2">Out of stock</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- id="shipping_class" --}}
                                <div class="col-md-6" >
                                    <div class="mb-3">
                                        <label>Shipping class</label>
                                        <select class="form-control" name="shipping" id="shipping">
                                            @if (!empty($shipping_fees))
                                                @foreach ($shipping_fees as $shipping_fee)
                                                    <option {{ old('shipping') == $shipping_fee->id ? "selected" : "" }} value="{{ $shipping_fee->id }}">{{ $shipping_fee->zone_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                         
                                <div class="col-md-6">
                                    <div class="mb-3" id="tags_name">
                                        <label>Tags</label>
                                        {{-- <select class="form-control js-example-tokenizer" name="tags[]"
                                            id="tags_value"  multiple="multiple">
                                        </select> --}}
                                        <select class="form-control js-example-tokenizer" name="tags[]"
                                        id="tags_value"  multiple="multiple">
                                        @if (is_array(old('tags')))
                                            @foreach (old('tags') as $tag)
                                                <option value="{{ $tag }}" selected="selected">{{ $tag }}</option>
                                            @endforeach
                                        @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="">Short Description</label>
                                        <textarea class="form-control" rows="3" name="short_description" id="short_description">{{old('short_description')}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="">Product Description</label>
                                        <textarea class="form-control editor" name="description" id="description">{{old('description')}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <button class="cstm_buttons active_btn remove-tag" id="save_next_btn" type="submit">Save Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                    <div class="tab-content tabsContent" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pillsProduct" role="tabpanel"
                        aria-labelledby="pillsProductTab">
                            
                            </div>


                            <div class="tab-pane fade" id="pillsVariation" role="tabpanel"
                                aria-labelledby="pillsVariationTab">
                                <div class="container">
                                  

                                    
                                    <div id="variant_accordion_html">
                                        @include('admin_dashboard.partial.variant_accordion')
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

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">For Sale Modal</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row mt-2 mb-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput10">Sale Price.*</label>
                                <input type="text_variation" name="price_0" id="price_0"
                                    class="form-control for-height-input variation_value" placeholder="Enter Sale Price"
                                    data-bs-original-title="" title="">

                            </div>
                        </div>
                    </div>
                    <div class="row mt-2 mb-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput10">Sale Start Date.*</label>
                                <input type="date" name="price_0" id="price_0"
                                    class="form-control for-height-input variation_value" placeholder="Enter Start Date"
                                    data-bs-original-title="" title="">

                            </div>
                        </div>
                    </div>
                    <div class="row mt-2 mb-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput10">Sale End Date.*</label>
                                <input type="date" name="price_0" id="price_0"
                                    class="form-control for-height-input variation_value"
                                    placeholder="Enter Sale End Date" data-bs-original-title="" title="">

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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
                // tokenSeparators: [',', ' ']
            })
        </script>

        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
            integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <link href="https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.css"
            rel="stylesheet"> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

        <script>
            $(document).ready(function() {
                $('.data').hide()
                jQuery('.schedule').on('click', function() {
                    jQuery('.data').toggle();
                })
            });
         
            $(function() {
                $('.select').each(function() {
                    $(this).select2({
                        theme: 'bootstrap4',
                        width: 'style',
                        placeholder: $(this).attr('placeholder'),
                        allowClear: Boolean($(this).data('allow-clear')),
                    });
                });
            });
            $('.file-input').change(function() {
                var curElement = $(this).parent().parent().find('.image');
                // console.log(curElement);
                var reader = new FileReader();

                reader.onload = function(e) {
                    // get loaded data and render thumbnail.
                    curElement.attr('src', e.target.result);
                };

                // read the image file as a data URL.
                reader.readAsDataURL(this.files[0]);
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
                            var select = (i.id == i.main_category_name ? 'selected="selected"' : '');
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
                var discounted_price = price * discount / 100;
                console.log(discounted_price);

                var final = $("#discounted_price").val(price - discounted_price);

            });



            // discount date
            $(".salePrice").keyup(function(e){ 
                var num = this.value.match(/^\d+$/);
                
                if (num === null || num == 0) {
                    this.value = "";
                }
            });
            $(".quantity").keyup(function(e){ 
                var num = this.value.match(/^\d+$/);
                
                if (num === null || num == 0) {
                    this.value = "";
                }
            });


            $(".salePrice").change(function(e){ 
                var regular_price = $("#regular_price").val();
                var sale_price = $("#sale_price").val();

                if(parseInt(sale_price) >= parseInt(regular_price)){
                    toastr.error('Sorry, sale price must be less than regular price.');
                    $(".salePrice").val("");
                    $(".salePrice").focus();
                }
            });


            
            $(".salePrice").keyup(function(e){ 
                var regular_price = $("#regular_price").val();
                var sale_price = $("#sale_price").val();

                if(parseInt(sale_price) >= parseInt(regular_price)){
                    toastr.error('Sorry, sale price must be less than regular price.');
                    $(".salePrice").val("");
                    $(".salePrice").focus();
                }
            });


            $("#sale_end").on("change", function(){
                var sale_start = $("#sale_start").val();
                var sale_end = $("#sale_end").val();
                
                if(sale_start == '' && sale_end == ''){
                    $("#sale_start").removeClass('is-error');
                    $("#sale_end").removeClass('is-error');
                    $("#save_next_btn").attr('disabled', false);
                    $("#save_next_btn").removeClass("not-allowed");
                    return false;
                }


                if(sale_start != '' && sale_end != ''){

                    if(new Date(sale_start) >= new Date(sale_end)){
                        $("#sale_end").val("");
                        $("#sale_end").focus();
                        $("#sale_start").addClass('is-error');
                        $("#sale_start").focus();
                        $("#save_next_btn").attr('disabled', true);
                        $("#save_next_btn").addClass("not-allowed");
                        toastr.error('Sale end date must be greate than sale start date.');
                        return false;
                    }

                    
                    $("#sale_start").removeClass('is-error');
                    $("#sale_end").removeClass('is-error');
                    $("#save_next_btn").attr('disabled', false);
                    $("#save_next_btn").removeClass("not-allowed");
                    return false;
                }
                
                if(sale_end == '' && sale_start != ''){
                    $("#sale_start").focus();
                    $("#save_next_btn").attr('disabled', true);
                    $("#save_next_btn").addClass("not-allowed");
                    $("#sale_start").addClass('is-error');
                    // return false;
                }

                if(sale_end != '' && sale_start == ''){
                    $("#sale_start").focus();
                    $("#save_next_btn").attr('disabled', true);
                    $("#save_next_btn").addClass("not-allowed");
                    $("#sale_start").addClass('is-error');
                    // return false;
                }



                if(new Date(sale_start) >= new Date(sale_end)){
                    $("#sale_end").val("");
                    $("#sale_end").focus();
                    $("#sale_end").addClass('is-error');
                    $("#sale_end").focus();
                    $("#save_next_btn").attr('disabled', true);
                    $("#save_next_btn").addClass("not-allowed");
                    toastr.error('Sale end date must be greate than sale start date.');
                }


                // if(sale_start == ''){
                //     toastr.error('Please add sale start date.');
                //     $("#sale_start").addClass('is-error');
                //     $("#sale_start").focus();
                //     return false
                // }
                // if(new Date(sale_start) >= new Date(sale_end)){
                //     $("#sale_end").val("");
                //     $("#sale_end").focus();
                //     $("#sale_end").addClass('is-error');
                //     $("#sale_end").focus();
                //     toastr.error('Sale end date must be greate than sale start date.');
                // }

                // if(sale_start != '' && sale_end != ''){
                //     $("#save_next_btn").attr('disabled', false);
                //     $("#save_next_btn").removeClass("not-allowed");
                // }

                // if(sale_start == '' && sale_end == ''){
                //     $("#save_next_btn").attr('disabled', false);
                //     $("#save_next_btn").removeClass("not-allowed");
                // }

            });

            $("#sale_start").on("change", function(){
                var sale_start = $("#sale_start").val();
                var sale_end = $("#sale_end").val();

                if(sale_start == '' && sale_end == ''){
                    $("#sale_start").removeClass('is-error');
                    $("#sale_end").removeClass('is-error');
                    $("#save_next_btn").attr('disabled', false);
                    $("#save_next_btn").removeClass("not-allowed");
                    return false;
                }

                if(sale_start != '' && sale_end != ''){

                    if(new Date(sale_start) >= new Date(sale_end)){
                        $("#sale_end").val("");
                        $("#sale_end").focus();
                        $("#sale_end").addClass('is-error');
                        $("#sale_start").addClass('is-error');
                        $("#sale_start").focus();
                        $("#save_next_btn").attr('disabled', true);
                        $("#save_next_btn").addClass("not-allowed");
                        toastr.error('Sale end date must be greate than sale start date.');
                        return false;
                    }
                    
                    $("#sale_end").removeClass('is-error');
                    $("#sale_start").removeClass('is-error');
                    $("#save_next_btn").attr('disabled', false);
                    $("#save_next_btn").removeClass("not-allowed");
                    return false;
                }
                
                if(sale_start == '' && sale_end != ''){
                    $("#sale_start").focus();
                    $("#save_next_btn").attr('disabled', true);
                    $("#save_next_btn").addClass("not-allowed");
                    $("#sale_start").addClass('is-error');
                    return false;
                }

                if(sale_start != '' && sale_end == ''){
                    $("#sale_end").focus();
                    $("#save_next_btn").attr('disabled', true);
                    $("#save_next_btn").addClass("not-allowed");
                    $("#sale_end").addClass('is-error');
                    return false;
                }


                if(new Date(sale_start) >= new Date(sale_end)){
                    $("#sale_end").val("");
                    $("#sale_end").focus();
                    $("#sale_start").addClass('is-error');
                    $("#sale_start").focus();
                    $("#save_next_btn").attr('disabled', false);
                    $("#save_next_btn").removeClass("not-allowed");
                    toastr.error('Sale end date must be greate than sale start date.');
                }

            });
        </script>


        
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
       
        <script>

            function selectRefresh() {
                $('.select_2').select2({
                    tags: true,
                    placeholder: "Select attribute's values",
                    allowClear: true,
                    width: '100%'
                });
            }
            function selectAll(id){
                    $(`.select_${id} > option`).prop("selected", "selected");
                    $(`.select_${id}`).trigger("change");
               
            }
            function unselectAll(id){
                $(`.select_${id}`).val("-1").trigger("change");
            }
         
            
            $(document).ready(function() {
            selectRefresh();
            });


            // attribute tab


            // add variant
            function addVariant(){
                selectRefresh();
                var variant = $("#variants").val();
                var product_id = 20;

                $.ajax({
                    type: "POST",
                    url: "{{ route('add.product_variants') }}",
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id : product_id,
                        variant : variant,
                    },
                    beforeSend: function() {
                        $(".loader-bg").removeClass('loader-active');
                    },
                    success: function(response) {
                        $(".loader-bg").addClass('loader-active');
                        $("#variant_accordion_html").html(response.html);
                        selectRefresh();
                    }
                });
            }
            
            function removeVariantAttribute(variant_id, attribute_id){
                alert(variant_id)

                $.ajax({
                    type: "GET",
                    url: "{{ route('remove.product_variants') }}",
                    data: {
                         _token: '{{ csrf_token() }}',
                         variant_id:variant_id,
                         attribute_id:attribute_id
                    },
                    beforeSend: function() {
                        $(".loader-bg").removeClass('loader-active');
                    },
                    success: function(response) {
                        $(".loader-bg").addClass('loader-active');
                        $("#variant_accordion_html").html(response.html);
                        selectRefresh();
                    }
                });
            }
            
            // attribute tab


            $("#saveAttributeFrom").on("submit", function(e){
                e.preventDefault();
                
                const form = document.getElementById('saveAttributeFrom');
                const formData = new FormData(form);

                $.ajax({
                    type: "POST",
                    url: "{{ route('add.product_variants') }}",
                    data: formData,
                    cache : false,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        // $(".loader-bg").removeClass('loader-active');
                    },
                    success: function(response) {
                        // $(".loader-bg").addClass('loader-active');
                        // $("#variant_accordion_html").html(response.html);
                        // selectRefresh();
                        console.log(response);
                    }
                });
                
            });
        </script>



        <script>
            $('.remove-tag').click(function() {
                $(".loader-bg").removeClass('loader-active');
            });
            

            $(document).ready(function(e) {
            $("#product_type").on('change', function() {
                var id = $(this).val();
                if (id  == 2) {
                    $("#discounted_id").hide();
                    $("#variat_tab").show();
                    $("#sale").hide();
                    $(".validation-product").show();
                    $(".create-attribute-product").show();
                    $("#shipping_class").hide();
                    $("#shipping_class").hide();
                    $("#stock_status").hide();
                } if(id == 1){
                    $("#discounted_id").show();
                    $("#variat_tab").hide();
                    $(".validation-product").hide();
                    $(".create-attribute-product").hide();
                    $("#shipping_class").show();
                    $("#stock_status").show();
                }
            });
        });

        var type= ($('select[name="product_type"]').val());
        //  alert(type); 
        if (type  == 2) {
            $("#discounted_id").hide();
            $("#variat_tab").show();
            $("#sale").hide();
            $(".validation-product").show();
            $(".create-attribute-product").show();
            $("#shipping_class").hide();
        } if(type == 1){
            $("#discounted_id").show();
            $("#variat_tab").hide();
            $(".validation-product").hide();
            $(".create-attribute-product").hide();
            $("#shipping_class").show();
        }
        </script>

        <script>
            $(document).ready(function() {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $(".validation-product").on('click', function(e) {
                    e.preventDefault();
                        toastr.error("Please Save Product First !");
                });
                $(".validation").on('click', function(e) {
                    e.preventDefault();
                        toastr.error("Please Save Product First !");
                });
            });
        </script>

<script>
    var loadFile = function(event) {
        var reader = new FileReader();
        reader.onload = function(){
        var output = document.getElementById('output');
        output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };
</script>

<script language="javascript">
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;
    $('#sale_start').attr('min', today);
    $('#sale_end').attr('min', today);
</script>
    @endpush
@endsection
