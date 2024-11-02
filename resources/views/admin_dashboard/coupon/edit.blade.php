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
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form theme-form">
                            <form id="" action="{{ route('coupon.update', $edit_coupon->id) }}" method="POST">
                                {{-- <input id="hidden" type="hidden" name="hidden"> --}}
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="method_id" value="{{ $edit_coupon->id }}">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Coupon Code Title.*</label>
                                            <input class="form-control" type="text" placeholder="Enter Coupon Code Title"
                                                data-bs-original-title="" title="" name="coupon_code"
                                                value="{{ $edit_coupon->coupon_code }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Select Shipping Method.*</label>
                                            <select id="discount_type" name="discount_type" for="exampleFormControlInput10"
                                                class="form-control btn-square ">
                                                <option value="1" class="form-control btn-square"
                                                    {{ $edit_coupon->discount_type == 1 ? 'selected' : '' }}>Fixed Cart
                                                    Discount</option>
                                                {{-- <option  value="2" class="form-control btn-square" {{$edit_coupon->discount_type == 2 ? 'selected' : ''}} >Percentage Discount</option> --}}
                                                <option value="2" class="form-control btn-square"
                                                    {{ $edit_coupon->discount_type == 2 ? 'selected' : '' }}>Fixed Product
                                                    Discount</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Coupon Amount.*</label>
                                            <input class="form-control" type="number" placeholder="Enter Coupon Amount"
                                                data-bs-original-title="" title="" name="coupon_amount"
                                                value="{{ $edit_coupon->coupon_amount ?? '' }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Expiry Date.*</label>
                                            <input class="form-control" type="date" placeholder="Enter Coupon Code Title"
                                                data-bs-original-title="" title="" name="expiry_date" id="expiry_date"
                                                value="{{ date('Y-m-d', strtotime($edit_coupon->expiry_date)) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Minimum Spend.*</label>
                                            <input class="form-control" type="number" placeholder="Enter Minimum Spende"
                                                data-bs-original-title="" title="" name="minimum_spend"
                                                value="{{ $edit_coupon->minimum_spend ?? '' }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Maximum Spend.*</label>
                                            <input class="form-control" type="number" placeholder="Enter Maximum Spend"
                                                data-bs-original-title="" title="" name="maximum_spend"
                                                value="{{ $edit_coupon->maximum_spend ?? '' }}" required>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Products.*</label>
                                            <select id="discount_type"  name="product_id" for="exampleFormControlInput10" class="form-control btn-square ">
                                                @foreach ($products as $val)
                                                <option  value="{{$val->id}}" {{$val->id  == $edit_coupon->product_id ? 'selected' : ''}} class="form-control btn-square"  >{{$val->product_name}}</option>
                                                @endforeach
                                           </select>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Products.</label>
                                            <select class="form-control js-example-tokenizer livesearch" id="attrs"
                                                name="variations_id[]" multiple="multiple">
                                                @if(!empty($edit_coupon->product_variation_id))
                                                @php
                                                $variations = explode(',',$edit_coupon->product_variation_id);
                                                @endphp
                                                @foreach ($attr as $val)
                                                    <option value="{{ $val->id }}"
                                                        {{ (in_array($val->id,  $variations)) ? 'selected' : '' }}
                                                        class="form-control btn-square">
                                                        {{ $val->attributes->attribute ?? '' }},{{ $val->attributes->regular_price ?? '' }}
                                                    </option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Category.*</label>
                                            <select id="sub_cat_id" name="sub_category_id[]"
                                                class="form-control btn-square js-example-tokenizer" multiple="multiple">
                                                {{-- @if(!empty($edit_coupon->sub_category_id)) --}}
                                                @php
                                                $ids = explode(',',$edit_coupon->sub_category_id);
                                                @endphp
                                                {{-- <option value="0" {{$edit_coupon->sub_category_id = 0 ? 'selected' : ''}}>Select All</option> --}}
                                                @foreach ($sub_category as $val)
                                                        <option value="{{ $val->id }}" {{ (in_array($val->id, $ids)) ? 'selected' : '' }} class="form-control btn-square">{{ $val->sub_category_name }}
                                                        </option>
                                                @endforeach
                                                {{-- @endif --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Usage Limit Per Coupon.*</label>
                                            <input class="form-control" type="number" placeholder="Enter Maximum Spend"
                                                data-bs-original-title="" title="" name="usage_limit_coupon"
                                                value="{{ $edit_coupon->usage_limit_per_coupon ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Usage Limit Per User.*</label>
                                            <input class="form-control" type="number" placeholder="Enter Maximum Spend"
                                                data-bs-original-title="" title="" name="usage_limit_user"
                                                value="{{ $edit_coupon->usage_limit_per_user ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Allowed Email.</label>
                                            <select class="form-control js-example-tokenizer"  id="allowed" name="allowed_emails[]" multiple="multiple">
                                                         @if(!empty($edit_coupon->allowed_emails))
                                                        @foreach (json_decode($edit_coupon->allowed_emails) as $data )
                                                        @foreach($emails as $user)

                                                                <option value="{{$user->email}}"   {{$user->email == $data ? 'selected' : ''    }} class="form-control btn-square">{{$user->email}}</option>
                                                         @endforeach
                                                @endforeach
                                                @endif
                                                @if(empty($edit_coupon->allowed_emails))
                                                @foreach($emails as $user)
                                                    <option value="{{$user->email}}"    class="form-control btn-square">{{$user->email}}</option>
                                                @endforeach
                                                @endif
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <input type="checkbox" {{ $edit_coupon->free_shipping == 1 ? 'checked' : '' }}
                                                name="free_shipping" value="1" />
                                            <label>Free Shipping.</label>
                                            <span>Check this box if the coupon grants free shipping. A free shipping method
                                                must be enabled in your shipping zone and be set to require "a valid free
                                                shipping coupon" (see the "Free Shipping Requires" setting).</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <input type="checkbox" {{ $edit_coupon->sale_itmes == 1 ? 'checked' : '' }}
                                                name="sale_item" value="1" />
                                            <label>Exclude Sale Items.</label>
                                            <span>Check this box if the coupon should not apply to items on sale. Per-item
                                                coupons will only work if the item is not on sale. Per-cart coupons will
                                                only work if there are items in the cart that are not on sale..</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Coupon Description.*</label>
                                            <textarea class="form-control editor" type="text" placeholder="Enter Coupon Description"
                                                data-bs-original-title="" title="" name="description">{{ $edit_coupon->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div>
                                            <button type="submit" id=""
                                                class="btn btn-success me-3 load">Update</button>
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

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


        <script>
            $(".js-example-tokenizer").select2({
                tags: true,
                tokenSeparators: [',', ' ']
            })
        </script>

        <script>
            $('.livesearch').select2({
                // alert('test');
                placeholder: 'Select Products',
                ajax: {
                    url: '{{ route('search_products_attr') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                console.log();
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
            $(document).ready(function(){
                $( ".load" ).on('click',function() {
                    $("#preloaderSmall").removeClass('loader-active');
                });
            });
        </script>


<script language="javascript">
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;
    $('#expiry_date').attr('min', today);
    
</script>
    @endpush


@endsection
