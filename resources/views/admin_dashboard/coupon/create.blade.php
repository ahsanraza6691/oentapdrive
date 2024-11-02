@extends('admin_dashboard.layouts.master')
@section('content')
    <style>
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
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form theme-form">
                            <form id="" action="{{ route('coupon.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Coupon Code Title.</label>
                                            <input class="form-control" type="text" placeholder="Enter Coupon Code Title"
                                                   data-bs-original-title="" title="" name="coupon_code"
                                                   value="{{ old('coupon_code') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Select Shipping Method.</label>
                                            <select id="discount_type" name="discount_type" for="exampleFormControlInput10"
                                                    class="form-control btn-square ">
                                                {{-- <option  value="2" class="form-control btn-square" >Percentage Discount</option> --}}
                                                <option value="2" class="form-control btn-square">Fixed Product
                                                    Discount</option>
                                                <option value="1" class="form-control btn-square">Fixed Cart Discount
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label>Amount Setup.</label>
                                                    <select id="amount_setup" name="amount_setup" for="exampleFormControlInput10"
                                                            class="form-control btn-square ">
                                                        <option value="2" class="form-control btn-square">Coupon amount</option>
                                                        <option value="1" class="form-control btn-square">Percentage
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <input class="form-control" type="number" id="amount_setup_value" placeholder="Enter Coupon Amount"
                                                   data-bs-original-title="" title="" name="coupon_amount"
                                                   value="{{ old('coupon_amount') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Expiry Date.</label>
                                            <input class="form-control" type="date" placeholder="Enter Coupon Code Title"
                                                   data-bs-original-title="" title="" name="expiry_date" id="expiry_date"
                                                   value="{{ old('expiry_date') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3" id="minimum_spend_hide">
                                            <label>Minimum Spend.</label>
                                            <input class="form-control" type="number" placeholder="Enter Minimum Spende"
                                                   data-bs-original-title="" title="" name="minimum_spend"
                                                   id="minimum_spend" value="{{ old('minimum_spend') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12" id="maximum_spend_hide">
                                        <div class="mb-3">
                                            <label>Maximum Spend.</label>
                                            <input class="form-control" type="number" placeholder="Enter Maximum Spend"
                                                   data-bs-original-title="" id="maximum_spend" title=""
                                                   name="maximum_spend" value="{{ old('maximum_spend') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row product_attr">
                                    <div class="col-lg-12">
                                        <div class="mb-3" id="product_hide">
                                            <label>Products.</label>
                                            <select class="form-control js-example-tokenizer livesearch" id="attrs"
                                                    name="variations_id[]" multiple="multiple">
                                            </select>
                                        </div>
                                        <div class="mb-3" id="variation_hide">
                                            <label>Products-Variation.</label>
                                            <select class="form-control js-example-tokenizer livesearch_variation"
                                                    id="attrs_variation" name="product_variations_id[]" multiple="multiple">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row category_select" id="category_hide">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Category.</label>
<button class="selectCategary btn btn-success" style="font-size: 90%;padding: 5px;background-color:#8BC34A !important" type="button">Select All</button>
<button class="selectCategaryNone btn btn-success" style="font-size: 90%;padding: 5px;background-color:#8BC34A !important"  type="button">None</button>

                                            <select id="sub_cat_id" name="sub_category_id[]"
                                                    class="form-control btn-square js-example-tokenizer category_live_search selectCategaryAll"
                                                    multiple="multiple">

                                                @foreach ($sub_category as $val)
                                                    {{-- <option value="0">Select All</option> --}}
                                                    <option value="{{ $val->id }}" class="form-control btn-square">
                                                        {{ $val->sub_category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Usage Limit Per Coupon.</label>
                                            <input class="form-control" type="number" placeholder="Enter Maximum Spend"
                                                   data-bs-original-title="" title="" name="usage_limit_coupon"
                                                   value="{{ old('maximum_spend') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Usage Limit Per User.</label>
                                            <input class="form-control" type="number" placeholder="Enter Maximum Spend"
                                                   data-bs-original-title="" title="" name="usage_limit_user"
                                                   value="{{ old('maximum_spend') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Allowed Email.</label>
                                            <select class="form-control allwoed-email-select" id="allowed"
                                                    name="allowed_emails[]" multiple="multiple">
                                                @foreach ($emails as $user)
                                                    <option value="{{ $user->email }}" class="form-control btn-square">
                                                        {{ $user->email }}</option>
                                                @endforeach
                                            </select>
                                            {{-- <input class="form-control" type="email" placeholder="Enter Allowed Email" data-bs-original-title="" title="" name="allowed_emails[]" value="{{old('allowed_emails')}}" multiple> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <input type="checkbox" name="free_shipping" value="1" />
                                            <label>Free Shipping.</label><br>
                                            <span>Check this box if the coupon grants free shipping. A free shipping method
                                                must be enabled in your shipping zone and be set to require "a valid free
                                                shipping coupon" (see the "Free Shipping Requires" setting).</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <input type="checkbox" name="sale_item" value="1"
                                                   data-bs-original-title="" title="">
                                            <label>Exclude Sale Items.</label> <br>
                                            <span>Check this box if the coupon should not apply to items on sale. Per-item
                                                coupons will only work if the item is not on sale. Per-cart coupons will
                                                only work if there are items in the cart that are not on sale..</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Coupon Description.</label>
                                            <textarea class="form-control editor" type="text" placeholder="Enter Coupon Description"
                                                      data-bs-original-title="" title="" name="description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div>
                                            <button type="submit" id=""
                                                    class="btn btn-success me-3 load">Add</button>
                                            <a class="btn btn-danger" href="{{ route('coupon.index') }}"
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
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(".js-example-tokenizer").select2({
                tags: true,
                tokenSeparators: [',', ' ']
            })
        </script>
        <script>
            $(".allwoed-email-select").select2({
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
                        // dataType: 'json',
                        //  cache: false,
                        success: function(response) {
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
            $(document).ready(function() {
                $("#product_id").on('change', function() {
                    var id = $(this).val();
                    // var value = $("#discount_type").val();
                    $.ajax({
                        type: "GET",
                        url: '{{ route('get_attributes_all') }}',
                        data: {
                            'id': id
                        },
                        success: function(response) {
                            $('#attrs').html('');
                            if (response != '') {
                                $.each(response.variations, function(value, i) {
                                    console.log(response);
                                    var select = (i.id == i.attribute ?
                                        'selected="selected"' : '');
                                    // console.log(test);
                                    $('#attrs').append(
                                        `<option  value ="${i.id}" ${select}>${i.attribute},${i.regular_price}</option>`
                                    );
                                });
                            }

                        }
                    });
                });
            });
        </script>

        <script>
            setInterval(() => {
                product = $('.livesearch').find(':selected');
                variation = $('.livesearch_variation').find(':selected');
                categaory = $('.category_live_search').find(':selected');
                if (product.length > 0) {
                    $('#variation_hide').hide();
                    $('#category_hide').hide();

                } else if (variation.length > 0) {
                    $('#product_hide').hide();
                    $('#category_hide').hide();

                } else if (categaory.length > 0) {
                    $('#product_hide').hide();
                    $('#variation_hide').hide();

                } else {
                    $('#variation_hide').show();
                    $('#product_hide').show();
                    $('#category_hide').show();
                }

                // if(variation.length==0){
                //     $('#product_hide').show();
                //     $('#category_hide').show();

                // }else if{
                //     $('#product_hide').hide();
                //     $('#category_hide').hide();
                // }
            }, 1000);
            // $('#discount_type').change({})

            $('#discount_type').on('change', function() {
                console.log(this.value);
                if (this.value == 2) {
                    $('#maximum_spend_hide').hide();
                    $('#minimum_spend_hide').hide();
                    $('#variation_hide').show();
                    $('#product_hide').show();
                    $('#category_hide').show();
                } else if (this.value == 1) {
                    $('#maximum_spend_hide').show();
                    $('#minimum_spend_hide').show();
                    $('#variation_hide').hide();
                    $('#product_hide').hide();
                    $('#category_hide').hide();
                }
            });
            $('#maximum_spend_hide').hide();
            $('#minimum_spend_hide').hide();
            $('.livesearch').select2({
                placeholder: 'Select Products',
                ajax: {
                    url: '{{ route('search_products_attr') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        //   console.log(data)
                        return {
                            results: $.map(data, function(item) {
                                console.log();
                                return {
                                    text: item.product_name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        </script>
        <script>
            $('.livesearch_variation').select2({
                // alert('test');
                placeholder: 'Select Products',
                ajax: {
                    url: '{{ route('products_attr_variation') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                console.log(item);
                                return {
                                    text: item.products.product_name + ' , ' + item.attribute + ' , ' + item
                                        .regular_price,
                                    id: item.id

                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        </script>
        <script>
            $(document).ready(function() {
                $(".load").on('click', function() {
                    $(".loader-bg").removeClass('loader-active');
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $("#discount_type").on('change', function() {
                    var id = $(this).val();
                    //    alert(id);
                    if (id == 1) {
                        $('.product_attr').hide();
                        $('.category_select').hide();

                    } else {
                        $('.product_attr').show();
                        $('.category_select').show();
                    }

                });
            });
        </script>
        <script>
            $('#amount_setup').on('change', function() {
                if($(this).val()==1){
                    $("#amount_setup_value").attr("placeholder", "Please Enter Percentage");
                    $("#amount_setup_value").val('')
                }else{
                    $("#amount_setup_value").attr("placeholder", "Please Enter Coupon Amount");
                    $("#amount_setup_value").val('')
                }
            });
        </script>

<script language="javascript">
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;
    $('#expiry_date').attr('min', today);

$('.selectCategary').on('click', function() {
    $('.selectCategaryAll > option').prop("selected", "selected");
    $('.selectCategaryAll').trigger("change");

})
$('.selectCategary').on('click', function() {
    $('.selectCategaryAll > option').prop("selected", "selected");
    $('.selectCategaryAll').trigger("change");

})
$('.selectCategaryNone').on('click', function() {
    $('.selectCategaryAll > option').prop("selected", "");
    $('.selectCategaryAll> option').trigger("change");

})

</script>
    @endpush
@endsection
