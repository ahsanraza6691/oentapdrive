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


        .removeBtn {
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
    </style>
    <style>
        textarea.textAreaValue {
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            border: 1px solid #ced4da;
            resize: none;
            border-radius: 0.25rem;
            min-height: 150px;
            max-height: 150px;
        }

        textarea.textAreaValue:focus {
            outline-color: none !important;
            border-color: #86b7fe;
            outline: 0;
            -webkit-box-shadow: 0 0 0 0.25rem rgb(13 110 253 / 25%);
            box-shadow: 0 0 0 0.25rem rgb(13 110 253 / 25%);

        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card tabsBox" id="tabs_id">


                    <ul class="nav nested nav-pills mb-3" id="pills-tab" role="tablist">

                        <li class="nav-item" role="presentation">
                            <a href="{{ route('edit.product', $id) }}">
                                <button class="nav-link cstm_buttons">Product</button>
                            </a>





                        </li>
                        @if (session()->has('var_product_id') || session()->has('edit_product_id'))
                            <a href="{{ route('edit.product_attributes', ['id' => $id]) }}">
                                <button class="nav-link cstm_buttons">Attribute</button>
                            </a>
                        @else
                            <li class="nav-item" role="presentation">
                                <button class="nav-link button cstm_buttons attribute_validate">Attribute</button>
                            </li>
                        @endif

                        <li class="nav-item" role="presentation">
                            {{-- @if (session()->has('var_product_id'))
                                <a href="{{ route('show.product_attributes') }}">
                                    <button class="nav-link cstm_buttons">Attribute</button>
                                </a>
                            @else
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link button cstm_buttons">Attribute</button>
                                </li>
                            @endif --}}

                            <button class="nav-link active cstm_buttons">Variations</button>
                        </li>
                    </ul>



                    <div class="container">


                        <form action="{{ route('add.product_variation') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="accordion mb-3" id="accordionPanelsStayOpenExample">
                                {{-- {{ dd($collections) }} --}}
                                <input type="hidden" name="variations_id" value="{{ json_encode($variation_ids) }}">
                                @foreach ($product->product_variations as $key => $item)
                                    @php
                                        $attribute_ids_array = explode(',', $item->attribute_id);
                                    @endphp

                                    <div class="accordion-item">
                                        <h2 class="accordion-header">

                                            @if (!empty($product->product_variants))
                                                @foreach ($product->product_variants as $product_attribute)
                                                    <div class="select-dropdown selectDropdown">
                                                        <select
                                                            class="form-control edit_attribute_{{ $key }} detect_attribute_similarties"
                                                            name="attributes[]"
                                                            onchange="return edit_attribute('{{ $key }}')">
                                                            @foreach ($product_attribute->product_attributes as $attr)
                                                                <option
                                                                    value="{{ $attr->attribute_id }}"{{ in_array($attr->attribute_id, $attribute_ids_array) ? 'selected' : '' }}>
                                                                    {{ $attr->attribute }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endforeach
                                            @endif
                                            {{-- {{ in_array($attr->attribute_id,$attribute_values_array) == true ? 'selected' : ''}} --}}

                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#panelsStayOpen-{{ $key }}" aria-expanded="true"
                                                aria-controls="panelsStayOpen-{{ $key }}">

                                            </button>
                                            <button type="button" class="removeBtn"><a
                                                    href="{{ route('delete-variation', ['id' => $item->id]) }}"
                                                    onclick="return confirm('Are you sure, you want to delete it?')">Remove</a></button>
                                        </h2>
                                        <div id="panelsStayOpen-{{ $key }}" class="accordion-collapse collapse"
                                            aria-labelledby="panelsStayOpen-{{ $key }}">
                                            <div class="accordion-body">
                                                <div class="variationsBox">
                                                    <div class="row  mt-4 mb-4">
                                                        <div class="col-lg-6">
                                                            <div class="imageWrapper">
                                                                <img class="image"
                                                                    src="{{ $item->image ? asset('variations/' . $item->image) : asset('images/No-Image-Placeholder.svg') }}">
                                                            </div>
                                                            <button class="file-upload" type="button">
                                                                <input type="file" class="file-input" name="image[]">
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4 mb-4">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlInput10">Regular
                                                                    price.*</label>
                                                                <input type="text" class="form-control regular_price_{{ $key }} salePrice"
                                                                    name="regular_price[]"
                                                                    value="{{ $item->regular_price }}"
                                                                    placeholder="Regular price" onchange="regularPrice('{{ $key }}','')" id="regular_price_{{ $key }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlInput10">Sale price.* <span
                                                                        class="schedule">Schedule</span></label>
                                                                <input type="text" class="form-control sale_price_{{ $key }} salePrice"
                                                                    placeholder="Sale price" name="sale_price[]"
                                                                    value="{{ $item->sale_price }}" onchange="salePriceOnKeyChange('{{ $key }}','')" onkeyup="salePriceOnKeyUp('{{ $key }}','')" id="sale_price_{{ $key }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlInput10">Quantity.*</label>
                                                                <input type="text" class="form-control salePrice"
                                                                    placeholder="Quantity" name="quantity[]"
                                                                    value="{{ $item->quantity }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlInput10">SKU.*</label>
                                                                <input type="text" name="sku[]" class="form-control"
                                                                    placeholder="SKU" value="{{ $item->sku }}" readonly>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row mt-4 mb-4 data">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlInput10">Sale start
                                                                    date.*</label>
                                                                <input type="date" name="start_date[]"
                                                                    class="form-control sale_start sale_start_{{ $key }}"
                                                                    placeholder="Sale start date"
                                                                    value="{{ !empty($item->start_date) ? date_format(date_create($item->start_date), 'Y-m-d') : null }}" onchange="saleStartOnChange('{{ $key }}','')">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlInput10">Sale end
                                                                    date.*</label>
                                                                <input type="date" name="end_date[]"
                                                                    class="form-control sale_end sale_end_{{ $key }}"
                                                                    placeholder="Sale end date"
                                                                    value="{{ !empty($item->end_date) ? date_format(date_create($item->end_date), 'Y-m-d') : null }}" onchange="saleEndOnChange('{{ $key }}','')">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4 mb-4">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlInput10">Weight.*</label>
                                                                <input type="text" name="weight[]"
                                                                    class="form-control" placeholder="Weight"
                                                                    value="{{ $item->weight }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlInput10">Length.*</label>
                                                                <input type="text" name="length[]"
                                                                    class="form-control" placeholder="Length"
                                                                    value="{{ $item->length }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlInput10">Width.*</label>
                                                                <input type="text" name="width[]" class="form-control"
                                                                    placeholder="Width" value="{{ $item->width }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlInput10">Height.*</label>
                                                                <input type="text" name="height[]"
                                                                    class="form-control" placeholder="Height"
                                                                    value="{{ $item->height }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4 mb-4">
                                                        <div class="col-md-3">
                                                            <label for="exampleFormControlInput10">Stock status.*</label>
                                                            <div class="select-dropdown">
                                                                <select class="form-control" name="stock[]">
                                                                    {{-- <option value="" disabled selected>Stock status</option> --}}
                                                                    <option value="1"
                                                                        {{ $item->stock == 1 ? 'selected' : '' }}>In stock
                                                                    </option>
                                                                    <option value="2"
                                                                        {{ $item->stock == 2 ? 'selected' : '' }}>Out stock
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="col-md-3">
                                                            <label for="exampleFormControlInput10">Shipping class.*</label>
                                                            <div class="select-dropdown">
                                                                <select class="form-control" name="shipping[]">
                                                                    <option value="" disabled selected>Shipping Type</option>
                                                                    @if (!empty($shipping_fees))
                                                                        @foreach ($shipping_fees as $shipping_fee)
                                                                            <option value="{{ $shipping_fee->id }}" {{ $shipping_fee->id == $item->shipping  ? 'selected' : ''}}>{{ $shipping_fee->zone_name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="saveAndCancel">

                                        @if (count($product->product_variations) > 0)
                                            <button type="submit" class="btn btn-success saveRedBtn plusButton mr-2"
                                                data-bs-original-title="" title="">Save Attribute</button>

                                            <button type="button" class="btn btn-success saveRedBtn plusButton"
                                                data-bs-original-title="" title="">Cancel</button>
                                        @else
                                            <p>Variation(s) Not found!, go back and create it.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>

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

        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
            integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <link href="https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.css"
            rel="stylesheet">
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

            })
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

            function selectAll(id) {
                $(`.select_${id} > option`).prop("selected", "selected");
                $(`.select_${id}`).trigger("change");

            }

            function unselectAll(id) {
                $(`.select_${id}`).val("-1").trigger("change");
            }


            $(document).ready(function() {
                selectRefresh();

            });


            // attribute tab


            // add variant
            function addVariant() {
                selectRefresh();
                var variant = $("#variants").val();
                var product_id = "{{ session()->get('var_product_id') }}";
                // alert(variant);
                // return false;

                $.ajax({
                    type: "POST",
                    url: "{{ route('add.product_variants') }}",
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: product_id,
                        variant: variant,
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

            function removeVariant(variant_id, attribute_id) {
                alert(variant_id)

                $.ajax({
                    type: "GET",
                    url: "{{ route('remove.product_variants') }}",
                    data: {
                        _token: '{{ csrf_token() }}',
                        variant_id: variant_id,
                        attribute_id: attribute_id
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


            $(document).ready(function() {

                let total_attr_count = $(".detect_attribute_similarties").length;
                let attr_total_arr = [];
                $.each($(".detect_attribute_similarties"), function(indexInArray, valueOfElement) {
                    // console.log($(this).val())
                    attr_total_arr.push($(this).val());
                });

                function sliceIntoChunks(arr, chunkSize) {
                    const res = [];
                    for (let i = 0; i < arr.length; i += chunkSize) {
                        const chunk = arr.slice(i, i + chunkSize);
                        res.push(chunk);
                    }
                    return res;
                }


                // console.log(sliceIntoChunks(attr_total_arr, 2));


                // console.log(attr_total_arr.chunk(2))

            });

            add_variation=[];
            // attribute validation
            function edit_attribute(key) {

                // let row_attr_length = $('.edit_attribute_' + key).length;
                // let total_attr_count = $(".detect_attribute_similarties").length;
                // let attr_total_arr = [];
                // let row_attr_ids = [];


                let row_attr_length = $('.edit_attribute_' + key).length;
                let val = $('.edit_attribute_' + key);

                let total_attr_count = $(".detect_attribute_similarties").length;
                let attr_total_arr = [];
                let row_attr_ids = [];
                option = [];

                $.each($(val), function(indexInArray, valueOfElement) {
                    option.push($(this).val());
                });
                $.each($(add_variation), function(indexInArray, valueOfElement) {
                    console.log(indexInArray, valueOfElement, 'as', add_variation)
                    if (valueOfElement.key == key) {
                        console.log(valueOfElement.key, key, 'abc')
                        delete add_variation.key;

                    } else if (valueOfElement.key != key) {

                        console.log(disable = JSON.stringify(valueOfElement.option) === JSON.stringify(option))
                        if (disable) {
                            console.log(valueOfElement.key, key, 'def', valueOfElement.option, option)
                            // console.log('variation already exist')
                        }
                    }
                });

                var arr = {
                    'key': key,
                    "option": option
                };
                add_variation.push(arr);



                // old code by tofique
                // $.each($(".detect_attribute_similarties"), function (indexInArray, valueOfElement) {
                //     attr_total_arr.push($(this).val());
                // });

                // function sliceIntoChunks(arr, chunkSize) {
                //     const res = [];
                //     for (let i = 0; i < arr.length; i += chunkSize) {
                //         const chunk = arr.slice(i, i + chunkSize);
                //         res.push(chunk);
                //     }
                //     return res;
                // }






                // $.each($('.edit_attribute_'+key), function (indexInArray, valueOfElement) {
                //     row_attr_ids.push($(this).val());
                //     // console.log($(this).val())
                // });

                // let all_attr_arr_chunks = sliceIntoChunks(attr_total_arr, row_attr_length);
                // // console.log(all_attr_arr_chunks)
                // // console.log(row_attr_ids)



                // var array1 = [4,8,9,10];
                // var array2 = [4,8,9,10];

                // for(let i = 0; i < all_attr_arr_chunks.length; i++){

                //     var is_same = row_attr_ids.length == all_attr_arr_chunks[i].length && row_attr_ids.every(function(element, index) {
                //         return element === all_attr_arr_chunks[i][index];
                //     });

                //     console.log(is_same);

                // }




                // console.log(is_same);



            }

            // $(".edit_attribute").on("change", function(){

            //     console.log($(this).val())

            // });
            // attribute validation
        </script>
        <script language="javascript">
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;
            $('.sale_start').attr('min', today);
            $('.sale_end').attr('min', today);



            $(".salePrice").keyup(function(e){
                var num = this.value.match(/^\d+$/);

                if (num === null || num == 0) {
                    this.value = "";
                }
            });

            // $(".salePrice").change(function(e){
            //     var regular_price = $("#regular").val();
            //     var sale_price = $("#sale").val();

            //     if(parseInt(sale_price) >= parseInt(regular_price)){
            //         toastr.error('Sorry, sale price must be less than regular price.');
            //         $(".salePrice").val("");
            //         $(".salePrice").focus();
            //     }
            // });




            function salePriceOnKeyUp(key,edit=null) { 
            
            var regular_price = $(`.regular_price_${edit}${key}`).val();
            let sale_price = $(`.sale_price_${edit}${key}`).val();
            if (parseInt(sale_price) === null || parseInt(sale_price) == 0) {
                $(`.sale_price_${edit}${key}`).val("");
            }

            if(parseInt(sale_price) >= parseInt(regular_price)){
                toastr.error('Sorry, sale price must be less than regular price.');
                $(`.sale_price_${edit}${key}`).val("");
                $(`.sale_price_${edit}${key}`).focus();
            }
            checkEachRowDateValidation();
        }

        function salePriceOnKeyChange(key,edit=null) { 
            var regular_price = $(`.regular_price_${edit}${key}`).val();
            let sale_price = $(`.sale_price_${edit}${key}`).val();
            
            if(parseInt(sale_price) >= parseInt(regular_price)){
                toastr.error('Sorry, sale price must be less than regular price.');
                $(`.sale_price_${edit}${key}`).val("");
                $(`.sale_price_${edit}${key}`).focus();
            }
            checkEachRowDateValidation();
        }
        
        
        
        function saleEndOnChange(key,edit=null) { 
            var sale_start = $(`.sale_start_${edit}${key}`).val();
            var sale_end = $(`.sale_end_${edit}${key}`).val();
            
            if(sale_start == '' && sale_end == ''){
                $(`.sale_start_${edit}${key}`).removeClass('is-error');
                $(`.sale_end_${edit}${key}`).removeClass('is-error');
                $("#saveVariations").attr('disabled', false);
                $("#saveVariations").removeClass("not-allowed");
                checkEachRowDateValidation();
                return false;
            }



            if(sale_start != '' && sale_end != ''){

                if(new Date(sale_start) >= new Date(sale_end)){
                    $(`.sale_end_${edit}${key}`).val("");
                    $(`.sale_end_${edit}${key}`).focus();
                    $(`.sale_end_${edit}${key}`).addClass('is-error');
                    $(`.sale_start_${edit}${key}`).addClass('is-error');
                    $(`.sale_start_${edit}${key}`).focus();
                    $("#saveVariations").attr('disabled', true);
                    $("#saveVariations").addClass("not-allowed");
                    toastr.error('Sale end date must be greate than sale start date.');
                    checkEachRowDateValidation();
                    return false;
                }

                $(`.sale_end_${edit}${key}`).removeClass('is-error');
                $(`.sale_start_${edit}${key}`).removeClass('is-error');
                $("#saveVariations").attr('disabled', false);
                $("#saveVariations").removeClass("not-allowed");
                checkEachRowDateValidation();
                return false;

            }



            if(sale_start == '' && sale_end != ''){
                $(`.sale_start_${edit}${key}`).focus();
                $("#saveVariations").attr('disabled', true);
                $("#saveVariations").addClass("not-allowed");
                $(`.sale_start_${edit}${key}`).addClass('is-error');
                checkEachRowDateValidation();
                return false;
            }

            if(sale_start != '' && sale_end == ''){
                $(`.sale_end_${edit}${key}`).focus();
                $("#saveVariations").attr('disabled', true);
                $("#saveVariations").addClass("not-allowed");
                $(`.sale_end_${edit}${key}`).addClass('is-error');
                checkEachRowDateValidation();
                return false;
            }


            if(new Date(sale_start) >= new Date(sale_end)){
                $(`.sale_end_${edit}${key}`).val("");
                $(`.sale_end_${edit}${key}`).focus();
                $(`.sale_start_${edit}${key}`).addClass('is-error');
                $(`.sale_start_${edit}${key}`).focus();
                $("#saveVariations").attr('disabled', false);
                $("#saveVariations").removeClass("not-allowed");
                toastr.error('Sale end date must be greate than sale start date.');
                checkEachRowDateValidation();
            }



         }
        function regularPrice(key,edit=null) { 
                // alert(key);
        }

        function saleStartOnChange(key,edit=null) { 

            var sale_start = $(`.sale_start_${edit}${key}`).val();
            var sale_end = $(`.sale_end_${edit}${key}`).val();
            console.log(new Date(sale_start));
            
            if(sale_start == '' && sale_end == ''){
                $(`.sale_end_${edit}${key}`).removeClass('is-error');
                $(`.sale_end_${edit}${key}`).removeClass('is-error');
                $("#saveVariations").attr('disabled', false);
                $("#saveVariations").removeClass("not-allowed");
                checkEachRowDateValidation();
                return false;
            }

            if(sale_start != '' && sale_end != ''){
                if(new Date(sale_start) >= new Date(sale_end)){
                    $(`.sale_end_${edit}${key}`).val("");
                    $(`.sale_end_${edit}${key}`).focus();
                    $(`.sale_start_${edit}${key}`).addClass('is-error');
                    $(`.sale_start_${edit}${key}`).focus();
                    $("#saveVariations").attr('disabled', true);
                    $("#saveVariations").addClass("not-allowed");
                    toastr.error('Sale end date must be greate than sale start date.');
                    checkEachRowDateValidation();
                    return false;
                }


                $(`.sale_start_${edit}${key}`).removeClass('is-error');
                $(`.sale_end_${edit}${key}`).removeClass('is-error');
                $("#saveVariations").attr('disabled', false);
                $("#saveVariations").removeClass("not-allowed");
                checkEachRowDateValidation();
                return false;
            }


                if(sale_end == '' && sale_start != ''){
                    $(`.sale_start_${edit}${key}`).focus();
                    $("#saveVariations").attr('disabled', true);
                    $("#saveVariations").addClass("not-allowed");
                    $(`.sale_start_${edit}${key}`).addClass('is-error');
                    // return false;
                }

                if(sale_end != '' && sale_start == ''){
                    $(`.sale_start_${edit}${key}`).focus();
                    $("#saveVariations").attr('disabled', true);
                    $("#saveVariations").addClass("not-allowed");
                    $(`.sale_start_${edit}${key}`).addClass('is-error');
                    // return false;
                }



                if(new Date(sale_start) >= new Date(sale_end)){
                    $(`.sale_end_${edit}${key}`).val("");
                    $(`.sale_end_${edit}${key}`).focus();
                    $(`.sale_end_${edit}${key}`).addClass('is-error');
                    $(`.sale_end_${edit}${key}`).focus();
                    $("#saveVariations").attr('disabled', true);
                    $("#saveVariations").addClass("not-allowed");
                    toastr.error('Sale end date must be greate than sale start date.');
                }

                checkEachRowDateValidation();


         }

        
         function checkEachRowDateValidation(){
            let count = 0;
            $.each($(".sale_start"), function (indexInArray, valueOfElement) { 
                if($(this).hasClass('is-error') || $(".sale_end").hasClass('is-error')){
                    count += 1;
                    
                }
            });
            if(count > 0){
                $("#saveVariations").attr('disabled', true);
                $("#saveVariations").addClass("not-allowed");
            }else{
                $("#saveVariations").attr('disabled', false);
                $("#saveVariations").removeClass("not-allowed");
            }
         }















            $("#qty").keyup(function(e){
                var num = this.value.match(/^\d+$/);

                if (num === null || num == 0) {
                    this.value = "";
                }
            });

        </script>
        
    @endpush
@endsection
