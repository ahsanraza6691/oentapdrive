@extends('vendor_dashboard.layouts.master')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css">
    <link rel="stylesheet" href="{{ asset('assets/dropzone/css/main.css') }}">

    <style>
        input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
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
        <div>
            <a class="btn btn-success mb-3" href="{{ route('rent-car.index') }}"
                 data-bs-original-title="" title="">Back</a>
         </div>
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card tabsBox" id="tabs_id">

                    <form id="my-form" action="{{ route('product.update',$edit->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}


                        <div class="row mb-3">

                                <div class="col-lg-6 col-md-12">

                                    <div class="form-heading">

                                        <h5>Select Car</h5>
                                    </div>
                                    <div class="row car_add_form">
                                        <div class="col-md-4 col-12">
                                            <label for="product_type">Car Brand / Model</label>
                                        </div>
                                        <div class="col-md-4 col-12">

                                            <div class="select-dropdown">
                                                <select id="brand_name" for="exampleFormControlInput10"
                                                    class="form-control btn-square type" name="brand_name">
                                                    <option value="Select Car Brand">Select Car Brand</option>
                                                    @foreach ($brand as $key => $value)
                                                        <option
                                                            value="{{ $value->id }}" {{$value->id == $edit->brand_id ? 'selected' : ''}} >{{ $value->brand_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="select-dropdown">
                                                <select class="form-control" id="car_model" name="car_model">
                                                    @foreach ($models as $model )
                                                    <option value="{{$model->model_name}}" {{$model->main_category_name  == $edit->model_name}}>{{$model->main_category_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <label for="version">Categories</label>
                                        </div>
                                        <div class="col-md-8 col-12">
                                            {{-- <input type="text" class="form-control" name="category" id="category_car" value="{{$edit->category}}"> --}}
                                            <div class="select-dropdown">
                                                <select class="form-control" id="category_car" name="category">
                                                    <option value="Sedan" @if($edit->category == 'Sedan') selected @endif>Sedan</option>
                                                    <option value="Coupe"  @if($edit->category == 'Coupe') selected @endif>Coupe</option>
                                                    <option value="Hatchback"  @if($edit->category == 'Hatchback') selected @endif>Hatchback</option>
                                                    <option value="Convertible"  @if($edit->category == 'Convertible') selected @endif>Convertible</option>
                                                   <option value="Compact"  @if($edit->category == 'Compact') selected @endif>Compact</option>
                                                    <option value="Subcompact"  @if($edit->category == 'Subcompact') selected @endif>Subcompact</option>
                                                    <option value="Suv"  @if($edit->category == 'Suv') selected @endif>Suv</option>
                                                    <option value="Crossover"  @if($edit->category == 'Crossover') selected @endif>Crossover</option>
                                                    <option value="Pickup Truck"  @if($edit->category == 'Pickup Truck') selected @endif>Pickup Truck</option>
                                                    <option value="Minivan"  @if($edit->category == 'Minivan') selected @endif>Minivan</option>
                                                    <option value="Van"  @if($edit->category == 'Van') selected @endif>Van</option>
                                                    <option value="Wagon"  @if($edit->category == 'Wagon') selected @endif>Wagon</option>
                                                    <option value="Sports Car"  @if($edit->category == 'Sports Car') selected @endif>Sports Car </option>
                                                    <option value="Luxury Car"  @if($edit->category == 'Luxury Car') selected @endif>Luxury Car</option>
                                                    <option value="Super Car"  @if($edit->category == 'Super Car') selected @endif>Super Car</option>
                                                    <option value="Low Price"  @if($edit->category == 'Low Price') selected @endif>Low Price</option>
                                                    <option value="Monthly"  @if($edit->category == 'Monthly') selected @endif>Monthly</option>
                                                    <option value="Electric Vehicle (EV)"  @if($edit->category == 'Electric Vehicle (EV)') selected @endif>Electric Vehicle (EV)</option>
                                                    <option value="Hybrid Vehicle"  @if($edit->category == 'Hybrid Vehicle') selected @endif>Hybrid Vehicle</option>
                                                    <option value="Diesel Vehicle"  @if($edit->category == 'Diesel Vehicle') selected @endif>Diesel Vehicle</option>
                                                    <option value="Full-Size Car"  @if($edit->category == 'Full-Size Car') selected @endif>Full-Size Car</option>
                                                    <option value="Mid-Size Car"  @if($edit->category == 'Mid-Size Car') selected @endif>Mid-Size Car</option>
                                                    <option value="Microcar"  @if($edit->category == 'Microcar') selected @endif>Microcar</option>
                                                    <option value="Roadster"  @if($edit->category == 'Roadster') selected @endif>Roadster</option>
                                                    <option value="Off-Road Vehicle"  @if($edit->category == 'Off-Road Vehicle') selected @endif>Off-Road Vehicle</option>
                                                    <option value="Muscle Car"  @if($edit->category == 'Muscle Car') selected @endif>Muscle Car</option>
                                                </select>
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-4 col-12">
                                            <label for="version">Version</label>
                                        </div>
                                        <div class="col-md-8 col-12">
                                            <div class="select-dropdown">
                                                <select class="form-control" id="version" name="version">
                                                    <option value="" >N/A</option>
                                                </select>
                                            </div>
                                        </div> --}}

                                        <div class="col-md-4 col-12 mt-3">
                                            <label for="make_year">City</label> 
                                        </div>
                                        <div class="col-md-8 col-12 mt-3">
                                            <div class="select-dropdown">
                                                <select class="form-control"  name="city">
                                                <option value="Dubai" @if($edit->city == 'Dubai') selected @endif>Dubai</option>
                                                <option value="Abu Dhabi" @if($edit->city == 'Abu Dhabi') selected @endif>Abu Dhabi</option>
                                                <option value="Fujairah" @if($edit->city == 'Fujairah') selected @endif>Fujairah</option>
                                                <option value="Ajman" @if($edit->city == 'Ajman') selected @endif>Ajman</option>
                                                <option value="Al Ain" @if($edit->city == 'Al Ain') selected @endif>Al Ain</option>
                                                <option value="Sharjah" @if($edit->city == 'Sharjah') selected @endif>Sharjah</option>
                                                <option value="Ras Al Khaimah" @if($edit->city == 'Ras Al Khaimah') selected @endif>Ras Al Khaimah</option>
                                                <option value="Umm Al Qwain" @if($edit->city == 'Umm Al Qwain') selected @endif>Umm Al Qwain</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <label for="make_year">Make (Year)</label>
                                        </div>
                                        <div class="col-md-8 col-12">
                                            <div class="select-dropdown">
                                                <select class="form-control" id="car_make_year" name="make_year" required>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="car_image">
                                                <img src="https://www.transparentpng.com/thumb/car-png/car-free-transparent-png-8.png"
                                                    alt="">
                                            </div>
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
                                            <input class="form-control" id="price_per_day" type="number"
                                                placeholder="AED Charges" name="price_per_day"
                                                value="{{ $edit->price_per_day ?? '' }}">
                                        </div>
                                        <div class="col-md-4 car_pricing">
                                            <input class="form-control" id="per_day_kilometers" type="number" placeholder="Kms"
                                                name="per_day_kilometers" value="{{ $edit->per_day_mileage ?? '' }}">
                                        </div>
                                        <div class="col-md-4 car_pricing">

                                        </div>
                                        <div class="col-md-8 car_pricing">
                                            <input type="checkbox" name="daily_availablity" id="daily_availablity"
                                                value="Yes" @if ($edit->daily_availablity  == 'Yes') checked @endif>
                                            <label for="daily_availablity">Available for Daily</label>
                                        </div>
                                        <div class="col-md-4 car_pricing">
                                            <h6>
                                                Minimum Day Booking
                                            </h6>
                                        </div>
                                        <div class="col-md-8 car_pricing">
                                            <select name="days" id="days" class="form-select">
                                                {{-- <option value="Select Days" selected disabled>Select Days</option> --}}
                                                <option value="1" @if ($edit->days == '1') selected @endif  >1
                                                </option>
                                                <option value="2" @if ($edit->days == '2') selected @endif>2
                                                </option>
                                                <option value="3" @if ($edit->days == '3' ) selected @endif>3
                                                </option>
                                                <option value="4" @if ($edit->days == '4' ) selected @endif>4
                                                </option>
                                                <option value="5" @if ($edit->days == '5' ) selected @endif>5
                                                </option>
                                                <option value="6" @if ($edit->days == '6' ) selected @endif>6
                                                </option>
                                                <option value="7" @if ($edit->days == '7' ) selected @endif>7
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 car_pricing">
                                            <h6>
                                                Price Per Week
                                            </h6>
                                        </div>
                                        <div class="col-md-4 car_pricing">
                                            <input class="form-control" id="price_per_week" type="number"
                                                placeholder="AED Charges" name="price_per_week"
                                                value="{{$edit->weekly_rent ?? ''}}">
                                        </div>
                                        <div class="col-md-4 car_pricing">
                                            <input class="form-control" id="weekly_mileage" type="number"
                                                placeholder="Kms" name="weekly_mileage"
                                                value="{{ $edit->weekly_mileage ?? '' }}">
                                        </div>
                                        <div class="col-md-4 car_pricing">

                                        </div>
                                        <div class="col-md-8 car_pricing">
                                            <input type="checkbox" name="available_weekly" id="available_weekly"
                                                value="Yes" @if ($edit->available_weekly  == 'Yes') checked @endif>
                                            <label for="available_weekly">Available for Weekly</label>
                                        </div>
                                        <div class="col-12">
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
                                            <input class="form-control" id="extra_mileage_cost" type="number"
                                                placeholder="AED Charges" name="extra_mileage_cost"
                                                value="{{ $edit->monthly_extra ?? '' }}">
                                        </div>

                                        <div class="col-md-4 car_pricing">
                                            <input type="checkbox" name="extra_free" id="extra_free" value="Yes"
                                            @if ($edit->extra_free  == 'Yes') checked @endif>
                                            <label for="extra_free">It's Free!</label>
                                        </div>
                                        <div class="col-md-4 car_pricing">
                                            <h6>
                                                CDW Insurance Per Day
                                            </h6>
                                        </div>
                                        <div class="col-md-4 car_pricing">
                                            <input class="form-control" id="" type="number" placeholder="Kms"
                                                name="insurance_per_day"
                                                value="{{ $edit->insurance_per_day ?? '' }}">
                                        </div>
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

                                        <?php
                                        $colors = ['White', 'Black', 'Gray', 'Silver', 'Blue', 'Red', 'Brown', 'Green', 'Orange', 'Beige', 'Purple', 'Gold', 'Yellow'];
                                        ?>
                                        @foreach ($colors as $color)
                                        @php
                                            $selectedColors = explode(',', $edit->car_colors);
                                        @endphp
                                        <input type="checkbox" class="btn-check" id="{{ $color }}"
                                            name="car_colors[]" autocomplete="off" value="{{ $color }}"
                                            @if (in_array($color, $selectedColors)) checked @endif>
                                        <label class="btn btn-outline-dark custom_btn" for="{{ $color }}">{{ $color }}</label>
                                        @endforeach

                                    </ul>
                                    <div class="specs_heading">
                                        <h6>
                                            Car Features:
                                        </h6>
                                    </div>
                                    <ul class="specs_list">

                                        <?php
                                        $features = ['3D Surround Camera', 'Memory Front Seats', 'Blind Spot Warning', 'Parking Assist', 'Adaptive Cruise Control', 'Digital HUD', 'Temperature Controlled Seats', 'Built-in-GPS', 'Sunroof/Moonroof', 'Reverse Camera', 'Parking Sensors', 'Steering Assist', 'Dat-time Runing Lights', 'Touchscreen LCD', 'Tinted Windows', 'Paddle Shift(Triptronic)', 'Powered Tailgate', 'Power Seats', 'LCD Screens', 'Leather Seats', 'Air Suspension', 'Gesture Control', 'Push Button Ignition', 'SRS Airbags', 'Front & Rear Airbags', 'Front Air Bags', 'Bluetooth', 'Premium Audio', 'Rear AC', 'Power Mirrors', 'Power Windows', 'Seat Belt Reminder', 'Fabric Seats', 'Alloy Wheels', 'USB', 'Apple CarPlay', 'Android Auto', 'Power Door Locks', 'Foldable Armrest', 'Butterfly Doors', 'Chiller Freezer', 'Sliding Doors', 'For-Light', 'Climate Control', 'Detachable Roof', 'Tail Lift', 'Massaging Seats', 'FM-Radio', 'Stereo MP3 / Cd'];
                                        ?>
                                        @foreach ($features as $feature)
                                        @php
                                            $selectedFeatures = explode(',', $edit->car_features);
                                        @endphp
                                            <li>
                                                <input type="checkbox" class="btn-check" id="{{ $feature }}"
                                                    name="car_features[]" autocomplete="off" value="{{ $feature }}"
                                                    @if (in_array($feature,$selectedFeatures))  checked @endif>
                                                <label class="btn btn-outline-dark custom_btn"
                                                    for="{{ $feature }}">{{ $feature }}</label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="specs_heading">
                                        <h6>
                                            Doors:
                                        </h6>
                                    </div>
                                    <ul class="specs_list">

                                        <li>
                                            <input type="radio" class="btn-check" id="2doors" name="car_doors"
                                                autocomplete="off" value="2"
                                                @if ($edit->car_doors == 2) checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="2doors">2
                                                doors</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="4doors" name="car_doors"
                                                autocomplete="off" value="4"
                                                @if ($edit->car_doors == 4) checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="4doors">4
                                                doors</label>
                                        </li>
                                    </ul>

                                    <div class="specs_heading">
                                        <h6>
                                            Seating Capacity:
                                        </h6>
                                    </div>
                                    <ul class="specs_list">

                                        <li>
                                            <input type="radio" class="btn-check" id="2passengers" name="passengers"
                                                autocomplete="off" value="2"
                                                @if ($edit->passengers == 2) checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="2passengers">2
                                                Seats</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" value="4" id="4passengers"
                                                name="passengers" autocomplete="off"
                                                @if ($edit->passengers == 4) checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="4passengers">4
                                                Seats</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" value="5" id="5passengers"
                                                name="passengers" autocomplete="off"
                                                @if ($edit->passengers == 5) checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="5passengers">5
                                                Seats</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" value="7" id="7passengers"
                                                name="passengers" autocomplete="off"
                                                @if ($edit->passengers == 7) checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="7passengers">7
                                                Seats</label>
                                        </li>
                                    </ul>
                                    <div class="specs_heading">
                                        <h6>
                                            Bags fit :
                                        </h6>
                                    </div>
                                    <ul class="specs_list">

                                        <li>
                                            <input type="radio" class="btn-check" id="bag1" name="bags_fit"
                                                autocomplete="off" value="1"
                                                @if ($edit->bags == 1) checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="bag1">1
                                                bag</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="2bags" name="bags_fit"
                                                autocomplete="off" value="2"
                                                @if ($edit->bags == 2) checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="2bags">2
                                                bags</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="3bags" name="bags_fit"
                                                autocomplete="off" value="3"
                                                @if ($edit->bags == 3) checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="3bags">3
                                                bags</label>
                                        </li>
                                    </ul>
                                    <div class="specs_heading">
                                        <h6>
                                            Specs :
                                        </h6>
                                    </div>
                                    <ul class="specs_list">

                                        <li>
                                            <input type="radio" class="btn-check" id="American_Specs" name="specs"
                                                autocomplete="off" value="American Specs"
                                                @if ($edit->specs == 'American Specs') checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="American_Specs">American
                                                Specs</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="Asia_Specs" name="specs"
                                                autocomplete="off" value="Asia Specs"
                                                @if ($edit->specs == 'Asia Specs') checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="Asia_Specs">Asia
                                                Specs</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="Euro_Specs" name="specs"
                                                autocomplete="off" value="Euro Specs"
                                                @if ($edit->specs == 'Euro Specs') checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="Euro_Specs">Euro
                                                Specs</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="GCC_Specs" name="specs"
                                                autocomplete="off" value="GCC Specs"
                                                @if ($edit->specs == 'GCC Specs') checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="GCC_Specs">GCC
                                                Specs</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="Other" name="specs"
                                                autocomplete="off" value="Other"
                                                @if ($edit->specs == 'Other') checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="Other">Other</label>
                                        </li>
                                    </ul>
                                    <div class="specs_heading">
                                        <h6>
                                            Transmission :
                                        </h6>
                                    </div>
                                    <ul class="specs_list">

                                        <li>
                                            <input type="radio" class="btn-check" id="manual" name="transmission"
                                                autocomplete="off" value="Manual"
                                                @if ($edit->transmission == 'Manual') checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="manual">Manual</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="Auto" name="transmission"
                                                autocomplete="off" value="Auto"
                                                @if ($edit->transmission == 'Auto') checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="Auto">Auto</label>
                                        </li>
                                    </ul>
                                    <div class="specs_heading">
                                        <h6>
                                            Fuel Type:
                                        </h6>
                                    </div>
                                    <ul class="specs_list">

                                        <li>
                                            <input type="radio" class="btn-check" id="petrol" name="fuel_type"
                                                autocomplete="off" value="Petrol"
                                                @if ($edit->fuel_type == 'Petrol') checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="petrol">Petrol</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="diesel" name="fuel_type"
                                                autocomplete="off" value="Diesel"
                                                @if ($edit->fuel_type == 'Diesel') checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="diesel">Diesel</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="Electric" name="fuel_type"
                                                autocomplete="off" value="Electric"
                                                @if ($edit->fuel_type == 'Electric') checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="Electric">Electric</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="Hybrid" name="fuel_type"
                                                autocomplete="off" value="Hybrid"
                                                @if ($edit->fuel_type == 'Hybrid') checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="Hybrid">Hybrid</label>
                                        </li>
                                    </ul>
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
                                            <input class="form-control" id="security_deposit" type="number"
                                                placeholder="AED Charges" name="security_deposit"
                                                value="{{ $edit->security_deposit ?? '' }}">
                                        </div>
                                        <div class="col-md-4 car_pricing">
                                            <h6>
                                                Delivery & Pick up Charges
                                            </h6>
                                        </div>
                                        <div class="col-md-4 car_pricing">
                                            <select name="delivery_days" id="delivery_days" class="form-select mb-0">
                                                <option value="Select Delivery Charges" selected disabled>Select Delivery
                                                    Charges</option>
                                                {{-- <option value="Charges apply">Charges apply</option> --}}
                                                <option value="Free Always"
                                                        @if ($edit->delivery_days == 'Free Always')  selected @endif>Free Always</option>
                                                <option value="Free (2 days+)"
                                                    @if ($edit->delivery_days == 'Free (2 days+)')  selected @endif>Free (2 days+)
                                                </option>
                                                <option value="Free (10 days+)"
                                                @if ($edit->delivery_days == 'Free (10 days+)')  selected @endif>Free (10 days+)
                                                </option>
                                                <option value="Free (15 days+)"
                                                @if ($edit->delivery_days == 'Free (15 days+)')  selected @endif>Free (15 days+)
                                                </option>
                                                <option value="Free (30 days+)"
                                                @if ($edit->delivery_days == 'Free (30 days+)')  selected @endif>Free (30 days+)
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 car_pricing">
                                            <input type="number" name="delivery_charges" id="delivery_charges"
                                                class="form-control" placeholder="AED"
                                                value="{{ $edit->delivery_charges ?? '' }}">
                                        </div>
                                        <div class="col-md-4 car_pricing">
                                            <h6>
                                                Special Note for Customers
                                            </h6>
                                        </div>
                                        <div class="col-md-8">
                                            <textarea name="cutomer_note" id="" cols="30" rows="4" maxlength="200" class="form-control">{{$edit->cutomer_note ?? ''}}</textarea>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <input type="checkbox" name="is_monthly_available" id="is_monthly_available" value="1" @if($edit->is_monthly_available ==1) checked @endif>
                                    <label for="is_monthly_available">Monthly Availability</label>
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
                                                {{-- {{dd($edit->get_mileage)}} --}}
                                                @if(count($edit->get_mileage) > 0)
                                                @foreach ($edit->get_mileage as $mileage)
                                                <input type="hidden" value="1" name="edit_mileage" >
                                                    <tr>
                                                        <td>{{ $mileage->mileage }} km</td>
                                                        <td>
                                                            <input type="text" value="{{ $mileage->one_month ?? '' }}" name="mileage[{{ $mileage->mileage }}][one_month]" placeholder="AED" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" value="{{ $mileage->three_months ?? '' }}" name="mileage[{{ $mileage->mileage }}][three_months]" placeholder="AED" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" value="{{ $mileage->six_months ?? '' }}" name="mileage[{{ $mileage->mileage }}][six_months]" placeholder="AED" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" value="{{ $mileage->nine_months ?? '' }}" name="mileage[{{ $mileage->mileage }}][nine_months]" placeholder="AED" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" value="{{ $mileage->twelve_months ?? '' }}" name="mileage[{{ $mileage->mileage }}][twelve_months]" placeholder="AED" class="form-control">
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @else
                                                    <tr>
                                                        <td>
                                                            2000 km
                                                        </td>
                                                        <td>
                                                            <input type="text" name="mileage[2000][one_month]"
                                                                id="" placeholder="AED" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="mileage[2000][three_months]"
                                                                id="" placeholder="AED" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="mileage[2000][six_months]"
                                                                id="" placeholder="AED" class="form-control">
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
                                                            <input type="text" name="mileage[3000][one_month]"
                                                                id="" placeholder="AED" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="mileage[3000][three_months]"
                                                                id="" placeholder="AED" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="mileage[3000][six_months]"
                                                                id="" placeholder="AED" class="form-control">
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
                                                            <input type="text" name="mileage[4000][one_month]"
                                                                id="" placeholder="AED" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="mileage[4000][three_months]"
                                                                id="" placeholder="AED" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="mileage[4000][six_months]"
                                                                id="" placeholder="AED" class="form-control">
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
                                                            <input type="text" name="mileage[4500][one_month]"
                                                                id="" placeholder="AED" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="mileage[4500][three_months]"
                                                                id="" placeholder="AED" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="mileage[4500][six_months]"
                                                                id="" placeholder="AED" class="form-control">
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
                                                            <input type="text" name="mileage[5000][one_month]"
                                                                id="" placeholder="AED" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="mileage[5000][three_months]"
                                                                id="" placeholder="AED" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="mileage[5000][six_months]"
                                                                id="" placeholder="AED" class="form-control">
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
                                                            <input type="text" name="mileage[6000][one_month]"
                                                                id="" placeholder="AED" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="mileage[6000][three_months]"
                                                                id="" placeholder="AED" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="mileage[6000][six_months]"
                                                                id="" placeholder="AED" class="form-control">
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
                                                    @endif

                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="mb-3">

                            {{-- <form action="" method="" enctype="multipart/form-data" id="my-form">
                        </form> --}}

                            <div class="multiple-uploader" id="multiple-uploader">
                                <div class="mup-msg">
                                    <span class="mup-main-msg">Click to Upload Car images.</span>
                                    <span class="mup-msg" id="max-upload-number">Upload up to 10 images</span>
                                    <span class="mup-msg">Only images are allowed for
                                        upload</span>
                                </div>
                                <input type="file" name="images[]" multiple accept="image/*">
                            </div>

                        </div>
                        <div class="row mt-3">
                          @foreach (json_decode($edit->get_images) as $key => $prouct_image)
                            <div class="col-md-3">

                                <img class="w-75 my-4" src="{{ asset('images/') }}/{{$prouct_image->images}}"
                                    alt="">
                            </div>
                            @endforeach
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <label for="reg_card" class="form-label">Upload Registration Card (Mulkiya)</label>
                                <input type="file" name="registration_card" id="registration_card"
                                    class="form-control" accept="image/*">

                            </div><br>
                            <img  src="{{ asset('registration/') }}/{{$edit->registration_card}}"
                                    alt="" style="width: 100px" height="50px"  >
                            <div class="col-12 mt-5">
                                <div class="specs_heading">
                                    <h6>
                                        Exterior Color:
                                    </h6>
                                </div>
                                <ul class="specs_list">


                                    <?php
                                    $exteriror_colors = [
                                    'Gray' => '#808080',
                                    'White' => '#FFFFFF',
                                    'Black' => '#000000',
                                    'Silver' => '#C0C0C0',
                                    'Blue' => '#0000FF',
                                    'Red' => '#FF0000',
                                    'Brown' => '#A52A2A',
                                    'Green' => '#008000',
                                    'Orange' => '#FFA500',
                                    'Beige' => '#F5F5DC',
                                    'Purple' => '#800080',
                                    'Gold' => '#FFD700',
                                    'Yellow' => '#FFFF00',
                                ];
                                    ?>

                                @foreach ($exteriror_colors as $ext_color => $ext_color_code)
                                @php
                                    $selectExtColor = explode(',', $edit->exterior_color);
                                @endphp
                                <li>
                                    <input type="checkbox" class="btn-check"
                                        id="exterior_color_{{ $ext_color }}" name="exterior_color[]"
                                        autocomplete="off" value="{{ $ext_color }}:{{ $ext_color_code }}"
                                        @if (in_array("$ext_color:$ext_color_code", $selectExtColor)) checked @endif>
                                    <label class="btn btn-outline-dark custom_btn"
                                        for="exterior_color_{{ $ext_color }}" >
                                        {{ $ext_color }}
                                    </label>
                                </li>
                                @endforeach

                                </ul>
                                <div class="specs_heading">
                                    <h6>
                                        Interior Color:
                                    </h6>
                                </div>
                                <ul class="specs_list">


                                    <?php
                                    $interiror_colors = [
                                    'Gray' => '#808080',
                                    'White' => '#FFFFFF',
                                    'Black' => '#000000',
                                    'Silver' => '#C0C0C0',
                                    'Blue' => '#0000FF',
                                    'Red' => '#FF0000',
                                    'Brown' => '#A52A2A',
                                    'Green' => '#008000',
                                    'Orange' => '#FFA500',
                                    'Beige' => '#F5F5DC',
                                    'Purple' => '#800080',
                                    'Gold' => '#FFD700',
                                    'Yellow' => '#FFFF00',
                                ];
                                    ?>

                                    @php
                                        $selectIntColor = explode(',', $edit->interior_color);
                                    @endphp

                                    @foreach ($interiror_colors as $int_color => $int_color_code)
                                        <li>
                                            <input type="checkbox" class="btn-check"
                                                id="interior_color_{{ $int_color }}" name="interior_color[]"
                                                autocomplete="off" value="{{ $int_color }}:{{ $int_color_code }}"
                                                @if (in_array("$int_color:$int_color_code", $selectIntColor)) checked @endif>
                                            <label class="btn btn-outline-dark custom_btn"
                                                for="interior_color_{{ $int_color }}">{{ $int_color }}</label>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                             <div class="col-12">
                                <label for="reg_card" class="form-label">Description</label>
                              <textarea class="form-control editor" id="description" name="description">{{$edit->description}}</textarea>
                            </div>
                            <div class="col-12 mt-4 text-center">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->


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
        {{-- <script src="./src/js/multiple-uploader.js"></script> --}}
        <script src="{{ asset('assets/dropzone/js/multiple-uploader.js') }}"></script>
        <script src="{{ asset('assets/dropzone/js/util.js') }}"></script>
        <script>
            // image uploader

            let multipleUploader = new MultipleUploader('#multiple-uploader').init({
                maxUpload: 20, // maximum number of uploaded images
                maxSize: 2, // in size in mb
                filesInpName: 'images', // input name sent to backend
                formSelector: '#my-form', // form selector
            });
        </script>

<script>
    $("#price_per_day").keyup(function(e){
        var num = this.value.match(/^\d+$/);
        if (num === null || num == 0) {
            this.value = "";
        }
    });
    $("#price_per_week").keyup(function(e){
        var num = this.value.match(/^\d+$/);
        if (num === null || num == 0) {
            this.value = "";
        }
    });
    $("#extra_mileage_cost").keyup(function(e){
        var num = this.value.match(/^\d+$/);
        if (num === null || num == 0) {
            this.value = "";
        }
    });
    $("#security_deposit").keyup(function(e){
        var num = this.value.match(/^\d+$/);
        if (num === null || num == 0) {
            this.value = "";
        }
    });


</script>
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

                $('#brand_name').on('change', function() {
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
                            $('#car_model').html('');
                            var oldCarModel = "{{ old('brand_name') }}";
                            if (response != '') {
                                $.each(response.maincategory, function(value, i) {
                                    var isSelected = i.main_category_name === oldCarModel ?
                                        "selected" : "";

                                    $('#car_model').append(
                                        `<option   value ="${i.main_category_name}" ${isSelected}>${i.main_category_name}</option>`
                                    );
                                });
                            } else {
                                $('#car_model').append('<h3>No Category Found</h3>');
                            }
                        }
                    });
                });
            });
        </script>
        <script>
            var id = ($('select[name="brand_name"]').val());
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
                    $('#car_model').html('');
                    var oldCarModel = "{{ old('car_model') }}";
                    if (response != '') {
                        $.each(response.maincategory, function(value, i) {
                            // var select = (i.id == i.main_category_name ? 'selected="selected"' : '');
                            var select = i.main_category_name === oldCarModel ? "selected" : "";
                            $('#car_model').append(
                                `<option  value ="${i.main_category_name}" ${select} >${i.main_category_name}</option>`
                                );

                        });
                    } else {
                        $('#car_model').append('<h3>No Category Found</h3>');
                    }
                }
            });

            $('#car_model').on('click', function() {
                var id = $("#car_model").val();
                // alert(id);
                $.ajax({
                    type: "GET",
                    url: '{{ route('get_make_year') }}',
                    data: {
                        'id': id
                    },
                    beforeSend: function() {
                        $(".loader-bg").removeClass('loader-active');
                    },
                    success: function(response) {
                        $(".loader-bg").addClass('loader-active');
                        $('#make_year').html('');
                        $('#category').html('');

                        if (response != '') {
                            $.each(response.make_year, function(value, i) {
                                var oldMakeYear = $('#make_year').val();
                                // console.log(i.category);
                                var select = i.make_year === oldMakeYear ? 'selected="selected"' :
                                    '';
                                $('#make_year').append(
                                    `<option  value ="${i.make_year}" ${select} >${i.make_year}</option>`
                                    );

                            var categories = i.category.split(',');
                            console.log(categories);
                            categories.forEach(function (category) {
                            if ($('#category option[value="' + category + '"]').length === 0) {
                                $('#category').append(
                                    `<option  value="${category}" ${select}>${category}</option>`
                                );
                            }
                        });

                            });
                        } else {
                            $('#make_year').append('<h3>No Category Found</h3>');
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
   document.addEventListener('DOMContentLoaded', function() {
    const makeYearSelect = document.getElementById('car_make_year');
    const currentYear = new Date().getFullYear();
    const numYears = 5;  // Number of previous years to include
    const selectedYear = "{{ $edit->make_year }}";  // Replace with the year you want to set as selected

    // Add the upcoming year first
    const upcomingYear = currentYear + 1;
    let option = document.createElement('option');
    option.value = upcomingYear;
    option.textContent = upcomingYear;
    if (upcomingYear == selectedYear) {  // Check if the upcoming year is the selected year
        option.selected = true;
    }
    makeYearSelect.appendChild(option);

    // Add the current year and previous years
    for (let i = 0; i <= numYears; i++) {
        const year = currentYear - i;
        option = document.createElement('option');
        option.value = year;
        option.textContent = year;
        if (year == selectedYear) {  // Check if the current year is the selected year
            option.selected = true;
        }
        makeYearSelect.appendChild(option);
    }
});
 
     </script>
    @endpush
@endsection
