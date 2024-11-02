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
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card tabsBox" id="tabs_id">

                    <form id="my-form" action="{{ route('rent-car-with-driver.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container-fluid">
                            <div class="row mb-3">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-heading">
                                        <h5>Select Car</h5>
                                    </div>
                                    <div class="row car_add_form">
                                        <div class="col-md-4 col-12">
                                            <label for="product_type" style="font-weight: bold;">Select Service Type</label>
                                        </div>
                                        <div class="col-md-8 col-12">

                                            <div class="select-dropdown">
                                                <select id="service_type" for="exampleFormControlInput10"
                                                    class="form-control btn-square type w-100" name="service_type">
                                                    <option value="">Select Service</option>
                                                        <option value="Chauffeur Service">Chauffeur Service</option>
                                                        <option value="Airport Transport">Airport Transport</option>
                                                        <option value="Point to Point Transfer">Point to Point Transfer</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <label for="product_type">Car Brand / Model</label>
                                        </div>
                                        <div class="col-md-4 col-12">

                                            <div class="select-dropdown">
                                                <select id="brand_name" for="exampleFormControlInput10"
                                                    class="form-control btn-square type" name="brand_name">
                                                    <option value="Select Car Brand">Select Car Brand</option>
                                                    @foreach ($brand as $key => $value)
                                                        <option {{ old('brand_name') == $value->id ? 'selected' : '' }}
                                                            value="{{ $value->id }}">{{ $value->brand_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="select-dropdown">
                                                <select class="form-control" id="car_model" name="car_model">
                                                    <option value="Select Car Model">Select Car Model</option>
                                                </select>
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-4 col-12">
                                            <label for="version">Vehicle Type</label>
                                        </div>
                                        <div class="col-md-8 col-12">
                                            <div class="select-dropdown">

                                                <select name="vehicle_type"  class="form-control" >
                                                    <option value="Sedan">Sedan</option>
                                                    <option value="Coupe">Coupe</option>
                                                    <option value="Hatchback">Hatchback</option>
                                                    <option value="Convertible">Convertible</option>
                                                    <option value="Compact">Compact</option>
                                                    <option value="Subcompact">Subcompact</option>
                                                    <option value="SUV ">SUV</option>
                                                    <option value="Crossover">Crossover</option>
                                                    <option value="Pickup Truck">Pickup Truck</option>
                                                    <option value="Minivan">Minivan</option>
                                                    <option value="Van">Van</option>
                                                    <option value="Wagon">Wagon</option>
                                                    <option value="Sports Car">Sports Car </option>
                                                    <option value="Luxury Car">Luxury Car</option>
                                                    <option value="Super Car">Super Car</option>
                                                    <option value="Low Price">Low Price</option>
                                                    <option value="Monthly">Monthly</option>
                                                    <option value="Electric Vehicle (EV)">Electric Vehicle (EV)</option>
                                                    <option value="Hybrid Vehicle">Hybrid Vehicle</option>
                                                    <option value="Diesel Vehicle">Diesel Vehicle</option>
                                                    <option value="Full-Size Car">Full-Size Car</option>
                                                    <option value="Mid-Size Car">Mid-Size Car</option>
                                                    <option value="Microcar">Microcar</option>
                                                    <option value="Roadster">Roadster</option>
                                                    <option value="Off-Road Vehicle">Off-Road Vehicle</option>
                                                    <option value="Muscle Car">Muscle Car</option>
                                                    </select>

                                            </div>
                                        </div> --}}

                                        <div class="col-md-4 col-12">
                                            <label for="version">Category Type</label>
                                        </div>
                                        <div class="col-md-8 col-12 mt-3">
                                            <div class="select-dropdown">
                                                <select name="category_type"  class="form-control" >
                                                    <option value="Sedan">Sedan</option>
                                                    <option value="Coupe">Coupe</option>
                                                    <option value="Hatchback">Hatchback</option>
                                                    <option value="Convertible">Convertible</option>
                                                    <option value="Compact">Compact</option>
                                                    <option value="Subcompact">Subcompact</option>
                                                    <option value="SUV ">SUV</option>
                                                    <option value="Crossover">Crossover</option>
                                                    <option value="Pickup Truck">Pickup Truck</option>
                                                    <option value="Minivan">Minivan</option>
                                                    <option value="Van">Van</option>
                                                    <option value="Wagon">Wagon</option>
                                                    <option value="Sports Car">Sports Car </option>
                                                    <option value="Luxury Car">Luxury Car</option>
                                                    <option value="Super Car">Super Car</option>
                                                    <option value="Low Price">Low Price</option>
                                                    <option value="Monthly">Monthly</option>
                                                    <option value="Electric Vehicle (EV)">Electric Vehicle (EV)</option>
                                                    <option value="Hybrid Vehicle">Hybrid Vehicle</option>
                                                    <option value="Diesel Vehicle">Diesel Vehicle</option>
                                                    <option value="Full-Size Car">Full-Size Car</option>
                                                    <option value="Mid-Size Car">Mid-Size Car</option>
                                                    <option value="Microcar">Microcar</option>
                                                    <option value="Roadster">Roadster</option>
                                                    <option value="Off-Road Vehicle">Off-Road Vehicle</option>
                                                    <option value="Muscle Car">Muscle Car</option>
                                                </select>
                                            </div>
                                        </div>

                                      

                                        <div class="col-md-4 col-12 mt-3">
                                            <label for="make_year">Make (Year)</label>
                                        </div>
                                        <div class="col-md-8 col-12 mt-3">
                                            <div class="select-dropdown">

                                                <select class="form-control" id="car_make_year" name="make_year" required>
                                                </select>

                                                
                                            </div>
                                        </div>

                                        
                                        <div class="col-md-4 col-12 mt-3">
                                            <label for="make_year">City</label>
                                        </div>
                                        <div class="col-md-8 col-12 mt-3">
                                            <div class="select-dropdown">
                                                <select class="form-control"  name="city">
                                                <option value="Dubai"  >Dubai</option>
                                                <option value="Abu Dhabi">Abu Dhabi</option>
                                                <option value="Fujairah" >Fujairah</option>
                                                <option value="Ajman" >Ajman</option>
                                                <option value="Al Ain" >Al Ain</option>
                                                <option value="Sharjah" >Sharjah</option>
                                                <option value="Ras Al Khaimah">Ras Al Khaimah</option>
                                                <option value="Umm Al Qwain">Umm Al Qwain</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12" id="car_images">
                                            <div class="car_image">
                                                <img src="https://www.transparentpng.com/thumb/car-png/car-free-transparent-png-8.png"
                                                    alt="">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="row car_add_form">
                                        <div class="mb-3" id="hour_price">
                                            <h5>Pricing</h5>
                                        </div>

                                        <div class="col-md-4 car_pricing" id="min_package">
                                            <h6>
                                                Min Package Hours
                                            </h6>
                                        </div>
                                        <div class="col-md-4 car_pricing" id="min_package_charges">
                                            <input class="form-control" id="minimunm_hours_booking" type="number"
                                                placeholder="Enter Hours" name="minimunm_hours_booking"
                                                value="{{ old('minimunm_hours_booking') }}">
                                        </div>
                                        <div class="col-md-4 car_pricing" id="min_hour_booking">
                                            <input class="form-control" id="minimunm_hours_booking_charges" type="number" placeholder="AED Charges"
                                                name="minimunm_hours_booking_charges" value="{{ old('minimunm_hours_booking_charges') }}">
                                        </div>
                                        <div class="col-md-4 car_pricing">

                                        </div>
                                        <div class="col-md-8 car_pricing" id="min_hour_charges">
                                            
                                            <label for="daily_availablity mt-2">Extra Hour Charges Minimum</label>
                                            <input class="form-control mt-2" id="additional_hour_minimum_charges" type="number"
                                            placeholder="Enter Extra Hours Charges AED" name="additional_hour_minimum_charges"
                                            value="{{ old('additional_hour_minimum_charges') }}">
                                        </div>
                                        <div class="col-md-4 car_pricing" id="max_package_hours">
                                            <h6>
                                              Max Package Hours
                                            </h6>
                                        </div>
                                        <div class="col-md-4 car_pricing" id="max_hours_book">
                                            <input class="form-control" id="maximunm_hours_booking" type="number"
                                                placeholder="Maximum Hours" name="maximunm_hours_booking"
                                                value="{{ old('maximunm_hours_booking') }}">
                                        </div>
                                        <div class="col-md-4 car_pricing" id="max_hours_booking_charges">
                                            <input class="form-control" id="maximunm_hours_booking_charges" type="number" placeholder="AED Charges"
                                                name="maximunm_hours_booking_charges" value="{{ old('maximunm_hours_booking_charges') }}">
                                        </div>

                                        <div class="col-md-4 car_pricing">

                                        </div>
                                        <div class="col-md-8 car_pricing" id="add_hour_max">
                                            
                                            <label for="daily_availablity mt-2">Extra Hour Charges Maximum</label>
                                            <input class="form-control mt-2" id="additional_hour_maximum_charges" type="number"
                                            placeholder="Enter Extra Hours Charges AED" name="additional_hour_maximum_charges"
                                            value="{{ old('additional_hour_maximum_charges') }}">
                                        </div>


                                        <div class="mb-3" id="pricing">
                                            <h5>Pricing</h5>
                                        </div>
                                        
                                        <div class="col-md-4 car_pricing"  id="within_city">
                                            <h6>
                                               Within City 
                                            </h6>
                                        </div>
                                        <div class="col-md-4 car_pricing"  id="within_city_name">
                                            <input class="form-control" id="transfer_city_name" type="text"
                                                placeholder="Enter City Name" name="transfer_city_name"
                                                value="{{ old('transfer_city_name') }}">
                                        </div>
                                        <div class="col-md-4 car_pricing"  id="within_city_charge">
                                            <input class="form-control" id="transfer_city_charges" type="number" placeholder="AED Charges"
                                                name="transfer_city_charges" value="{{ old('transfer_city_charges') }}">
                                        </div>
                                       
                                        <div class="col-md-4 car_pricing"  id="city_to_city">
                                            <h6>
                                           City To City Transfer
                                            </h6>
                                        </div>
                                        <div class="col-md-4 car_pricing"  id="from_city">
                                            <input class="form-control" id="from_city" type="text"
                                                placeholder="From City Name" name="from_city"
                                                value="{{ old('from_city') }}">
                                        </div>
                                        <div class="col-md-4 car_pricing" id="to_city">
                                            <input class="form-control" id="to_city" type="text" placeholder="To City Name"
                                                name="to_city" value="{{ old('to_city') }}">
                                        </div>

                                        <div class="col-md-4 car_pricing">

                                        </div>
                                        <div class="col-md-8 car_pricing"  id="city_to_cahrges">
                                            
                                            <label for="daily_availablity mt-2">City To City Charges</label>
                                            <input class="form-control mt-2" id="from_city_to_city_charges" type="number"
                                            placeholder="Charges AED" name="from_city_to_city_charges"
                                            value="{{ old('from_city_to_city_charges') }}">
                                        </div>
                                
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 " id="car_specs">
                                    <div class="form-heading">
                                        <h5>Car Specs</h5>
                                    </div>
                                
                                    <div class="specs_heading">
                                        <h6>
                                            Car Features:
                                        </h6>
                                    </div>
                                    <ul class="specs_list">

                                        <?php
                                        $features = ['3D Surround Camera', 'Memory Front Seats', 'Blind Spot Warning', 'Parking Assist', 'Adaptive Cruise Control', 'Digital HUD', 'Temperature Controlled Seats', 'Built-in-GPS', 'Sunroof/Moonroof', 'Reverse Camera', 'Parking Sensors', 'Steering Assist', 'Day-time Runing Lights', 'Touchscreen LCD', 'Tinted Windows', 'Paddle Shift(Triptronic)', 'Powered Tailgate', 'Power Seats', 'LCD Screens', 'Leather Seats', 'Air Suspension', 'Gesture Control', 'Push Button Ignition', 'SRS Airbags', 'Front & Rear Airbags', 'Front Air Bags', 'Bluetooth', 'Premium Audio', 'Rear AC', 'Power Mirrors', 'Power Windows', 'Seat Belt Reminder', 'Fabric Seats', 'Alloy Wheels', 'USB', 'Apple CarPlay', 'Android Auto', 'Power Door Locks', 'Foldable Armrest', 'Butterfly Doors', 'Chiller Freezer', 'Sliding Doors', 'Fog-Lights', 'Climate Control', 'Detachable Roof', 'Tail Lift', 'Massaging Seats', 'FM-Radio', 'Stereo MP3 / Cd'];
                                        ?>
                                        @foreach ($features as $feature)
                                            <li>
                                                <input type="checkbox" class="btn-check" id="{{ $feature }}"
                                                    name="car_features[]" autocomplete="off" value="{{ $feature }}"
                                                    @if (is_array(old('car_features')) && in_array($feature, old('car_features'))) checked @endif>
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
                                                @if (old('car_doors') == '2') checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="2doors">2
                                                doors</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="4doors" name="car_doors"
                                                autocomplete="off" value="4"
                                                @if (old('car_doors') == '4') checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="4doors">4
                                                doors</label>
                                        </li>
                                    </ul>

                                    <div class="specs_heading">
                                        <h6>
                                            Passengers:
                                        </h6>
                                    </div>
                                    <ul class="specs_list">

                                        <li>
                                            <input type="text" name="passengers" class="form-control w-100" id="" placeholder="Passengers">
                                        </li>
                                    </ul>
                                    <div class="specs_heading">
                                        <h6>
                                           Luggage :
                                        </h6>
                                    </div>
                                    <ul class="specs_list">

                                        <li>
                                            <input type="radio" class="btn-check" id="bag1" name="luggage"
                                                autocomplete="off" value="1"
                                                @if (old('luggage') == '1') checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="bag1">1
                                                bag</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="2bags" name="luggage"
                                                autocomplete="off" value="2"
                                                @if (old('luggage') == '2') checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="2bags">2
                                                bags</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="3bags" name="luggage"
                                                autocomplete="off" value="3"
                                                @if (old('luggage') == '3') checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="3bags">3
                                                bags</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="4bags" name="luggage"
                                                autocomplete="off" value="4"
                                                @if (old('luggage') == '4') checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="4bags">4
                                                bags</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="5bags" name="luggage"
                                                autocomplete="off" value="5"
                                                @if (old('luggage') == '5') checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="5bags">5
                                                bags</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="6bags" name="luggage"
                                                autocomplete="off" value="6"
                                                @if (old('luggage') == '6') checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="6bags">6
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
                                                @if (old('specs') == 'American Specs') checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="American_Specs">American
                                                Specs</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="Asia_Specs" name="specs"
                                                autocomplete="off" value="Asia Specs"
                                                @if (old('specs') == 'Asia Specs') checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="Asia_Specs">Asia
                                                Specs</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="Euro_Specs" name="specs"
                                                autocomplete="off" value="Euro Specs"
                                                @if (old('specs') == 'Euro Specs') checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="Euro_Specs">Euro
                                                Specs</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="GCC_Specs" name="specs"
                                                autocomplete="off" value="GCC Specs"
                                                @if (old('specs') == 'GCC Specs') checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="GCC_Specs">GCC
                                                Specs</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="Other" name="specs"
                                                autocomplete="off" value="Other"
                                                @if (old('specs') == 'Other') checked @endif>
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
                                                @if (old('transmission') == 'Manual') checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="manual">Manual</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="Auto" name="transmission"
                                                autocomplete="off" value="Auto"
                                                @if (old('transmission') == 'Auto') checked @endif>
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
                                                @if (old('fuel_type') == 'Petrol') checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="petrol">Petrol</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="diesel" name="fuel_type"
                                                autocomplete="off" value="Diesel"
                                                @if (old('fuel_type') == 'Diesel') checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="diesel">Diesel</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="Electric" name="fuel_type"
                                                autocomplete="off" value="Electric"
                                                @if (old('fuel_type') == 'Electric') checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="Electric">Electric</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" id="Hybrid" name="fuel_type"
                                                autocomplete="off" value="Hybrid"
                                                @if (old('fuel_type') == 'Hybrid') checked @endif>
                                            <label class="btn btn-outline-dark custom_btn" for="Hybrid">Hybrid</label>
                                        </li>
                                    </ul>
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
                            <div class="col-12">
                                <label for="reg_card" class="form-label">Upload Registration Card (Mulkiya)</label>
                                <input type="file" name="registration_card" id="registration_card"
                                    class="form-control" accept="image/*">
                            </div>

                            <div class="col-12">
                                <label for="reg_card" class="form-label">Description</label>
                              <textarea class="form-control editor" id="description" name="description"></textarea>
                            </div>
                           
                            <div class="col-12 mt-4">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
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

                                    var firstCarModel = response.maincategory[0];

                                    // Build the HTML structure for car image using the first item's image
                                    var modelImageSrc = `http://localhost/onetapdrive/public/model_image/${firstCarModel.image}`;
                                    console.log(modelImageSrc);
                                    var carImageHtml = `
                                    
                                            <div class="car_image">
                                                <img src="${modelImageSrc}" alt="${firstCarModel.main_category_name}">
                                            </div>
                                    `;

                                    // Append car image HTML to #car_images
                                    $('#car_images').html(carImageHtml);
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

                                var firstCarModel = response.maincategory[0];

                                    // Build the HTML structure for car image using the first item's image
                                    var modelImageSrc = `https://onetapdrive.com/public/model_image/${firstCarModel.image}`;
                                    console.log(modelImageSrc);
                                    var carImageHtml = `
                                    
                                            <div class="car_image">
                                                <img src="${modelImageSrc}" alt="${firstCarModel.main_category_name}">
                                            </div>
                                    `;

                                    // Append car image HTML to #car_images
                                    $('#car_images').html(carImageHtml);

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
                                    var firstCarModel = response.make_year[0];
                                        if(firstCarModel.image != null){

                                    // Build the HTML structure for car image using the first item's image
                                    var modelImageSrc = `https://onetapdrive.com/public/model_image/${firstCarModel.image}`;
                                    console.log(modelImageSrc);
                                    var carImageHtml = `
                                            <div class="car_image">
                                                <img src="${modelImageSrc}" alt="${firstCarModel.main_category_name}">
                                            </div>
                                    `;

                                    // Append car image HTML to #car_images
                                    $('#car_images').html(carImageHtml);
                                }else{
                                    var carImageHtml = `
                                    <div class="car_image">
                                                <img src="https://www.transparentpng.com/thumb/car-png/car-free-transparent-png-8.png"
                                                    alt="">
                                            </div>
                                    `;

                                }
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
            $("#service_type").on('change',function(){
                var service = $(this).val();
                console.log(service);
                if(service == 'Chauffeur Service'){
                    $("#pricing").hide();
                    $("#within_city").hide();
                    $("#within_city_name").hide();
                    $("#within_city_charge").hide();
                    $("#city_to_city").hide();
                    $("#from_city").hide();
                    $("#to_city").hide();
                    $("#city_to_cahrges").hide();


                    $("#hour_price").show();
                    $("#min_package").show();
                    $("#min_package_charges").show();
                    $("#min_hour_booking").show();
                    $("#min_hour_charges").show();
                    $("#max_package_hours").show();
                    $("#max_hours_book").show();
                    $("#max_hours_booking_charges").show();
                    $("#add_hour_max").show();
                    $("#car_specs").show();
                }else{
                    $("#pricing").show();
                    $("#within_city").show();
                    $("#within_city_name").show();
                    $("#within_city_charge").show();
                    $("#city_to_city").show();
                    $("#from_city").show();
                    $("#to_city").show();
                    $("#city_to_cahrges").show();
                    $("#hour_price").hide();
                    $("#min_package").hide();
                    $("#min_package_charges").hide();
                    $("#min_hour_booking").hide();
                    $("#min_hour_charges").hide();
                    $("#max_package_hours").hide();
                    $("#max_hours_book").hide();
                    $("#max_hours_booking_charges").hide();
                    $("#add_hour_max").hide();
                    $("#car_specs").hide();
                }
            });
        </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
         const makeYearSelect = document.getElementById('car_make_year');
         const currentYear = new Date().getFullYear();
         const numYears = 5;  // Number of previous years to include
 
         // Add the upcoming year first
         const upcomingYear = currentYear + 1;
         let option = document.createElement('option');
         option.value = upcomingYear;
         option.textContent = upcomingYear;
         makeYearSelect.appendChild(option);
 
         // Add the current year and previous years
         for (let i = 0; i <= numYears; i++) {
             const year = currentYear - i;
             option = document.createElement('option');
             option.value = year;
             option.textContent = year;
             makeYearSelect.appendChild(option);
         }
     });
 
     </script>
    @endpush
@endsection
