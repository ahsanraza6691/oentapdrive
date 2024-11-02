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
        button#pillsImageTab,
        button.cstm_buttons {
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
        .edit-attribute-product{
    display: none;
}
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card tabsBox">
                    <ul class="nav nested nav-pills mb-3" id="pills-tab" role="tablist">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link active cstm_buttons">Product</button>
                        </li>

                        
                        @if ($products->product_type == 2)
                        <a href="{{ route('edit.product_attributes', ['id' => $id]) }}"
                            class="validation edit-product">
                            <button class="nav-link cstm_buttons">Attribute</button>
                        </a>
                        @endif

                        @if (!empty($id))
                            <a href="{{ route('edit.product_attributes', ['id' => $id]) }}"
                                class="validation edit-attribute-product">
                                <button class="nav-link cstm_buttons">Attribute</button>
                            </a>
                        @else
                            <li class="nav-item" role="presentation">
                                <button class="nav-link button cstm_buttons">Attribute</button>
                            </li>
                        @endif

                        <li class="nav-item" role="presentation" id="variat_tab">
                            @if (empty($product->product_variants[0]->product_attributes))
                                <button class="nav-link cstm_buttons attribute_validation">Variations</button>
                            @else

                            


                            @if (session()->has('collections'))
                                <a href="{{ route('add.product_variation') }}">
                                    <button class="nav-link cstm_buttons">Variations</button>
                                </a>
                            @else
                                
                                @if ($product->product_variants[0]->product_attributes)
                                <a href="{{ route('edit.product_variation',['id' => $product->id]) }}">
                                    <button class="nav-link cstm_buttons">Variations</button>
                                </a>
                                @else
                                    <button class="nav-link cstm_buttons attribute_validation">Variations 46465</button>
                                @endif

                            @endif

                                
                            @endif
                        </li>

                    </ul>
                    <form id="product" action="{{ route('update-prevdata', $products->id) }}" enctype="multipart/form-data"
                        method="POST">
                        @csrf
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-lg-6 col-md-6">
                                    <label for="">Product Type.*</label>
                                    <div class="select-dropdown">
                                        <select class="form-control" id="product_type" name="product_type" readonly="true">

                                            @if ($products->product_type == 1)
                                            <option value="1" class="simple" {{ $products->product_type == 1 ? 'selected' : '' }} readonly="true">Simple product</option>
                                            @else
                                            <option value="2" class="variant" {{ $products->product_type == 2 ? 'selected' : '' }} readonly="true">Variable product </option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label>Product Name</label>
                                        <input class="form-control" id="product_name" type="text"
                                            placeholder="Enter Product Title" data-bs-original-title="" title=""
                                            name="product_name" value="{{ $products->product_name ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label>Primary Image</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                    </div>
                                    <img src="{{ url('public/products/' . $products->image) }}" alt=""
                                        height="100px" width="50px">
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label>Product SKU</label>
                                        <input class="form-control" id="sku" type="text"
                                            placeholder="Enter Product SKU" data-bs-original-title="" title=""
                                            name="sku" value="{{ $products->sku ?? '' }}" readonly>
                                    </div>
                                </div>
                            </div>

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
                                        <select id="main-category_id" for="exampleFormControlInput10"
                                            class="form-control btn-square type" name="main_category">
                                            @foreach ($main_categories as $main)
                                                <option id="parent_category_id" value="{{ $main->id }}"
                                                    {{ $main->id == $products->main_category_id ? 'selected' : '' }}
                                                    class="form-control btn-square">
                                                    {{ $main->main_category_name }}
                                                </option>
                                            @endforeach
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
                                            @foreach ($sub_categories as $sub)
                                                <option id="parent_category_id" value="{{ $sub->id }}"
                                                    {{ $sub->id == $products->sub_category_id ? 'selected' : '' }}
                                                    class="form-control btn-square">
                                                    {{ $sub->sub_category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label>Select Brand.*</label>
                                        <select id="brand_id" for="exampleFormControlInput10"
                                            class="form-control btn-square type" name="brand_id">
                                            @foreach ($brand as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ $value->id == $products->brand_id ? 'selected' : '' }}>
                                                    {{ $value->brand_name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


                            {{-- @if ($products->product_type == 1) --}}
                            <div class="row mt-4 mb-4" id="discounted_id" style="display:none;">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput10">Regular price.*</label>
                                        <input type="text" class="form-control regularPrice salePrice" placeholder="Regular price"
                                            id="regular_price" name="regular_price"
                                            value="{{ $products->total_price ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput10">Sale price.* <span
                                                class="schedule">Schedule</span></label>
                                        <input type="text" class="form-control salePrice" placeholder="Sale price"
                                            id="sale_price" name="sale_price" value="{{ $products->sale_price ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput10">Quantity.*</label>
                                        <input type="text" class="form-control salePrice" placeholder="Quantity" id="quantity"
                                            name="quantity" value="{{ $products->quantity ?? '' }}">
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-4 mb-4 data" style="display: none" id="sale">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput10">Sale start
                                            date.*</label>
                                        <input type="date" class="form-control" placeholder="Sale start date"
                                            id="sale_start" name="sale_start"
                                            value="{{ !empty($products->sale_start) ? date_format(date_create($products->sale_start), 'Y-m-d') : null }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput10">Sale end date.*</label>
                                        <input type="date" class="form-control" placeholder="Sale end date"
                                            id="sale_end" name="sale_end"
                                            value="{{ !empty($products->sale_end) ? date_format(date_create($products->sale_end), 'Y-m-d') : null }}">
                                    </div>
                                </div>
                            </div>
                            {{-- @endif --}}
                            <div class="row">
                                <div class="col-md-6 stock_status_class" 
                                @if ($products->product_type == 2)
                                    id="stock_status"
                                @endif>
                                    <div class="mb-3">
                                        <label>Stock status</label>
                                        <select class="form-control" name="stock" id="shipping">
                                            <option value="1" {{ $products->stock == 1 ? 'selected' : '' }}>In Stock</option>
                                            <option value="2" {{ $products->stock == 2 ? 'selected' : '' }}>Out of stock</option>
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
                                                    <option value="{{ $shipping_fee->id }}" {{ $products->shipping == $shipping_fee->id ? 'selected' : '' }}>{{ $shipping_fee->zone_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="mb-3" id="tags_name">
                                        <label>Tags</label>
                                        <select class="form-control js-example-tokenizer" name="tags[]" id="tags_value"
                                            multiple="multiple">
                                            @if (!empty($products->tags))
                                                @foreach (json_decode($products->tags) as $val)
                                                    <option selected="selected">{{ $val }}</option>
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
                                        <textarea class="form-control" rows="3" name="short_description" id="short_description">{{ $products->short_description ?? '' }}"</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="">Product Description</label>
                                        <textarea class="form-control editor" name="description" id="description">{{ $products->description }}</textarea>
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
                    </form>
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
                
            })

            $(document).ready(function() {
                $('.data').hide()
                jQuery('.schedule').on('click', function() {
                    jQuery('.data').toggle();
                })

                $("#stock_status").hide();
            });


            $('.remove-tag').click(function() {
                $(".loader-bg").removeClass('loader-active');
            });



            // discount date
            $(".salePrice").keyup(function(e){ 
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
                    toastr.error('Sale end date must be greate than sale start date......');
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
            // discount date


        </script>

        <script>
            $(document).ready(function(e) {
                $("#product_type").on('change', function() {
                    var id = $(this).val();
                    if (id == 2) {
                        $("#discounted_id").hide();
                        $("#sale").hide();
                        $("#variat_tab").show();
                        $(".validation-product").show();
                        $(".edit-attribute-product").show();
                        // $(".edit-product").show();
                        $("#stock_status").hide();
                        $(".stock_status_class").hide();
                    }
                    if (id == 1) {
                        $('#discounted_id').show();
                        $("#sale").show();
                        $("#variat_tab").hide();
                        $(".validation-product").hide();
                        $(".edit-attribute-product").hide();
                        $(".edit-product").hide();
                        $("#stock_status").show();
                        $(".stock_status_class").show();
                    }
                });
            });
            var type = ($('select[name="product_type"]').val());
            if (type == 1) {
                $('#discounted_id').show();
                $("#sale").show();
                $("#variat_tab").hide();
            }
            if (type == 2) {
                $("#discounted_id").hide();
                $("#sale").hide();
                $("#variat_tab").show();
            }
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

            });

            $(".attribute_validation").on("click", function(){
                toastr.error("First create attributes.")
            });
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
