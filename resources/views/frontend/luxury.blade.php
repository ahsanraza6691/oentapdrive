@extends('frontend.layouts.new_header')
@section('title', 'Luxury Car Rental Dubai | Rent Sports & Exotic Cars in Dubai | OneTapDrive')
@section('content')

    <section class="linkingSec">
        <div class="container-lg">
            <div class="row">
                <div class="col-md-12">
                    <div class="filterBtnRow">
                        <ul class="linkingCont">
                            <li><a href="{{route('home')}}" class="fa fa-home"></a></li>
                            <!-- Dynamic location -->
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li><a href="javascipt:void(0)">{{ request()->query('city') ?? 'Dubai' }}</a></li>
                            <li class="javascipt:void(0)"><span>Luxury Cars</span></li>
                        </ul>
                        <div class="filter_action">
                            <button class="styled_button rounded_sm filter_action" id="filterBtn" type="button">
                                {{-- <div></div>
                                <div></div>
                                <div></div> --}}
                                <i class="fas fa-filter"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="productsSec">
        <div class="container-lg">
            <div class="row">
                <div class="col-lg-3">
                    <div class="mobileAdd">
                        <img src="{{asset("/web-assets/images/appBanner.jpg")}}" alt="">
                    </div>
                </div>
                <div class="col-lg-9">
                   <div class="adsBannerCont">
                       <div class="swiper-button-prev"></div>
                       <div class="adsBannerSlider swiper">
                           <div class="swiper-wrapper">
                               <div class="swiper-slide">
                                   <figure class="addBanner">
                                       <img src="{{asset('/web-assets/images/ads/1.jpg')}}" alt="">
                                   </figure>
                               </div>
                               <div class="swiper-slide">
                                   <figure class="addBanner">
                                       <img src="{{asset('/web-assets/images/ads/2.jpg')}}" alt="">
                                   </figure>
                               </div>
                               <div class="swiper-slide">
                                   <figure class="addBanner">
                                       <img src="{{asset('/web-assets/images/ads/3.jpg')}}" alt="">
                                   </figure>
                               </div>
                           </div>
                       </div>
                       <div class="swiper-button-next"></div>
                   </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="filterCont">
                        <form method="GET" action="{{ route('luxury-car-rental-dubai') }}">
                            <div id="filters" class="filters">
                                <h2>
                                    Filters
                                </h2>

                                <div class="collapse_wrap">
                                    <div class="collapse_items">
                                        <!-- Location -->

                                        <div id="location" class="custom_collapse"
                                             @if (isset($_GET['city']) && !empty($_GET['city'])) style="height: 118px;" @endif>
                                            <button type="button" onclick="onOpenCollapse('location')">
                                                <span> Location </span>
                                                <i id="location-arrow" class="fa fa-angle-down"></i>
                                            </button>

                                            <div id="location-content" class="collapse_content">
                                                <select class="form-control" name="city">
                                                    {{-- <option value="">Select Location</option> --}}

                                                    @php
                                                        $uniqueCities = [];
                                                    @endphp

                                                    @if ($filters_data)
                                                        @foreach ($filters_data as $car)
                                                            @php
                                                                $city = $car->city ?? '';
                                                                if (!in_array($city, $uniqueCities)) {
                                                                    $uniqueCities[] = $city;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    @endif

                                                    @foreach ($uniqueCities as $city)
                                                        @php
                                                            $CitySelected = '';
                                                        @endphp
                                                        @if (isset($_GET['city']) && $_GET['city'] == $city)
                                                            @php
                                                                $CitySelected = 'selected';

                                                            @endphp
                                                        @endif

                                                        <option value="{{ $city }}" {{ $CitySelected }}>{{ $city }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                                <button class="updateBtn">update</button>
                                            </div>
                                        </div>

                                        <!-- Car Brand / Model -->
                                        <div id="carBrand" class="custom_collapse"
                                             @if (isset($_GET['brand']) && !empty($_GET['brand'])) style="height: 240px;" @endif>
                                            <button type="button" onclick="onOpenCollapse('carBrand')">
                                                <span> Car Brand / Model </span>
                                                <i id="carBrand-arrow" class="fa fa-angle-down"></i>
                                            </button>
                                            <form method="GET" action="{{ route('luxury-car-rental-dubai') }}">
                                                <div id="carBrand-content" class="collapse_content">
                                                    <div><input type="hidden" id="language" value="english">
                                                        <input type="hidden" id="css" value=""> <label title="">Car
                                                            Brand</label> <span id="show_before4"> <select
                                                                class="form-control"
                                                                name="brand"
                                                                id="carmake">
                                                    <option value="">Select Car Make</option>
                                                    @php
                                                        $brandCounts = [];
                                                    @endphp
                                                                @if (!empty($filters_data))
                                                                    @foreach ($filters_data as $car)
                                                                        @php
                                                                            $brandName = $car->get_brand_name->brand_name ?? '';

                                                                            if (isset($brandCounts[$brandName])) {
                                                                                $brandCounts[$brandName]++;
                                                                            }
                                                                            $brandCounts[$brandName] = 1;
                                                                        @endphp
                                                                    @endforeach
                                                                @endif

                                                                @if (!empty($brandCounts))
                                                                    @foreach ($brandCounts as $brandName => $count)
                                                                        @php
                                                                            $brandId = ''; // Initialize brand_id
                                                                            // Find the first car with the matching brand name
                                                                            foreach ($filters_data as $car) {
                                                                                if (
                                                                                    $car->get_brand_name->brand_name === $brandName
                                                                                ) {
                                                                                    $brandId = $car->brand_id;
                                                                                    break;
                                                                                }
                                                                            }
                                                                        @endphp

                                                                        @php
                                                                            $OptionSelected = '';
                                                                        @endphp
                                                                        @if (isset($_GET['brand']) && $_GET['brand'] == $brandId)
                                                                            @php
                                                                                $OptionSelected = 'selected';

                                                                            @endphp
                                                                        @endif


                                                                        <option value="{{ $brandId }}" {{ $OptionSelected }}>
                                                                {{ $brandName }}
                                                                ({{ $count }})
                                                            </option>
                                                                    @endforeach
                                                                @endif
                                                </select>


                                            </span>
                                                    </div>


                                                    {{-- car model --}}

                                                    <span id="show_heading" class="bodrdis"
                                                          style="display: inline;"> <label
                                                            class="mt-3" title="">Car
                                                Model</label>
                                            <div id="show_sub_categories" style="color: black; display: block;">
                                                <select class="form-control" name="carmodel" id="carmodel2">
                                                    <option value="0" selected="selected">Select Car Model</option>
                                                    {{-- <option value="1327">
                                                Chiron Sports</option> --}}
                                                </select>
                                            </div>

                                        </span>
                                                    <button style="display: none" id="showbut"><span
                                                            class="badge badge-primary bg_orange mt-2 cursor_pointer">Update</span>
                                                    </button>
                                                    <button class="updateBtn">update</button>


                                                </div>
                                            </form>


                                        </div>

                                        <!-- Model Year -->
                                        <div id="modelYear" class="custom_collapse"
                                             @if (isset($_GET['year']) && !empty($_GET['year'])) style="height: 118px;" @endif>
                                            <button type="button" onclick="onOpenCollapse('modelYear')">
                                                <span> Model Year </span>
                                                <i id="modelYear-arrow" class="fa fa-angle-down"></i>
                                            </button>
                                            <div id="modelYear-content" class="collapse_content">
                                                <select class="form-control" name="year" id="year2">
                                                    <option value="" selected="selected">Select</option>
                                                    {{-- <option value="2022">2022</option> --}}
                                                </select>
                                                <button class="updateBtn">update</button>
                                                {{-- <button><span class="badge badge-primary bg_orange mt-2 cursor_pointer">Update</span></button> --}}
                                            </div>
                                        </div>

                                        <!-- No. of Seats -->
                                        <div id="seats" class="custom_collapse"
                                             @if (isset($_GET['passengers']) && !empty($_GET['passengers'])) style="height: 188px;" @endif>
                                            <button type="button" onclick="onOpenCollapse('seats')">
                                                <span> No. of Seats </span>
                                                <i id="seats-arrow" class="fa fa-angle-down"></i>
                                            </button>
                                            <div id="seats-content" class="collapse_content">
                                                <div class="form-check">
                                                    <div class="checkboxInput">
                                                        <input type="checkbox" value="1-2"
                                                               id="flexCheckChecked"
                                                               name="passengers[]"
                                                        @if (isset($_GET['passengers']) && !empty($_GET['passengers'])) @php

                                                            $valueToCheck = '1-2';
                                                            $arrayToCheck = $_GET['passengers'];

                                                            if (in_array($valueToCheck, $arrayToCheck)) {
                                                                echo "checked";
                                                            }

                                                        @endphp @endif>
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        1-2 Seats
                                                    </label>
                                                    <button class="updateBtn">update</button>
                                                </div>
                                                <div class="form-check">
                                                    <div class="checkboxInput">
                                                        <input type="checkbox" value="4-5"
                                                               id="flexCheckChecked2" name="passengers[]"
                                                        @if (isset($_GET['passengers']) && !empty($_GET['passengers'])) @php

                                                            $valueToCheck = '4-5';
                                                            $arrayToCheck = $_GET['passengers'];

                                                            if (in_array($valueToCheck, $arrayToCheck)) {
                                                                echo "checked";
                                                            }

                                                        @endphp @endif>
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                    <label class="form-check-label" for="flexCheckChecked2">
                                                        4-5 Seats
                                                    </label>
                                                    <button class="updateBtn">update</button>
                                                </div>
                                                <div class="form-check">
                                                    <div class="checkboxInput">
                                                        <input type="checkbox" value="6-7"
                                                               id="flexCheckChecked3" name="passengers[]"
                                                        @if (isset($_GET['passengers']) && !empty($_GET['passengers'])) @php

                                                            $valueToCheck = '6-7';
                                                            $arrayToCheck = $_GET['passengers'];

                                                            if (in_array($valueToCheck, $arrayToCheck)) {
                                                                echo "checked";
                                                            }

                                                        @endphp @endif>
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                    <label class="form-check-label" for="flexCheckChecked3">
                                                        6-7 Seats
                                                    </label>
                                                    <button class="updateBtn">update</button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Vehicle Type -->
                                        <div id="vehicleType" class="custom_collapse"
                                             @if (isset($_GET['category']) && !empty($_GET['category'])) style="height: 260px;" @endif>
                                            <button type="button" onclick="onOpenCollapse('vehicleType')">
                                                <span> Vehicle Type </span>
                                                <i id="vehicleType-arrow" class="fa fa-angle-down"></i>
                                            </button>
                                            <div id="vehicleType-content" class="collapse_content checkboxCollapse">
                                                @php
                                                    $categories = [];

                                                    if (!empty($filters_data)) {
                                                        foreach ($filters_data as $car) {
                                                            $category = $car->category;
                                                            if (isset($categories[$category])) {
                                                                $categories[$category]++;
                                                            } else {
                                                                $categories[$category] = 1;
                                                            }
                                                        }
                                                    }

                                                    // Filter the unique categories
                                                    $uniqueCategories = array_keys($categories);
                                                @endphp

                                                @php
                                                    $checked = '';

                                                @endphp

                                                @if (!empty($uniqueCategories))
                                                    @foreach ($uniqueCategories as $category)
                                                        <div class="form-check">

                                                            @if (isset($_GET['category']) && !empty($_GET['category']))
                                                                @php
                                                                    $arrayToCheck = $_GET['category'];
                                                                    $checked = '';

                                                                    if (in_array($category, $arrayToCheck)) {
                                                                        $checked = 'checked';
                                                                    }

                                                                @endphp
                                                            @endif

                                                            <div class="checkboxInput">
                                                                <input class="" type="checkbox"
                                                                       name="category[]"
                                                                       value="{{ $category }}" id="{{ $category }}"
                                                                    {{ $checked }}>
                                                                <i class="fas fa-check"></i>
                                                            </div>
                                                            <label class="form-check-label" for="{{ $category }}">
                                                                {{ $category }} ({{ $categories[$category] }})
                                                            </label>
                                                            <button class="updateBtn">update</button>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Price Range -->
                                        <div id="priceRange" class="custom_collapse"
                                             @if (
                                                 (isset($_GET['min_price']) && !empty($_GET['min_price'])) ||
                                                     (isset($_GET['max_price']) && !empty($_GET['max_price']))) style="height: 164px;" @endif>
                                            <button type="button" onclick="onOpenCollapse('priceRange')">
                                                <span> Price Range </span>
                                                <i id="priceRange-arrow" class="fa fa-angle-down"></i>
                                            </button>
                                            <div id="priceRange-content" class="collapse_content">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="day" class="form-label f_12">Minimum
                                                                Budget</label>
                                                            <input type="number" name="min_price" class="form-control"
                                                                   id="day" min="0"
                                                                   @if (isset($_GET['min_price']) && !empty($_GET['min_price'])) value="{{ $_GET['min_price'] }}" @endif>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="month" class="form-label f_12">Maximum
                                                                Budget</label>
                                                            <input type="number" name="max_price" class="form-control"
                                                                   id="month" min="0"
                                                                   @if (isset($_GET['max_price']) && !empty($_GET['max_price'])) value="{{ $_GET['max_price'] }}" @endif>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button class="updateBtn">update</button>
                                                    </div>
                                                    {{-- <div class="row">
                                                    <button type="button" class="btn_warning ms-auto">Update</button>

                                                </div> --}}
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Rental Period -->
                                        <div id="rentalPeriod" class="custom_collapse"
                                             @if (isset($_GET['min_days_booking']) && !empty($_GET['min_days_booking'])) style="height: 118px;" @endif>
                                            <button type="button" onclick="onOpenCollapse('rentalPeriod')">
                                                <span> Rental Period </span>
                                                <i id="rentalPeriod-arrow" class="fa fa-angle-down"></i>
                                            </button>
                                            <div id="rentalPeriod-content" class="collapse_content">
                                                <select class="form-control" id="min_days_booking2"
                                                        name="min_days_booking">
                                                    <option value="0">Select rental period</option>
                                                    <option value="1"
                                                            @if (isset($_GET['min_days_booking']) && !empty($_GET['min_days_booking']) && $_GET['min_days_booking'] == 1) selected @endif>
                                                        1 day
                                                    </option>
                                                    <option value="2"
                                                            @if (isset($_GET['min_days_booking']) && !empty($_GET['min_days_booking']) && $_GET['min_days_booking'] == 2) selected @endif>
                                                        2 day
                                                    </option>
                                                    <option value="3"
                                                            @if (isset($_GET['min_days_booking']) && !empty($_GET['min_days_booking']) && $_GET['min_days_booking'] == 3) selected @endif>
                                                        3 day
                                                    </option>
                                                    <option value="4"
                                                            @if (isset($_GET['min_days_booking']) && !empty($_GET['min_days_booking']) && $_GET['min_days_booking'] == 4) selected @endif>
                                                        4 day
                                                    </option>
                                                    <option value="5"
                                                            @if (isset($_GET['min_days_booking']) && !empty($_GET['min_days_booking']) && $_GET['min_days_booking'] == 5) selected @endif>
                                                        5 day
                                                    </option>
                                                    <option value="6"
                                                            @if (isset($_GET['min_days_booking']) && !empty($_GET['min_days_booking']) && $_GET['min_days_booking'] == 6) selected @endif>
                                                        6 day
                                                    </option>
                                                    <option value="7"
                                                            @if (isset($_GET['min_days_booking']) && !empty($_GET['min_days_booking']) && $_GET['min_days_booking'] == 7) selected @endif>
                                                        7+ days
                                                    </option>
                                                    <option value="30"
                                                            @if (isset($_GET['min_days_booking']) && !empty($_GET['min_days_booking']) && $_GET['min_days_booking'] == 30) selected @endif>
                                                        Monthly
                                                    </option>
                                                </select>
                                                <button class="updateBtn">update</button>
                                            </div>
                                        </div>

                                        <!-- Car Features -->
                                        <div id="carFeatures" class="custom_collapse"
                                             @if (isset($_GET['car_features']) && !empty($_GET['car_features'])) style="height: 1412px;" @endif>
                                            <button type="button" onclick="onOpenCollapse('carFeatures')">
                                                <span> Car Features </span>
                                                <i id="carFeatures-arrow" class="fa fa-angle-down"></i>
                                            </button>
                                            <div id="carFeatures-content" class="collapse_content">

                                                @if (!empty($filters_data))
                                                    @foreach ($filters_data->unique('car_features') as $fetaures)
                                                        @php
                                                            $car_features = explode(',', $fetaures->car_features);
                                                        @endphp
                                                    @endforeach
                                                @endif

                                                @php
                                                    $checked = '';
                                                    // echo "<pre>";print_r($_GET['car_features']);exit;
                                                @endphp

                                                @if (!empty($car_features))
                                                    @foreach ($car_features as $feature)
                                                        @if (isset($_GET['car_features']) && !empty($_GET['car_features']))
                                                            @php
                                                                $arrayToCheck = $_GET['car_features'];
                                                                $checked = '';
                                                                if (in_array($feature, $arrayToCheck)) {
                                                                    $checked = 'checked';
                                                                }

                                                            @endphp
                                                        @endif


                                                        <div class="form-check">
                                                            <div class="checkboxInput">
                                                                <input class="" name="car_features[]"
                                                                       type="checkbox"
                                                                       value="{{ $feature }}" {{ $checked }}
                                                                       id="Bluetooth">
                                                                <i class="fas fa-check"></i>
                                                            </div>
                                                            <label class="form-check-label" for="{{ $feature }}">
                                                                {{ $feature }}
                                                            </label>
                                                            <button class="updateBtn">update</button>
                                                        </div>
                                                    @endforeach
                                                @endif

                                            </div>
                                        </div>

                                        <!-- Payment Mode -->
                                    {{-- <div id="paymentMode" class="custom_collapse">
                                        <button type="button" onclick="onOpenCollapse('paymentMode')">
                                            <span> Payment Mode </span>
                                            <i id="paymentMode-arrow" class="fa fa-angle-down"></i>
                                        </button>
                                        <div id="paymentMode-content" class="collapse_content">
                                            <div class="form-check">
                                                <input class="form-check-input" name="payment_method[]" type="checkbox"
                                                    value="Credit Card" id="Credit_Card">
                                                <label class="form-check-label" for="Credit_Card">
                                                    Credit Card
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="payment_method[]" type="checkbox"
                                                    value="Debit Card" id="Debit_Card">
                                                <label class="form-check-label" for="Debit_Card">
                                                    Debit Card
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="payment_method[]" type="checkbox"
                                                    value="Cash" id="cash">
                                                <label class="form-check-label" for="cash">
                                                    Cash
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="payment_method[]" type="checkbox"
                                                    value="Bitcoin/Crypto" id="Bitcoin/Crypto">
                                                <label class="form-check-label" for="Bitcoin/Crypto">
                                                    Bitcoin/Crypto
                                                </label>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <!-- Transmission -->
                                        <div id="transmission" class="custom_collapse"
                                             @if (isset($_GET['transmission']) && !empty($_GET['transmission'])) style="height: 152px;" @endif>
                                            <button type="button" onclick="onOpenCollapse('transmission')">
                                                <span> Transmission </span>
                                                <i id="transmission-arrow" class="fa fa-angle-down"></i>
                                            </button>
                                            <div id="transmission-content" class="collapse_content">
                                                @php
                                                    $transmissionCounts = [];

                                                    if (!empty($filters_data)) {
                                                        foreach ($filters_data as $car) {
                                                            $transmission = $car->transmission;
                                                            if (isset($transmissionCounts[$transmission])) {
                                                                $transmissionCounts[$transmission]++;
                                                            } else {
                                                                $transmissionCounts[$transmission] = 1;
                                                            }
                                                        }
                                                    }

                                                @endphp

                                                @php
                                                    $checked = '';
                                                    // echo "<pre>";print_r($_GET['car_features']);exit;
                                                @endphp

                                                @if (!empty($transmissionCounts))
                                                    @foreach ($transmissionCounts as $transmission => $count)
                                                        @if (isset($_GET['transmission']) && !empty($_GET['transmission']))
                                                            @php
                                                                $arrayToCheck = $_GET['transmission'];
                                                                $checked = '';
                                                                if (in_array($transmission, $arrayToCheck)) {
                                                                    $checked = 'checked';
                                                                }

                                                            @endphp
                                                        @endif

                                                        <div class="form-check">

                                                            <div class="checkboxInput">
                                                                <input type="checkbox"
                                                                       name="transmission[]"
                                                                       value="{{ $transmission }}"
                                                                       id="{{ $transmission }}"
                                                                    {{ $checked }}>
                                                                <i class="fas fa-check"></i>
                                                            </div>
                                                            <label class="form-check-label" for="{{ $transmission }}">
                                                                {{ $transmission }} ({{ $count }})
                                                            </label>
                                                            <button class="updateBtn">update</button>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Fuel Type -->
                                        <div id="fuelType" class="custom_collapse"
                                             @if (isset($_GET['fuel_type']) && !empty($_GET['fuel_type'])) style="height: 188px;" @endif>
                                            <button type="button" onclick="onOpenCollapse('fuelType')">
                                                <span> Fuel Type </span>
                                                <i id="fuelType-arrow" class="fa fa-angle-down"></i>
                                            </button>
                                            <div id="fuelType-content" class="collapse_content">
                                                @php
                                                    $fuelTypeCounts = [];

                                                    if (!empty($filters_data)) {
                                                        foreach ($filters_data as $car) {
                                                            $fuelType = $car->fuel_type;
                                                            if (isset($fuelTypeCounts[$fuelType])) {
                                                                $fuelTypeCounts[$fuelType]++;
                                                            } else {
                                                                $fuelTypeCounts[$fuelType] = 1;
                                                            }
                                                        }
                                                    }

                                                @endphp

                                                @php
                                                    $checked = '';
                                                    // echo "<pre>";print_r($_GET['fuel_type']);exit;
                                                @endphp

                                                @if (!empty($fuelTypeCounts))
                                                    @foreach ($fuelTypeCounts as $fuelType => $count)
                                                        @php
                                                            if (isset($_GET['fuel_type']) && !empty($_GET['fuel_type'])) {
                                                                $arrayToCheck = $_GET['fuel_type'];
                                                                $checked = '';
                                                                if (in_array($fuelType, $arrayToCheck)) {
                                                                    $checked = 'checked';
                                                                }
                                                            }

                                                        @endphp
                                                        <div class="form-check">
                                                            <div class="checkboxInput">
                                                                <input type="checkbox"
                                                                       name="fuel_type[]"
                                                                       value="{{ $fuelType }}" id="{{ $fuelType }}"
                                                                    {{ $checked }}>
                                                                <i class="fas fa-check"></i>
                                                            </div>
                                                            <label class="form-check-label" for="{{ $fuelType }}">
                                                                {{ $feature }}
                                                            </label>
                                                            <button class="updateBtn">update</button>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Car Colors -->
                                        <div id="carColors" class="custom_collapse"
                                             @if (isset($_GET['car_colors']) && !empty($_GET['car_colors']))  style="height: 548px;" @endif>
                                            <button type="button" onclick="onOpenCollapse('carColors')">
                                                <span> Car Colors </span>
                                                <i id="carColors-arrow" class="fa fa-angle-down"></i>
                                            </button>
                                            <div id="carColors-content" class="collapse_content">
                                                @php
                                                    $colorCounts = [];

                                                    if (!empty($filters_data)) {
                                                        foreach ($filters_data as $car) {
                                                            $colors = explode(',', $car->car_colors);

                                                            foreach ($colors as $color) {
                                                                $color = trim($color); // Trim any leading/trailing spaces
                                                                if (isset($colorCounts[$color])) {
                                                                    $colorCounts[$color]++;
                                                                } else {
                                                                    $colorCounts[$color] = 1;
                                                                }
                                                            }
                                                        }
                                                    }

                                                @endphp

                                                @if (!empty($colorCounts))
                                                    @foreach ($colorCounts as $color => $count)
                                                        @php
                                                            if (isset($_GET['car_colors']) && !empty($_GET['car_colors'])) {
                                                                $arrayToCheck = $_GET['car_colors'];
                                                                $checked = '';
                                                                if (in_array($color, $arrayToCheck)) {
                                                                    $checked = 'checked';
                                                                }
                                                            }

                                                        @endphp

                                                        <div class="form-check">
                                                            <div class="checkboxInput">
                                                                <input name="car_colors[]"
                                                                       type="checkbox"
                                                                       value="{{ $color }}" id="{{ $color }}"
                                                                    {{ $checked }}>
                                                                <i class="fas fa-check"></i>
                                                            </div>
                                                            <label class="form-check-label" for="{{ $color }}">
                                                                {{ $color }}
                                                            </label>
                                                            <button class="updateBtn">update</button>
                                                        </div>
                                                    @endforeach
                                                @endif

                                            </div>
                                        </div>

                                        <!-- Minimum Required Age -->
                                        {{-- <div id="minRequiredAge" class="custom_collapse">
                                        <button type="button" onclick="onOpenCollapse('minRequiredAge')">
                                            <span> Minimum Required Age </span>
                                            <i id="minRequiredAge-arrow" class="fa fa-angle-down"></i>
                                        </button>
                                        <div id="minRequiredAge-content" class="collapse_content">
                                            <select class="form-control" id="min_required_age2" name="min_required_age">
                                                <option value="0">Select Minimum Age</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25+</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between w-100 btnCont">
                                    @php
                                        $currenturl = url()->full();
                                    @endphp
                                    @if ($currenturl != 'https://onetapdrive.com/services')
                                        <a href="{{ route('clear-filters') }}" class="themeBtn">
                                            Clear Filters
                                        </a>
                                    @endif
                                    <button class="themeBtn">Show Result</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="container-fluid">
                        <div class="contentArea">
                            <div class="row carRow">
                                <div class="col-12">

                                    @if (!empty($get_brand))
                                        <h2 class="secHeading">RENT A {{ strtoupper($get_brand->brand_name) }} IN DUBAI,
                                            UAE</h2>
                                    @else
                                        <h2 class="secHeading">RENT A CAR IN DUBAI ON DAY, WEEK, MONTH-BASIS</h2>
                                    @endif
                                    <p>
                                        Hire cars directly from local car rental companies at the best rate
                                    </p>
                                </div>
                                <div class="col-9">
                                    <div class="filterTags">
                                        @if(!empty($appliedFilters))
                                        <a href="{{route('rent-a-car-dubai')}}">
                                        <button class="filterTag all">
                                            Clear all filters
                                            <i class="fas fa-times"></i>
                                        </button>
                                        </a>
                                        @endif
                                        @foreach($appliedFilters as $filterName => $filterValue)
                                            @php
                                                // Generate a URL that removes the current filter from the query
                                                $urlWithoutFilter = route(request()->route()->getName(), array_merge(request()->except($filterName)));
                                            @endphp
                                             <a href="{{ $urlWithoutFilter }}" ><button class="filterTag">
                                           
                                                {{ is_array($filterValue) ? implode(', ', $filterValue) : $filterValue }}
                                                <i class="fas fa-times"></i>
                                            </button></a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-3">
                                    <form id="filterForm" method="GET" action="{{route('luxury-car-rental-dubai')}}">
                                    <div class="inputCont sort">
                                        <select autocomplete="off" name="sort" id="sortSelect">
                                            <option selected="selected" value="featured">
                                                Sort: Featured
                                            </option>
                                            <option value="daily_high_to_low">
                                                Daily (low to high)
                                            </option>
                                            <option value="daily_low_to_high">
                                                Daily (high to low)
                                            </option>
                                            <option value="weekly_low_to_high">
                                                Weekly (low to high)
                                            </option>
                                            <option value="monthly_low_to_high">
                                                Monthly (low to high)
                                            </option>
                                            <option value="passengers_low_to_high">
                                                Passengers (low to high)
                                            </option>
                                            <option value="passengers_high_to_low">
                                                Passengers (high to low)
                                            </option>
                                        </select>
                                    </div>
                                    </form>
                                </div>
                                @if (count($cars) > 0)
                                    @foreach ($cars as $key => $value)
                                        <div class="col-lg-12 col-sm-6">
                                            {{-- dd{{$value}} --}}
                                            <div class="carCard fullCard serviceCard">
                                                <a class="imgCont"
                                                   href="{{ route('car-details', ['slug' => $value->slug]) }}">
                                                    <img
                                                        src="{{ asset('images/') }}/{{ $value->get_images[0]->images }}"
                                                        alt=""/>
                                                </a>
                                                <div class="favCont">
                                                    @if (!empty($value->is_admin_approve == 1))
                                                        <button>
                                                            <i class="fa fa-check fs_13"></i> Verified
                                                        </button>
                                                    @endif
                                                    @if ($value->is_featured == 1)
                                                        <button class="featured">
                                                            <i class="fa fa-star fs_13 mb-1 text-light"></i> Featured
                                                        </button>
                                                    @endif
                                                    @if ($value->is_featured == 2)
                                                        <button class="premium">
                                                            <i class="fa fa-star fs_13 mb-1 text-light"></i> Premium
                                                        </button>
                                                    @endif
                                                </div>
                                                <div class="wishlistCont">
                                                    @if (Auth::check())
                                                        @php
                                                            $wishlistProduct = Auth::user()
                                                                ->wishlist()
                                                                ->where('product_id', $value->id)
                                                                ->first();
                                                        @endphp
                                                        @if ($wishlistProduct)
                                                            <button class="themeBtn wishlist-button"
                                                                    data-product-id="{{ $value->id }}">
                                                                <i class="fa fa-heart red_heart"></i>
                                                            </button>
                                                        @else
                                                            <button class="themeBtn wishlist-button"
                                                                    data-product-id="{{ $value->id }}">
                                                                <i class="fa fa-heart"></i>
                                                            </button>
                                                        @endif
                                                    @else
                                                        <button class="themeBtn wishlist-button"
                                                                data-product-id="{{ $value->id }}">
                                                            <i class="fa fa-heart"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                                <a href="{{ route('car-details', ['slug' => $value->slug]) }}"
                                                   class="contentWrap">
                                                    <div class="content">
                                                        <h2 class="title">{{ $value->get_brand_name->brand_name ?? '' }}
                                                            {{ $value->model_name ?? '' }} {{ $value->make_year ?? '' }}</h2>
                                                        <div class="tags">
                                                        <span
                                                            class="properties_border">{{ $value->category ?? '' }}</span>
                                                            <span class="properties_border">{{ $value->car_doors ?? '' }}
                                                                            <svg stroke="currentColor"
                                                                                 fill="currentColor" stroke-width="0"
                                                                                 viewBox="0 0 512 512" height="1em"
                                                                                 width="1em"
                                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                                <path
                                                                                    d="M149.6 41L42.88 254.4c23.8 24.3 53.54 58.8 78.42 97.4 24.5 38.1 44.1 79.7 47.1 119.2h270.3L423.3 41H149.6zM164 64h230l8 192H74l90-192zm86.8 17.99l-141 154.81L339.3 81.99h-88.5zM336 279h64v18h-64v-18z">
                                                                                </path>
                                                                            </svg>
                                                                        </span>
                                                            <span class="properties_border">{{ $value->passengers ?? '' }}
                                                                            <svg stroke="currentColor"
                                                                                 fill="currentColor" stroke-width="0"
                                                                                 viewBox="0 0 24 24" height="1em"
                                                                                 width="1em"
                                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                                <path fill="none"
                                                                                      d="M0 0h24v24H0V0z"></path>
                                                                                <path
                                                                                    d="M15 5v7H9V5h6m0-2H9c-1.1 0-2 .9-2 2v9h10V5c0-1.1-.9-2-2-2zm7 7h-3v3h3v-3zM5 10H2v3h3v-3zm15 5H4v6h2v-4h12v4h2v-6z">
                                                                                </path>
                                                                            </svg>
                                                                        </span>
                                                            <span class="properties_border">{{ $value->bags ?? '' }}
                                                                            <svg stroke="currentColor"
                                                                                 fill="currentColor" stroke-width="0"
                                                                                 viewBox="0 0 24 24" height="1em"
                                                                                 width="1em"
                                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                                <path fill="none"
                                                                                      d="M0 0h24v24H0z"></path>
                                                                                <path
                                                                                    d="M17 6h-2V3c0-.55-.45-1-1-1h-4c-.55 0-1 .45-1 1v3H7c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2 0 .55.45 1 1 1s1-.45 1-1h6c0 .55.45 1 1 1s1-.45 1-1c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zM9.5 18H8V9h1.5v9zm3.25 0h-1.5V9h1.5v9zm.75-12h-3V3.5h3V6zM16 18h-1.5V9H16v9z">
                                                                                </path>
                                                                            </svg>
                                                                        </span>
                                                        </div>
                                                        <div class="rent_details">

                                                            @php
                                                                $minMileage = null;
                                                            @endphp
                                                            @foreach ($value->get_mileage as $mileage)
                                                                @php
                                                                    $mileageValues = [
                                                                        $mileage->one_month,
                                                                        $mileage->three_months,
                                                                        $mileage->six_months,
                                                                        $mileage->nine_months,
                                                                        $mileage->twelve_months,
                                                                    ];
                                                                    $nonNullMileageValues = array_filter(
                                                                        $mileageValues,
                                                                        fn($v) => !is_null($v),
                                                                    );

                                                                    if (!empty($nonNullMileageValues)) {
                                                                        $currentMinMileage = min($nonNullMileageValues);
                                                                        if ($minMileage === null || $currentMinMileage < $minMileage) {
                                                                            $minMileage = $currentMinMileage;
                                                                        }
                                                                    }
                                                                @endphp
                                                            @endforeach

                                                            @if ($minMileage !== null)
                                                                <p class="price">
                                                                    <span class="colored">
                                                                        AED {{ $minMileage }} / Month
                                                                    </span>
                                                                </p>
                                                            @else
                                                                <p class="price">
                                                                    <span class="colored">
                                                                        AED {{ $value->weekly_rent }} / Week
                                                                    </span>
                                                                </p>
                                                                <p class="price duration">
                                                                    <i class="fa fa-road"></i>
                                                                    <span>{{ $value->weekly_mileage }} km</span>
                                                                </p>
                                                            @endif

                                                        </div>
                                                        <div class="other_details">
                                                            <div class="right_details_area">
                                                                @if (!empty($value->delivery_days))
                                                                    <p>
                                                                        <span><i class="fa fa-check"></i></span>
                                                                        Delivery :
                                                                        {{ $value->delivery_days }}
                                                                    </p>
                                                                @endif
                                                                @if ($value->daily_availablity == 'Yes')
                                                                    <p>
                                                                        <span><i class="fa fa-check"></i></span> 1 day
                                                                        rental
                                                                        available
                                                                    </p>
                                                                @endif

                                                                @if ($value->insurance_per_day)
                                                                    <p>
                                                                        <span><i class="fa fa-check"></i></span>
                                                                        Insurance
                                                                        included
                                                                    </p>
                                                                @endif


                                                                {{-- <p>
                                                                        <span><i class="fa fa-bitcoin"></i></span>Crypto payment accepted
                                                                    </p> --}}
                                                                @if (!empty($value->security_deposit))
                                                                    <p>
                                                                        <span><i class="fa fa-info"></i></span>Security
                                                                        Deposit : AED
                                                                        {{ $value->security_deposit }}
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="left_details_area">
                                                            <div class="customBadge"></div>
                                                            <img
                                                                src="{{ asset('company_logo/') }}/{{ $value->get_user->company_logo ?? '' }}"
                                                                alt=""/>
                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="btnCont">
                                                    <button class="themeBtn">
                                                        <i class="fas fa-phone"></i>
                                                    </button>
                                                    <button class="themeBtn whatsapp">
                                                        <i class="fab fa-whatsapp"></i>
                                                    </button>
                                                    <button class="themeBtn enquiry carEnquiry">
                                                        <i class="fas fa-paper-plane"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12">
                                        <h1 class="text-center mt-5">No data Found</h1>
                                    </div>
                                @endif

                                <div class="col-12">
                                    <div class="text-center  mb-3">
                                        Showing {{ $cars->firstItem() }} to {{ $cars->lastItem() }}
                                        of total {{ $cars->total() }} Cars
                                    </div>
                                    <div class="paginationCont">
                                        {{ $cars->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-3 aboutSec">
        <div class="container-md">
            <div class="row">
                <div class="col-12">
                    <div class="aboutContent contentWrap">
                        <p>
                            The demand for comfort on trips is more of a compulsion. The integrity
                            and exclusiveness of BMW does not require any mention and certainly
                            fits you for any trip. Get easy BMW car rental in Dubai with
                            OneClickDrive, the hub for luxury car rentals. We have a wide range of
                            BMW models to choose from in accordance with your needs.
                        </p>
                        <h2 class="secHeading">BMW Car Advantages:</h2>
                        <p>
                            Symbol of Luxury: Needless to say, BMW is all about luxury. It is one
                            of the most common and widely preferred luxury cars. BMW is used by
                            both middle class and upper class people. The style it abbreviates is
                            on another level. The materials they are manufactured with are top
                            notch even if you judge the lowest models. BMW is a premium car with
                            all luxury and comfort that easily surpasses other car brands in
                            popularity.
                        </p>
                        <p>
                            Sign of Versatility: BMW hits a level where it can not be compared to
                            any other car brands. This is no doubt the best vehicle with the best
                            technology in every segment. There are full electric BMW cars that are
                            sure to tempt you like no other.
                        </p>
                        <p>
                            Dynamic Capabilities: BMW is known to be the greatest road car brand
                            in the world, today. You cannot think of anything beyond BMW on the
                            road. The unique front engine car wheel drive platform in BMW models,
                            helps the vehicles in maintaining 50/50 distribution of weight that
                            adds to neutral handling and predictable sterling.
                        </p>
                        <p>
                            Reliability: If reliability is concerned, BMW is the first name. The
                            car brand is known for its warranty and amazing customer support
                            system. BMW is more of a treasure that will keep going forever with
                            proper maintenance.
                        </p>
                        <p>
                            Equipment: You might think that BMW is more expensive than many other
                            ordinary car brands that provide you with many fascinating deals. But
                            when compared with the specifications of BMW, it is so much equipped,
                            having numerous specs that lacks in any other manufacturer model. The
                            specification BMW offers blows competition out of the water. It is a
                            sign of perfection.
                        </p>
                        <h2 class="secHeading">Best BMW Car Models to Rent In Dubai:</h2>
                        <p>
                            Rent a BMW in Dubai with the help of OneClickDrive very easily by
                            choosing from your favorite model. Amongst numerous models that we
                            provide for hire, BMW 4 Series Convertible, BMW X6 SUV and BMW 730-li
                            are no doubt the best and are widely popular. There are various other
                            model options available directly on the website and mobile app.
                        </p>
                        <h2 class="secHeading">Best BMW Car Rental Deals and Offers:</h2>
                        <p>
                            OneClickDrive gives you the convenience to choose from various rent
                            options. We have amazing offers for daily, weekly and monthly basis.
                            Book BMW cars for rent starting from AED 299/day.
                        </p>
                        <h2 class="secHeading">Why OneClickDrive?</h2>
                        <p>
                            Booking a car for a trip to some unknown country is always a risky
                            task. It is more challenging to find an authentic car rental company
                            that would provide you with trustworthy and dedicated service. Well,
                            your hassle of searching for a loyal car rental service for your next
                            trip to Dubai comes to an end. Besides travelers, residents of UAE can
                            directly book by comparing the rates from over 100+ car rental
                            suppliers and finalize the best deal. OneClickDrive ensures quality
                            car rental service all over Dubai and you can rent your favorite car
                            model at the most competitive rates. BMW car hire in Dubai is now
                            easier and hassle free as you can rent your car in just one click.
                            Nearly all models are available and you get them at unbelievable
                            rental rates.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-3 faqSec">
        <div class="container-md">
            <div class="row">
                <div class="col-12">
                    <div class="aboutContent">
                        <h2 class="secHeading">Frequently Asked Questions</h2>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                        Why is driving a BMW recommended in Dubai?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                     data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>
                                            Among the popular car choices, BMW is definitely a favorite. In Dubai, more
                                            so,
                                            as itâ€™s perfect for Sheikh Zayed Road as well as on the highways
                                            stretching
                                            across the Emirates. Being one of the most scenic places for those seeking a
                                            luxurious adventure on wheels, BMWs are the most-in-demand cars in Dubai.
                                            Youâ€™ll be driving alongside exotic cars such as Porsche, Mercedes Benz,
                                            Audi,
                                            not to mention a range of sports cars.Many tourists and residents in Dubai
                                            rent
                                            a BMW to soak the pleasure of driving a luxurious sedan. The spacious cabin,
                                            extra legroom, advanced driving and safety features are what BMW vehicles
                                            are
                                            most known for.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                        Can I take the BMW rental car to Abu Dhabi from Dubai?
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                     data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>
                                            Yes, you can! Most customers rent a luxury sedan in Dubai to visit Abu Dhabi
                                            and
                                            other emirates. Itâ€™s definitely the best way to explore the UAE. Car
                                            rental
                                            companies allow their vehicles to be driven anywhere in the UAE, barring a
                                            few
                                            locations such as Jebel Hafeet, Jebel Jais and desert areas. Be sure to plan
                                            your drives in advance to make the most of it. Google Maps is your best
                                            friend!If youâ€™re planning a trip to the Grand Mosque, Louvre or Yas
                                            Marina,
                                            consider renting for 2 or more days to offset the additional mileage charge
                                            you
                                            will incur. As most car rentals, including luxury and sports cars, come with
                                            a
                                            standard mileage limit of 250-km per day. Dubai to Abu Dhabi is a good
                                            150-km
                                            away so youâ€™ll probably be clocking over 300 km on the journey back.Best
                                            practice: Consult with the car rental agency regarding your trip plan for
                                            suggestions. Additional mileage packages may be available.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">
                                        Which type of BMW cars are available for rent in Dubai?
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                     data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>
                                            OneClickDrive.com works with several car rental companies across the world.
                                            In
                                            Dubai, we work with quite a few BMW car rental providers. You can choose
                                            among
                                            cars with a range of engine sizes and additional features, including GPS
                                            navigation, safety and performance enhancements. The BMW sedan comes in
                                            various
                                            4-door sedan, convertible models with advanced features. Different models
                                            including: BMW 2-series, 3-series, 550i, 550 mpower, 730li, 750li, X5, X6
                                            and
                                            more. If youâ€™re looking for a rare BMW car model, contact our suppliers
                                            who
                                            have listed a BMW. They might be able to cater to your distinguished needs.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="aboutContent">
                        <p>
                            <span>note:</span> The above listings including the
                            prices are updated by the respective car rental company. Incase the
                            car is not available at the price mentioned (exclusive of VAT), please
                            inform us and weâ€™ll get back to you with the best alternative. Happy
                            renting!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title text_yellow" id="offcanvasExampleLabel">Send an Instant Inquiry</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                <p>The supplier will directly connect with you</p>
            </div>
            <form id="carEnquiry" method="POST">
                @csrf
                <input type="hidden" name="car_id" id="car_id">
                <input type="hidden" name="vendor_id" id="vendor_id">
                <div>
                    <div class="img-cont-drv">
                        <div class="row justcent m-0 m-b-10">
                            <div class="col-md-4 ps-0">
                                <img id="car_image" loading="lazy" class="w-100 rounded"
                                     src="{{asset('images')}}"
                                     alt="Supplier logo" title="Supplier Logo">
                            </div>
                            <div class="col-md-8">
                                <div>
                                    <p class="title_car fw-bold mb-1" id="car_title">MG 5 2024</p>
                                    <p class="mb-1 title_para" id="min_booking">Minimum 2 day booking</p>
                                    <p class="mb-1 pb-1 title_para" id="car_company">Al Maseer Rent A Car</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <div>
                                <label for="name">Name</label><br>
                                <input class="form-control" name="name" type="text" value="{{Auth::user()->name ?? ''}}"
                                       placeholder="{{Auth::user()->name ?? ''}}" id="name" required>
                            </div>
                            <div class="mt-3">
                                <label for="number">Contact Number</label><br>
                                <input class="form-control" type="number" value="{{Auth::user()->contact ?? ''}}"
                                       name="contact" placeholder="{{Auth::user()->contact ?? ''}}" id="number"
                                       required>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="form-check">
                                <input class="form-check-input" name="whatsapp_enabled" type="checkbox" value="1"
                                       id="whats_enable">
                                <label class="form-check-label" for="whats_enable">
                                    WhatsApp Enabled
                                </label>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div>
                                <label for="email_enq">Email</label><br>
                                <input class="form-control" name="email" value="{{Auth::user()->email ?? '' }}"
                                       type="email" placeholder="{{Auth::user()->email ?? ''}}" id="email_enq" required>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="send_suppliers">
                                <label class="form-check-label" for="send_suppliers">
                                    Send request to multiple suppliers
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn_warning px-3">Send Enquiry</button>
                        <p class="mt-3 enq_para" id="text_para">
                            Your inquiry will be sent to Al Maseer Rent A Car without any obligation or cost to you. You
                            agree to be contacted by OneTapDrive and its partners.
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>

@section('script')

    <script>

        $('.carEnquiry').on('click', function () {
            var id = $(this).attr("data-id");
            var car_id = $("#car_id").val(id);
            $.ajax({
                url: '{{ route('get-car-details') }}',
                type: 'GET',
                data: {
                    id: id
                },
                success: function (response) {
                    $("#car_title").html('');
                    $("#min_booking").html('');
                    $("#car_company").html('');
                    $("#text para").html('');
                    console.log(response.details.id);
                    if (response.status == 200) {
                        $("#vendor_id").val(response.details.user_id);
                        $("#car_title").html(response.details.get_brand_name.brand_name + ' ' + response.details.model_name + ' ' + response.details.make_year);
                        $("#min_booking").html('Minimum' + ' ' + response.details.days + ' ' + 'day booking');
                        $("#car_company").html(response.details.get_user.company_name);
                        $("#text_para").html('Your inquiry will be sent to' + ' ' + response.details.get_user.company_name + ' ' + 'without any obligation or cost to you. You agree to be contacted by OneTapDrive and its partners.');
                        console.log(response.details.get_images[0].images);
                        if (response.details.get_images && response.details.get_images.length > 0) {
                            var basePath = 'https://onetapdrive.com/public/images/';
                            var imagePath = basePath + response.details.get_images[0].images;
                            $("#car_image").attr("src", imagePath);
                        }
                    }
                }
            });
        });
    </script>

    <script>
        $("#carEnquiry").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 100

                },
                email: {
                    required: true,
                    maxlength: 100
                },
                contact: {
                    required: true
                },

            },
            messages: {
                name: {
                    required: 'Name field is required'
                },
                email: {
                    required: 'Email field is required'
                },
                contact: {
                    required: 'Contact field is required'
                },
            },

            submitHandler: function (form, e) {

                e.preventDefault();
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var form = $("#carEnquiry");
                // var name = $("#name").val();
                $.ajax({
                    type: 'POST',
                    url: "{{route('send-enquiry')}}",
                    data: form.serialize(),
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (response, data) {
                        if (response.status == 200) {
                            swal({
                                title: "Enquiry!",
                                text: response.message,
                                type: "success",
                                icon: "success",
                            }).then(function () {
                            });
                            $('#carEnquiry')[0].reset();
                        }

                        if (response.status == 400) {
                            $.each(response.errors, function (prefix, val) {
                                toastr.error(val[0]);
                            });
                        }
                    }
                });
            }
        });
    </script>




    <script>
        $(document).ready(function () {
            $('.wishlist-button').on('click', function () {
                var button = $(this);
                var productId = $(this).data('product-id');
                var heartIcon = button.find('.fa-heart');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ route('wishlist.add') }}',
                    type: 'GET',
                    data: {
                        product_id: productId
                    },
                    success: function (response) {
                        if (response.status == 401) {
                            toastr.error(response.message);
                        }
                        if (response.status != 401) {
                            if (heartIcon.hasClass('fa-heart')) {
                                heartIcon.addClass('red_heart');
                                // heartIcon.removeClass('fa-heart');
                            } else {
                                heartIcon.removeClass('red_heart');
                                heartIcon.addClass('fa-heart'); // Add the 'fa-heart' class
                            }
                        }

                        // Update the heart icon after adding to the wishlist
                        if (response.status == 200) {
                            toastr.success('Product added to wishlist');
                        }
                        if (response.status == 202) {
                            heartIcon.removeClass('red_heart');
                            toastr.success('Product removed from wishlist');
                        }
                    }
                });
            });
        });


        document.addEventListener("DOMContentLoaded", function () {
            const myWpElements = document.querySelectorAll(".my_wp");
            const my_wp_nums = document.querySelectorAll(".my_wp_num");

            myWpElements.forEach((myWpElement, index) => {
                myWpElement.addEventListener("focus", function () {
                    my_wp_nums[index].classList.remove("d-none");
                    console.log("focus.");
                    myWpElement.style.width = "170px";
                });

                myWpElement.addEventListener("blur", function () {
                    my_wp_nums[index].classList.add("d-none");
                    console.log("blur");
                    myWpElement.style.width = "47px";
                });
            });

            const myWpElements1 = document.querySelectorAll(".my_wp1");
            const my_wp_nums1 = document.querySelectorAll(".my_wp_num1");

            myWpElements1.forEach((myWpElement1, index) => {
                myWpElement1.addEventListener("focus", function () {
                    my_wp_nums1[index].classList.remove("d-none");
                    console.log("focus.");
                    myWpElement1.style.width = "170px";
                });

                myWpElement1.addEventListener("blur", function () {
                    my_wp_nums1[index].classList.add("d-none");
                    console.log("blur");
                    myWpElement1.style.width = "47px";
                });
            });
        });
    </script>

    <script>
        $("#carmake").on('change', function () {
            var brand = $("#carmake").val();
            $("#showbut").css("display", "");
            $.ajax({
                url: '{{ route('get_car_models') }}',
                type: 'GET',
                data: {
                    brand: brand
                },
                beforeSend: function () {

                    console.log("----------- beforeSend -------------");


                    $('#carmodel2').html(`<option   value ="0">Loading....</option>`);

                },

                success: function (response) {
                    if (response.status == 200) {
                        $('#carmodel2').html('');
                        $('#year2').html();


                        if (response != '') {
                            console.log("response " + response);

                            $('#carmodel2').append(
                                `<option   value ="0">Select Car Model</option>`
                            );
                            $.each(response.get_models, function (value, i) {


                                $('#carmodel2').append(
                                    `<option   value ="${i.model_name}">${i.model_name}</option>`
                                );
                                $('#year2').append(
                                    `<option   value ="${i.make_year}">${i.make_year}</option>
                                            `
                                )
                            });


                            @if (isset($_GET['carmodel']) && !empty($_GET['carmodel']))

                            console.log("carmodel " + "<?php echo $_GET['carmodel']; ?>");
                            $('#carmodel2').val("<?php echo $_GET['carmodel']; ?>");
                            $("#carmodel2").change();
                            @endif

                        } else {
                            $('#carmodel2').append(
                                `<option   value ="">Data Not Found</option>`
                            );
                        }
                    }

                }
            });
        })

        @if (isset($_GET['brand']) && !empty($_GET['brand']))

        $("#carmake").change();
        @endif
    </script>
    <script>
        $("#carmodel2").on('change', function () {
            var model_name = $(this).val();

            $.ajax({
                url: '{{ route('get_make_years') }}',
                type: 'GET',
                data: {
                    model_name: model_name
                },
                beforeSend: function () {

                    console.log("----------- beforeSend -------------");


                    $('#year2').html(`<option   value ="0">Loading....</option>`);

                },
                success: function (response) {
                    if (response.status == 200) {
                        $('#year2').html('');
                        if (response != '') {
                            $.each(response.make_year, function (value, i) {
                                console.log(i);
                                $('#year2').append(
                                    `<option   value ="${i.make_year}">${i.make_year}</option>`
                                )
                            });
                        }
                    } else {
                        $('#year2').append(
                            `<option   value ="">Data Not Found</option>`
                        );
                    }
                }
            });
        })
    </script>

<script>
    // Wait for the document to be ready
    document.addEventListener('DOMContentLoaded', function() {
        // Select the form and the filter elements
        const filterForm = document.getElementById('filterForm');

        // Add change event listeners to the filter elements
        filterForm.addEventListener('change', function() {
            filterForm.submit(); // Submit the form when price filter changes
        });

        // priceOrder.addEventListener('change', function() {
        //     filterForm.submit(); // Submit the form when price order changes
        // });
    });
</script>
@endsection

@endsection
