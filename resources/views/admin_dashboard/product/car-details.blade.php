@extends('admin_dashboard.layouts.master')
@section('content')

    <style>
        .tabsBox {
            padding: 20px;
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


        #dropzone {
            background: white;
            border-radius: 5px;
            border: 2px dashed rgb(0, 135, 247);
            border-image: none;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .car_pricing {
            margin: 10px 0px;
        }

        .car_pricing h5 {
            font-size: 21px;
            font-weight: 400;
        }

        .button-group-pills .btn {
            border-radius: 20px;
            line-height: 1.2;
            margin-bottom: 15px;
            margin-left: 10px;
            border-color: #bbbbbb;
            background-color: #fff;
            color: #14a4be;
        }

        .button-group-pills .btn.active {
            border-color: #14a4be;
            background-color: #14a4be;
            color: #fff;
            box-shadow: none;
        }

        .button-group-pills .btn:hover {
            border-color: #158b9f;
            background-color: #158b9f;
            color: #fff;
        }

        .button-group-pills input[type="checkbox"] {
            display: none;
        }

        .custom_btn {
            color: #343A40;
            background-color: #fff;
            border-color: #343A40;
        }

        .custom_btn:checked {
            color: #fff !important;
            background-color: #343A40 !important;
            border-color: #343A40 !important;
        }

        .custom_btn:hover {
            color: #fff !important;
            background-color: #343A40 !important;
            border-color: #343A40 !important;
        }

        .specs_list {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .specs_heading {
            width: 150px;
            margin-bottom: 20px;
        }

        .car_add_form {
            align-items: center;
        }

        .car_add_form label {
            margin-bottom: 0px;
        }

        .car_add_form select {
            margin-bottom: 20px;
        }

        .car_image img {
            margin: 30px auto;
            display: block;
            max-width: 300px;
        }

        .form-heading {
            margin-bottom: 40px;
        }

        table {
            width: 100%;
        }

        td {
            margin: 10px auto !important;
            padding: 10px;
        }

        .multiple-uploader input[type="file"] {
            display: none;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card tabsBox" id="tabs_id">

                    {{-- <form id="my-form" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data"> --}}
                    @csrf
                    <div class="container-fluid">
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-12">
                                <div class="form-heading">
                                    {{-- <h5>Select Car</h5> --}}

                                    {{-- <div class="row">
                                        <div class="col"> --}}
                                            <div>
                                                <a class="btn btn-success" href="{{ route('car-listing') }}"
                                                    data-bs-original-title="" title="">Back</a>
                                            </div>
                                        {{-- </div>
                                    </div> --}}
                                </div>
                                <div class="row car_add_form">
                                    <div class="col-md-4 col-12">
                                        <label for="product_type">Car Brand / Model</label>
                                    </div>
                                    {{-- <div class="col-md-4 col-12"> --}}

                                    <div class="col-md-4 car_pricing">
                                        <input class="form-control" id="" type="text" placeholder="Kms"
                                            name="per_day_kilometers" value="{{ $details->get_brand_name->brand_name }}"
                                            disabled>
                                    </div>
                                    {{-- </div> --}}
                                    {{-- <div class="col-md-4 col-12">
                                        <div class="select-dropdown">
                                            <select class="form-control" id="car_model" name="car_model">
                                                <option value="Select Car Model">Select Car Model</option>
                                                <option value="Select Car Model">{{$details->model_name ?? '' }}</option>
                                            </select>
                                        </div>
                                    </div> --}}

                                    <div class="col-md-4 car_pricing">
                                        <input class="form-control" id="car_model" type="text" placeholder="Models"
                                            name="car_model" value="{{ $details->model_name ?? '' }}" disabled>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <label for="version">Version</label>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <div class="select-dropdown">
                                            <select class="form-control" id="version" name="version">
                                                <option value="N/A">N/A</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <label for="make_year">Make (Year)</label>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        {{-- <div class="select-dropdown">
                                            <select class="form-control" id="make_year" name="make_year" required>
                                                <option value="Select Car Model">{{$details->make_year ?? '' }}</option>

                                            </select>
                                        </div> --}}
                                        <input class="form-control" id="make_year" type="text" placeholder="Models"
                                            name="make_year" value="{{ $details->make_year ?? '' }}" disabled>
                                    </div>
                                    {{-- <div class="col-12">
                                        <div class="car_image">
                                            <img src="https://www.transparentpng.com/thumb/car-png/car-free-transparent-png-8.png"
                                                alt="">
                                        </div>
                                    </div> --}}
                                    <div class="col-12 mt-5 pt-3">
                                        <h4>
                                            Add Monthly Prices
                                        </h4>
                                    </div>
                                    <div class="col-md-4 car_pricing">
                                        <h6>
                                            Extra Millega Cost / km
                                        </h6>
                                    </div>
                                    <div class="col-md-4 car_pricing">
                                        <input class="form-control" id="" type="number"
                                            placeholder="AED Charges" name="extra_mileage_cost"
                                            value="{{ $details->monthly_extra ?? '' }}" disabled>
                                    </div>

                                    <div class="col-md-4 car_pricing">
                                        <input type="checkbox" name="extra_free" id="extra_free" value="Yes"
                                            @if ($details->extra_free == 'Yes') checked @endif @disabled(true)>
                                        <label for="extra_free">It's Free!</label>
                                    </div>
                                    <div class="col-md-4 car_pricing">
                                        <h6>
                                            CDW Insurance Per Day
                                        </h6>
                                    </div>
                                    <div class="col-md-4 car_pricing">
                                        <input class="form-control" id="" type="number" placeholder="Kms"
                                            name="insurance_per_day" value=""
                                            value="{{ $details->insurance_per_day ?? '' }}" disabled>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="row car_add_form">
                                    <div class="mb-3">
                                        <h5>Pricing</h5>
                                    </div>

                                    <div class="col-md-4 car_pricing">
                                        <h6>
                                            Price Per Day
                                        </h6>
                                    </div>
                                    <div class="col-md-4 car_pricing">
                                        <input class="form-control" id="" type="number" placeholder="AED Charges"
                                            name="price_per_day" value="{{ $details->price_per_day ?? '' }}" disabled>
                                    </div>
                                    <div class="col-md-4 car_pricing">
                                        <input class="form-control" id="" type="number" placeholder="Kms"
                                            name="per_day_kilometers" value="{{ $details->per_day_mileage ?? '' }}"
                                            disabled>
                                    </div>
                                    <div class="col-md-4 car_pricing">

                                    </div>
                                    <div class="col-md-8 car_pricing">
                                        <input type="checkbox" name="daily_availablity" id="daily_availablity"
                                            value="Yes" @if ($details->daily_availablity == 'Yes') checked @endif
                                            @disabled(true)>
                                        <label for="daily_availablity">Available for Daily</label>
                                    </div>
                                    <div class="col-md-4 car_pricing">
                                        <h6>
                                            Minimum Day Booking
                                        </h6>
                                    </div>
                                    <div class="col-md-8 car_pricing">
                                        <select name="days" id="days" class="form-select" disabled>
                                            {{-- <option value="Select Days" selected disabled>Select Days</option> --}}
                                            <option value="1" @if ($details->days == '1') selected @endif>1
                                            </option>
                                            <option value="2" @if ($details->days == '2') selected @endif>2
                                            </option>
                                            <option value="3" @if ($details->days == '3') selected @endif>3
                                            </option>
                                            <option value="4" @if ($details->days == '4') selected @endif>4
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 car_pricing">
                                        <h6>
                                            Price Per Week
                                        </h6>
                                    </div>
                                    <div class="col-md-4 car_pricing">
                                        <input class="form-control" id="" type="number" placeholder="AED Charges"
                                            name="price_per_week" value="{{ $details->weekly_rent ?? '' }}" disabled>
                                    </div>
                                    <div class="col-md-4 car_pricing">
                                        <input class="form-control" id="weekly_mileage" type="number" placeholder="Kms"
                                            name="weekly_mileage" value="{{ $details->weekly_mileage ?? '' }}" disabled>
                                    </div>
                                    <div class="col-md-4 car_pricing">

                                    </div>
                                    <div class="col-md-8 car_pricing">
                                        <input type="checkbox" name="available_weekly" id="available_weekly"
                                            value="Yes" @if ($details->available_weekly == 'Yes') checked @endif
                                            @disabled(true)>
                                        <label for="available_weekly">Available for Weekly</label>
                                    </div>
                                    {{-- <div class="col-12">
                                        <h4>
                                            Add Monthly Prices
                                        </h4>
                                    </div>
                                    <div class="col-md-4 car_pricing">
                                        <h6>
                                            Extra Millega Cost / km
                                        </h6>
                                    </div>
                                    <div class="col-md-4 car_pricing">
                                        <input class="form-control" id="" type="number"
                                            placeholder="AED Charges" name="extra_mileage_cost"
                                            value="{{ $details->monthly_extra ?? '' }}" disabled>
                                    </div>

                                    <div class="col-md-4 car_pricing">
                                        <input type="checkbox" name="extra_free" id="extra_free" value="Yes"
                                            @if ($details->extra_free == 'Yes') checked @endif @disabled(true)>
                                        <label for="extra_free">It's Free!</label>
                                    </div>
                                    <div class="col-md-4 car_pricing">
                                        <h6>
                                            CDW Insurance Per Day
                                        </h6>
                                    </div>
                                    <div class="col-md-4 car_pricing">
                                        <input class="form-control" id="" type="number" placeholder="Kms"
                                            name="insurance_per_day" value=""
                                            value="{{ $details->insurance_per_day ?? '' }}" disabled>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 ">
                                <div class="form-heading">
                                    <h5>Car Specs</h5>
                                </div>
                                <div class="specs_heading">
                                    <h6>
                                        Car Colors:
                                    </h6>
                                </div>
                                <ul class="specs_list">

                                    @php
                                        $colorsArray = explode(',', $details->car_colors);
                                    @endphp
                                    @foreach ($colorsArray as $color)
                                        <li>
                                            <input type="checkbox" class="btn-check" id="{{ $color }}"
                                                name="car_colors" autocomplete="off" value="{{ $color }}" checked disabled>
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="{{ $color }}">{{ $color }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="specs_heading">
                                    <h6>
                                        Car Features:
                                    </h6>
                                </div>
                                <ul class="specs_list">

                                    @php
                                        $featuresArray = explode(',', $details->car_features);
                                    @endphp
                                    @foreach ($featuresArray as $feature)
                                        <li>
                                            <input type="checkbox" class="btn-check" id="{{ $feature }}"
                                                name="car_features" autocomplete="off" value="{{ $feature }}" checked disabled>
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="{{ $feature }}">{{ $feature }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="d-flex">
                                    <div>
                                        <div class="specs_heading">
                                            <h6>
                                                Doors:
                                            </h6>
                                        </div>
                                        <ul class="specs_list">
                                            <li>
                                                <input type="radio" class="btn-check" id="2doors" name="car_doors"
                                                    autocomplete="off" value="{{ $details->car_doors }}" checked disabled>
                                                <label class="btn btn-outline-dark custom_btn"
                                                    for="2doors">{{ $details->car_doors }} Doors</label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div>
                                        <div class="specs_heading">
                                            <h6>
                                                Passengers:
                                            </h6>
                                        </div>
                                        <ul class="specs_list">

                                            <li>
                                                <input type="radio" class="btn-check" id="{{$details->passengers}}"
                                                    name="passengers" autocomplete="off" value="{{$details->passengers}}"
                                                    checked disabled>
                                                <label class="btn btn-outline-dark custom_btn" for="2passengers">{{$details->passengers}}
                                                    Passengers</label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="ms-5">
                                        <div class="specs_heading">
                                            <h6>
                                                Bags fit :
                                            </h6>
                                        </div>
                                        <ul class="specs_list">

                                            <li>
                                                <input type="radio" class="btn-check" id="bag1" name="bags_fit"
                                                    autocomplete="off" value="{{$details->bags}}"
                                                    checked disabled>
                                                <label class="btn btn-outline-dark custom_btn" for="bag1">{{$details->bags}}
                                                    Bag(s)</label>
                                            </li>

                                        </ul>
                                    </div>
                                </div>

                                <div class="d-flex">
                                <div>
                                <div class="specs_heading">
                                    <h6>
                                        Specs :
                                    </h6>
                                </div>
                                <ul class="specs_list">
                                    <li>
                                        <input type="radio" class="btn-check" id="American_Specs" name="specs"
                                            autocomplete="off" value="American Specs"
                                            checked disabled>
                                        <label class="btn btn-outline-dark custom_btn" for="American_Specs">{{$details->specs}}</label>
                                    </li>
                                </ul>
                            </div>

                            <div class="ms-5">
                                <div class="specs_heading">
                                    <h6>
                                        Transmission :
                                    </h6>
                                </div>
                                <ul class="specs_list">

                                    <li>
                                        <input type="radio" class="btn-check" id="manual" name="transmission"
                                            autocomplete="off" value="Manual"  checked disabled>
                                        <label class="btn btn-outline-dark custom_btn" for="manual">{{$details->transmission}}</label>
                                    </li>
                                </ul>
                                </div>

                                <div>
                                <div class="specs_heading">
                                    <h6>
                                        Fuel Type:
                                    </h6>
                                </div>
                                <ul class="specs_list">

                                    <li>
                                        <input type="radio" class="btn-check" id="petrol" name="fuel_type"
                                            autocomplete="off" value="Petrol"
                                            checked disabled>
                                        <label class="btn btn-outline-dark custom_btn" for="petrol">{{$details->fuel_type}}</label>
                                    </li>

                                </ul>
                            </div>
                        </div>

                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="row car_add_form">
                                    <div class="mb-3">
                                        <h5>Rental Terms</h5>
                                    </div>

                                    <div class="col-md-4 car_pricing">
                                        <h6>
                                            Security Deposit
                                        </h6>
                                    </div>
                                    <div class="col-md-8 car_pricing">
                                        <input class="form-control" id="" type="number"
                                            placeholder="AED Charges" name="security_deposit"
                                            value="{{ $details->security_deposit }}" disabled>
                                    </div>
                                    <div class="col-md-4 car_pricing">
                                        <h6>
                                            Delivery & Pick up Charges
                                        </h6>
                                    </div>
                                    <div class="col-md-4 car_pricing">
                                        <select name="delivery_days" id="delivery_days" class="form-select mb-0" disabled>
                                            <option value="Select Delivery Charges" selected disabled>Select Delivery
                                                Charges</option>
                                            <option value="Free Always"
                                                @if ($details->delivery_days == 'Free Always') selected @endif>Free Always</option>
                                            <option value="Free (2 days+)"
                                                @if ($details->delivery_days == 'Free (2 days+)') selected @endif>Free (2 days+)
                                            </option>
                                            <option value="Free (10 days+)"
                                                @if ($details->delivery_days == 'Free (10 days+)') selected @endif>Free (10 days+)
                                            </option>
                                            <option value="Free (15 days+)"
                                                @if ($details->delivery_days == 'Free (15 days+)') selected @endif>Free (15 days+)
                                            </option>
                                            <option value="Free (30 days+)"
                                                @if ($details->delivery_days == 'Free (30 days+)') selected @endif>Free (30 days+)
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 car_pricing">
                                        <input type="text" name="delivery_charges" id=""
                                            class="form-control" placeholder="AED"
                                            value="{{ $details->delivery_charges }}" disabled>
                                    </div>
                                    <div class="col-md-4 car_pricing">
                                        <h6>
                                            Special Note for Customers
                                        </h6>
                                    </div>
                                    <div class="col-md-8">
                                        <textarea name="cutomer_note" id="" cols="30" rows="4" class="form-control" disabled>{{ $details->cutomer_note }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="table-responsive">
                                    <table>
                                        <thead>
                                            <th>Period / Mileage</th>
                                            <td>1 Month</td>
                                            <td>3 Months</td>
                                            <td>6 Months</td>
                                            <td>9 Months</td>
                                            <td>12 Months</td>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    2000 km
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[2000][one_month]" id=""
                                                        placeholder="AED" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[2000][three_months]"
                                                        id="" placeholder="AED" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[2000][six_months]" id=""
                                                        placeholder="AED" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[2000][nine_months]"
                                                        id="" placeholder="AED" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[2000][twelve_months]"
                                                        id="" placeholder="AED" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    3000 km
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[3000][one_month]" id=""
                                                        placeholder="AED" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[3000][three_months]"
                                                        id="" placeholder="AED" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[3000][six_months]" id=""
                                                        placeholder="AED" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[3000][nine_months]"
                                                        id="" placeholder="AED" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[3000][twelve_months]"
                                                        id="" placeholder="AED" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    4000 km
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[4000][one_month]" id=""
                                                        placeholder="AED" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[4000][three_months]"
                                                        id="" placeholder="AED" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[4000][six_months]" id=""
                                                        placeholder="AED" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[4000][nine_months]"
                                                        id="" placeholder="AED" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[4000][twelve_months]"
                                                        id="" placeholder="AED" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    4500 km
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[4500][one_month]" id=""
                                                        placeholder="AED" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[4500][three_months]"
                                                        id="" placeholder="AED" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[4500][six_months]" id=""
                                                        placeholder="AED" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[4500][nine_months]"
                                                        id="" placeholder="AED" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[4500][twelve_months]"
                                                        id="" placeholder="AED" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    5000 km
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[5000][one_month]" id=""
                                                        placeholder="AED" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[5000][three_months]"
                                                        id="" placeholder="AED" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[5000][six_months]" id=""
                                                        placeholder="AED" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[5000][nine_months]"
                                                        id="" placeholder="AED" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[5000][twelve_months]"
                                                        id="" placeholder="AED" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    6000 km
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[6000][one_month]" id=""
                                                        placeholder="AED" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[6000][three_months]"
                                                        id="" placeholder="AED" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[6000][six_months]" id=""
                                                        placeholder="AED" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[6000][nine_months]"
                                                        id="" placeholder="AED" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mileage[6000][twelve_months]"
                                                        id="" placeholder="AED" class="form-control">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="mb-3">

                        {{-- <form action="" method="" enctype="multipart/form-data" id="my-form">
                    </form> --}}

                        {{-- <div class="multiple-uploader" id="multiple-uploader">
                            <div class="mup-msg">
                                <span class="mup-main-msg">click to upload images.</span>
                                <span class="mup-msg" id="max-upload-number">Upload up to 10 images</span>
                                <span class="mup-msg">Only images, pdf and psd files are allowed for
                                    upload</span>
                            </div>
                            <input type="file" name="images[]" multiple accept="image*">
                        </div> --}}
                    </div>

                    <div class="row mt-3">

                        <div class="col-12 mt-5">
                            <div class="specs_heading">
                                <h6>
                                    Exterior Color:
                                </h6>
                            </div>
                            <ul class="specs_list">
                                @php
                                    $extColorsArray = explode(',', $details->exterior_color);
                                @endphp


                            @foreach ($extColorsArray as $extColor)

                                <li>
                                    <input type="checkbox" class="btn-check"
                                        id="exterior_color_{{ $extColor }}" name="exterior_color"
                                        autocomplete="off" value="{{ $extColor }}"
                                        checked disabled>
                                    <label class="btn btn-outline-dark custom_btn"
                                        for="exterior_color_{{ $extColor }}">{{ $extColor }}</label>
                                </li>
                                @endforeach

                            </ul>
                            <div class="specs_heading">
                                <h6>
                                    Interior Color:
                                </h6>
                            </div>
                            <ul class="specs_list">


                            @php
                                $intColorsArray = explode(',', $details->interior_color);
                            @endphp

                                @foreach ($intColorsArray as $int_color)
                                <li>
                                    <input type="checkbox" class="btn-check "
                                        id="interiror_color_{{ $int_color }}" name="interior_color[]"
                                        autocomplete="off" value="{{$int_color }}"
                                        checked disabled>
                                    <label class="btn btn-outline-dark custom_btn"
                                        for="interiror_color_{{ $int_color }}">{{ $int_color }}</label>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="col-3">
                            <label for="reg_card" class="form-label">Upload Registration Card (Mulkiya)</label>
                            {{-- <input type="file" name="registration_card" id="registration_card" class="form-control"
                                accept="image"> --}}
                                <div>
                                    <img class="w-100" src="https://www.transparentpng.com/thumb/car-png/car-free-transparent-png-8.png"
                                                alt="">
                                </div>
                        </div>

                        <div class="mt-4">
                            <h6 class="fw-bold">
                                Car Images:
                            </h6>
                        </div>
                        <div class="row mt-3">
                            @foreach (json_decode($details->get_images) as $key => $prouct_image)

                            <div class="col-md-3">
                                <div>

                                    <img class="w-100" src="{{ asset('images/') }}/{{$prouct_image->images}}"
                                                alt="">
                                </div>
                            </div>
                            @endforeach
                            {{-- <div class="col-md-3">
                                <div>
                                    <img class="w-100" src="https://www.transparentpng.com/thumb/car-png/car-free-transparent-png-8.png"
                                                alt="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div>
                                    <img class="w-100" src="https://www.transparentpng.com/thumb/car-png/car-free-transparent-png-8.png"
                                                alt="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div>
                                    <img class="w-100" src="https://www.transparentpng.com/thumb/car-png/car-free-transparent-png-8.png"
                                                alt="">
                                </div>
                            </div> --}}
                        </div>
                        {{-- <div class="col-12 mt-4 text-center">
                            <button class="btn btn-primary">Submit</button>
                        </div> --}}
                    </div>
                    {{-- </form> --}}



                    {{-- <div class="tab-content tabsContent" id="pills-tabContent">
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



                </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
