@extends('frontend.layouts.header')
@section('content')
    <div class="content_wrap ">
        <nav>
            <ol class="cd-breadcrumb">
                <li><a href="/" class="fa fa-home"></a></li>
                <li><a href="#0">Dubai</a></li>
                <li><a href="#0">car brand</a></li>
                <li class="current"><span>By brand / by Vehicle type</span></li>
            </ol>
        </nav>
    </div>

    <section>
        <div class="details_wrapper content_wrap ">
            <div class="filter_action">
                <button onclick="onOpenDetailsFilter('filters',this)" class="styled_button rounded_sm filter_action">
                    {{-- <div></div>
                    <div></div>
                    <div></div> --}}
                    <i class="fa-solid fa-filter"></i>
                </button>
            </div>
            <form method="GET">
            <div id="filters" class="filters">
                <h2 class="flex_between font_semi_bold">
                    Filters
                    <button class="styled_button rounded_sm filter_action">
                        <i class="fa fa-times"></i>
                    </button>
                </h2>

                <div class="collapse_wrap ">
                    <div class="collapse_items bukitmditel">

                        <h5>Delivery & Pick-Up Services</h5>
                        <div class="border-bottom mb-2 mt-1"></div>
                        <!-- Location -->
                        <div class="row delive-box">
                            <div class="col-md-4 text-center p-0 d-b1 py-4 border-end"
                                title="Feel free to pick-up this car from the branch location during working hours.">
                                <div class="col-md-12 p-0 m-b-10"> <img loading="lazy" alt="branch pick up"
                                        src="https://www.oneclickdrive.com/application/views/images/branch-pickup.svg"
                                        width="21" height="24"> </div>

                                <div class="col-md-12 p-0 text-orange fs_13"> Branch <br> Pick-up </div>
                            </div>
                            <div class="col-md-4 text-center p-0 d-b2 py-4 border-end"
                                title="This car can be delivered to you anywhere across the emirate. Extra charges may apply.">
                                <div class="col-md-12 p-0 m-b-10"> <img loading="lazy" alt="Delivery 2 u"
                                        src="https://www.oneclickdrive.com/application/views/images/delivery2u.svg"
                                        width="21" height="24"> </div>
                                <div class="col-md-12 p-0 text-orange fs_13"> Delivery <br> to You </div>
                            </div>
                            <div class="col-md-4 text-center p-0 d-b3 py-4"
                                title="This car can be booked in advance for delivery at the airport. Delivery and airport parking charges may apply.">
                                <div class="col-md-12 p-0 m-b-10"> <img loading="lazy" alt="airport delivery"
                                        src="https://www.oneclickdrive.com/application/views/images/airport-delivery.svg"
                                        width="21" height="24"> </div>
                                <div class="col-md-12 p-0 text-orange fs_13"> Airport <br> Delivery </div>
                            </div>
                        </div>


                        <div class="row mt-3">
                            <div class="col-md-12 m-t-10 opntimbx">
                                <div class="roww align-items-center m-0 opntimbtn" id="open_drop" onclick="openDropdown()">
                                    <div class="d-flex align-items-center justify-content-around">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="#FF581B"
                                            class="bi bi-clock-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="openc m-l-10" title="Friends Car Rental is currently open"></span>
                                    </div>
                                    @php
                                        $currentDay = ucfirst(date('l'));
                                        $currentTime = date('H:i:s');
                                    @endphp
                                    @foreach ($shop_timings as $time)
                                    @if($time->day_of_week == $currentDay)
                                    @if($time->opening_time == $time->closing_time)
                                        Today Open 24hrs
                                    @endif
                                    @else
                                    @if($time['day_of_week'] == $currentDay || $time['closing_time'] ==  $currentTime)
                                    <div>
                                        <span title="See shop timings" class="show_hours"> Today {{date('g:i A', strtotime($time['opening_time']))}}- {{date('g:i A', strtotime($time['closing_time']))}}
                                        </span>
                                    </div>
                                    @endif
                                     @endif
                                    @endforeach
                                    <div>
                                        <i class="opntimaro" id="dwn-aro-web" title="See shop timings">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7.06408 15.872L12.9359 10.0002L7.06408 4.12842" stroke="#FF581B"
                                                    stroke-width="1.5"></path>
                                            </svg>
                                        </i>
                                    </div>
                                </div>
                            </div>
                            <div class="open-time" style="display:none;">
                                <table class="time_details">
                                    @php
                                         $currentDay = ucfirst(date('l')); // Get the current day in lowercase
                                    @endphp
                                    <tbody>
                                        @foreach ($shop_timings as $time)
                                        @if($time->day_of_week == $currentDay)

                                        <tr style="font-weight:bold;">
                                            <td>{{$time->day_of_week}}</td>
                                            <td>@if ($time->opening_time == $time->closing_time)
                                                Open 24 Hours
                                            @else
                                                {{ date('g:i A', strtotime($time->opening_time)) }}
                                                &mdash;
                                                {{ date('g:i A', strtotime($time->closing_time)) }}
                                            @endif</td>
                                        </tr>
                                        @else
                                            <tr>
                                                <td>{{ $time->day_of_week }}</td>
                                                <td>
                                                    @if ($time->opening_time == $time->closing_time)
                                                        Open 24 Hours
                                                    @else
                                                        {{ date('g:i A', strtotime($time->opening_time)) }}
                                                        &mdash;
                                                        {{ date('g:i A', strtotime($time->closing_time)) }}
                                                    @endif
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach



                                        {{-- <tr>
                                            <td>Monday</td>
                                            <td>Open 24 hours</td>
                                        </tr>
                                        <tr>
                                            <td>Tuesday</td>
                                            <td>Open 24 hours</td>
                                        </tr>
                                        <tr style="font-weight:bold;">
                                            <td>Wednesday</td>
                                            <td>Open 24 hours</td>
                                        </tr>
                                        <tr>
                                            <td>Thursday</td>
                                            <td>Open 24 hours</td>
                                        </tr>
                                        <tr>
                                            <td>Friday</td>
                                            <td>Open 24 hours</td>
                                        </tr>
                                        <tr>
                                            <td>Saturday</td>
                                            <td>Open 24 hours</td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <h5 class="mt-4">Address</h5>
                    <div class="border-bottom mb-2 mt-1"></div>

                    <div class="row">
                        <div class="col">
                            <div class="map-img" style="overflow:hidden;"> <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14439.945497394929!2d55.2779529!3d25.203682!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x41b07a7fb0de7cab!2sFriends%20Car%20Rental!5e0!3m2!1sen!2sae!4v1627554934596!5m2!1sen!2sae" width="320" height="240" style="border:0;" allowfullscreen="" loading="lazy"></iframe>                                   </div>
                        </div>
                        <div class="mt-4">
                            <div class="addressbox d-flex justify-content-between">
                                <div class="me-2 mt-1">
                                    <i class="fa fa-map-marker text-orange fs-4" aria-hidden="true"></i>
                                </div>
                                    <p>
                                    Rose, Al Murooj Complex, Al Mustaqbal St, DIFC, Dubai - UAE
                                    </p>
                                 </div>
                        </div>
                    </div>



                </div>


                <div class="bukitmditel mt-3">

                    <h5 class="mt-2">Branch Location(s)</h5>
                    <div class="border-bottom mb-2 mt-1"></div>

                    <div class="cotnt">
                        <a class="bttn bttn-default bttn-normal text-dark" href="javascript:void(0);" title="Find cars to rent in Downtown Dubai">
                           {{$get_company->city}}</a>
                    </div>

                    <h5 class="mt-2">Fast Delivery Locations</h5>
                    <div class="border-bottom mb-2 mt-1"></div>


                    <div class="cotnt">

                        @php
                            $locations = explode(',', $get_company->fast_delivery_locations); // Split locations by commas into an array
                         @endphp
                        @foreach($locations as $location)
                        <a class="bttn bttn-default bttn-normal text-dark" href="javascript:void(0);" title="Find cars to rent in Downtown Dubai">
                            {{$location}}</a>
                            @endforeach
                    </div>

                    <h5 class="mt-4">Payment Mode</h5>
                    <div class="border-bottom mb-2 mt-1"></div>

                    <div class="cotnt">
                        @php
                        $payments = explode(',', $get_company->payment_modes); // Split locations by commas into an array
                        @endphp
                        @foreach ( $payments as $payment )
                        <a class="bttn bttn-default bttn-normal text-dark" href="javascript:void(0);" title="Find cars to rent in Downtown Dubai">
                            {{ $payment}}</a>
                        @endforeach
                    </div>


                </div>

                <div class="bukitmditel mt-3">


                    <h5 class="mt-2">Car Fleet</h5>
                    <div class="border-bottom mb-2 mt-1"></div>


                    <div class="cotnt">
                        @php
                        $uniqueCategories = [];
                    @endphp

                    @foreach ($company_profile as $categories)
                        @if (!in_array($categories->category, $uniqueCategories))
                            <a class="bttn bttn-default bttn-normal text-dark" href="javascript:void(0);" title="Find cars to rent in Downtown Dubai">
                                {{ $categories->category }}
                            </a>
                            @php
                                $uniqueCategories[] = $categories->category;
                            @endphp
                        @endif
                    @endforeach

                    </div>

                    <h5 class="mt-2">Languages Spoken</h5>
                    <div class="border-bottom mb-2 mt-1"></div>

                    <div class="cotnt">
                        @php
                         $languages = explode(',', $get_company->languages); // Split locations by commas into an array
                        @endphp
                        @foreach ( $languages as $language )
                        <a class="bttn bttn-default bttn-normal text-dark" href="javascript:void(0);" title="Find cars to rent in Downtown Dubai">
                            {{$language}}</a>
                            @endforeach
                    </div>


                </div>


                <hr>

                <div>
                    <!-- Location -->
                    {{-- <div id="location" class="custom_collapse">
                        <button onclick="onOpenCollapse('location')">
                            <span class="fw-bold"> Location </span>
                            <i id="location-arrow" class="fa fa-angle-down"></i>
                        </button>
                        <div id="location-content" class="collapse_content">
                            <select class="form-control" name="branches">
                                <option value="" disabled selected="selected">Select Location</option>
                                <option value="Al Awir">Al Awir </option>
                                <option value="Al Awir">Al Awir </option>
                                <option value="Al Awir">Al Awir </option>
                                <option value="Al Awir">Al Awir </option>

                            </select>
                        </div>
                    </div> --}}

                    <!-- Car Brand / Model -->
                    <div id="carBrand" class="custom_collapse">
                        <button type="button" onclick="onOpenCollapse('carBrand')">
                            <span class="fw-bold"> Car Brand / Model </span>
                            <i id="carBrand-arrow" class="fa fa-angle-down"></i>
                        </button>
                        <div id="carBrand-content" class="collapse_content">
                            <div> <input type="hidden" id="language" value="english">
                                <input type="hidden" id="css" value=""> <label title="">Car
                                    Brand</label> <span id="show_before4"> <select class="fomcntrl" name="carmake"
                                        id="carmake">
                                        <option value="0">Select Car Make</option>
                                        @foreach ($filters_data->unique('brand_id')  as $cars)
                                            <option value="{{ $cars->brand_id}}">{{$cars->get_brand_name->brand_name ?? ''}} </option>
                                        @endforeach
                                        </select>
                                        <input type="hidden"  id="company_id" name="company_id" value="{{$get_company->id}}">

                                </span>
                            </div>


                            {{-- car model --}}

                            <span id="show_heading" class="bodrdis" style="display: inline;"> <label class="mt-3"
                                    title="">Car
                                    Model</label>
                                <div id="show_sub_categories" style="color: black; display: block;">
                                    <select class="fomcntrl" name="carmodel" id="carmodel2">
                                        <option value="0" selected="selected">Select Car Model</option>
                                        {{-- <option value="1327">
                                            Chiron Sports</option> --}}
                                    </select>
                                </div>
                                <span id="search_e" class="ocd_searchupt" style="display: none;"><button
                                        class="updatebttn bttn bttn-primary" type="submit">Update</button></span>
                            </span>

                        </div>




                    </div>

                    <!-- Model Year -->
                    <div id="modelYear" class="custom_collapse">
                        <button type="button" onclick="onOpenCollapse('modelYear')">
                            <span class="fw-bold"> Model Year </span>
                            <i id="modelYear-arrow" class="fa fa-angle-down"></i>
                        </button>
                        <div id="modelYear-content" class="collapse_content">
                            <select class="form-control" name="year" id="year2">
                                <option value="" selected="selected">Select</option>
                            </select>
                        </div>
                    </div>

                    <!-- No. of Seats -->
                    <div id="seats" class="custom_collapse">
                        <button type="button" onclick="onOpenCollapse('seats')">
                            <span class="fw-bold"> No. of Seats </span>
                            <i id="seats-arrow" class="fa fa-angle-down"></i>
                        </button>
                        <div id="seats-content" class="collapse_content">
                            <div class="form-check ms-3">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckChecked">&nbsp;
                                <label class="form-check-label" for="flexCheckChecked">
                                    1-2 Seats
                                </label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckChecked2">&nbsp;
                                <label class="form-check-label" for="flexCheckChecked2">
                                    4-5 Seats
                                </label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckChecked3">&nbsp;
                                <label class="form-check-label" for="flexCheckChecked3">
                                    6-7 Seats
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Vehicle Type -->
                    <div id="vehicleType" class="custom_collapse">
                        <button type="button" onclick="onOpenCollapse('vehicleType')">
                            <span class="fw-bold"> Vehicle Type </span>
                            <i id="vehicleType-arrow" class="fa fa-angle-down"></i>
                        </button>
                        <div id="vehicleType-content" class="collapse_content">
                            @foreach ($filters_data->unique('category')  as $cars)
                            <div class="form-check ms-3">
                                <input class="form-check-input" type="checkbox" name="category[]" value="{{$cars->category}}" id="{{$cars->category}}">&nbsp;
                                <label class="form-check-label" for="Sedan">{{$cars->category}}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price Range -->
                    <div id="priceRange" class="custom_collapse">
                        <button type="button" onclick="onOpenCollapse('priceRange')">
                            <span class="fw-bold"> Price Range </span>
                            <i id="priceRange-arrow" class="fa fa-angle-down"></i>
                        </button>
                        <div id="priceRange-content" class="collapse_content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="day" class="form-label f_12">Max Day Budget</label>
                                        <input type="number" class="form-control" id="day">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="month" class="form-label f_12">Max Monthly Budget</label>
                                        <input type="number" class="form-control" id="month">
                                    </div>
                                </div>
                                <div class="row">
                                    <button type="button" class="btn_warning ms-auto">Update</button>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rental Period -->
                    <div id="rentalPeriod" class="custom_collapse">
                        <button type="button" onclick="onOpenCollapse('rentalPeriod')">
                            <span class="fw-bold"> Rental Period </span>
                            <i id="rentalPeriod-arrow" class="fa fa-angle-down"></i>
                        </button>
                        <div id="rentalPeriod-content" class="collapse_content">
                            <select class="form-control" id="min_days_booking2" name="min_days_booking">
                                <option selected disabled value="0">Select rental period</option>
                                <option value="1">1 day</option>
                                <option value="2">2 day</option>
                                <option value="3">3 day</option>
                                <option value="4">4 day</option>
                                <option value="5">5 day</option>
                                <option value="6">6 day</option>
                                <option value="7">7+ days</option>
                                <option value="30">Monthly</option>
                            </select>
                        </div>
                    </div>

                    <!-- Car Features -->
                    <div id="carFeatures" class="custom_collapse">
                        <button type="button" onclick="onOpenCollapse('carFeatures')">
                            <span class="fw-bold"> Car Features </span>
                            <i id="carFeatures-arrow" class="fa fa-angle-down"></i>
                        </button>
                        <div id="carFeatures-content" class="collapse_content">
                            @foreach ($filters_data->unique('car_features')  as $cars)
                            @php
                                $car_features = explode(',',$cars->car_features)
                            @endphp
                            @endforeach
                            @foreach ($car_features as $feature)

                            <div class="form-check ms-3">
                                <input class="form-check-input" name="features[]" type="checkbox" value="{{$feature}}" id="{{$feature}}">&nbsp;
                                <label class="form-check-label" for="{{$feature}}">
                                   {{$feature}}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Payment Mode -->
                    <div id="paymentMode" class="custom_collapse">
                        <button type="button" onclick="onOpenCollapse('paymentMode')">
                            <span class="fw-bold"> Payment Mode </span>
                            <i id="paymentMode-arrow" class="fa fa-angle-down"></i>
                        </button>
                        <div id="paymentMode-content" class="collapse_content">
                            @php
                                $payment_methods  = explode(',',$get_company->payment_modes)
                            @endphp
                            @foreach ( $payment_methods  as $pay)
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="payment_method[]" type="checkbox" value="{{$pay}}"
                                    id="Credit_Card">&nbsp;
                                <label class="form-check-label" for="{{$pay}}">
                                   {{$pay}}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Transmission -->
                    <div id="transmission" class="custom_collapse">
                        <button type="button" onclick="onOpenCollapse('transmission')">
                            <span class="fw-bold"> Transmission </span>
                            <i id="transmission-arrow" class="fa fa-angle-down"></i>
                        </button>
                        <div id="transmission-content" class="collapse_content">
                            @foreach ($filters_data->unique('transmission')  as $cars)
                                <div class="form-check ms-3">
                                    <input class="form-check-input" name="transmission[]" type="checkbox" value="{{$cars->transmission}}" id="">&nbsp;
                                    <label class="form-check-label" for="Auto">{{$cars->transmission}}</label>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <!-- Fuel Type -->
                    <div id="fuelType" class="custom_collapse">
                        <button type="button" onclick="onOpenCollapse('fuelType')">
                            <span class="fw-bold"> Fuel Type </span>
                            <i id="fuelType-arrow" class="fa fa-angle-down"></i>
                        </button>
                        <div id="fuelType-content" class="collapse_content">
                            @foreach ($filters_data->unique('fuel_type')  as $cars)
                                <div class="form-check ms-3">
                                    <input class="form-check-input" name="fuel_type[]" type="checkbox" value="{{$cars->fuel_type}}" id="Petrol">&nbsp;
                                    <label class="form-check-label" for="Petrol">{{$cars->fuel_type}}</label>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <!-- Car Colors -->
                    <div id="carColors" class="custom_collapse">
                        <button type="button" onclick="onOpenCollapse('carColors')">
                            <span class="fw-bold"> Car Colors </span>
                            <i id="carColors-arrow" class="fa fa-angle-down"></i>
                        </button>
                        <div id="carColors-content" class="collapse_content">
                            @foreach ($filters_data->unique('car_colors')  as $cars)
                            @php
                                $colors = explode(',',$cars->car_colors)
                            @endphp
                            @endforeach
                            @foreach ($colors as  $all_colors)

                            <div class="form-check ms-3">
                                <input class="form-check-input" name="car_colors[]" type="checkbox" value="{{$all_colors}}" id="{{$all_colors}}">&nbsp;
                                <label class="form-check-label" for="{{$all_colors}}">
                                   {{$all_colors}}
                                </label>
                            </div>
                            @endforeach

                        </div>
                    </div>

                    <!-- Minimum Required Age -->
                    <div id="minRequiredAge" class="custom_collapse">
                        <button onclick="onOpenCollapse('minRequiredAge')">
                            <span class="fw-bold"> Minimum Required Age </span>
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
                    </div>
                </div>

                <div class="mt-3">

                    <button type="submit" class="prctrl">APPLY FILTERS</button>

                    <button class="prctrl_border">CLEAR FILTERS</button>
                </div>


            </div>
        </form>
        </div>
        <div class="content_area">
            <h2>{{strtoupper($get_company->company_name)}} RENT A CAR : LIVE OFFERS IN {{strtoupper($get_company->city)}}</h2>
            <p>
                Choose among 20 rental cars and book directly via WheelsOnClick. Zero commission, zero booking fees!
            </p>

            <div class="row">
                <div class="col-lg-12">
                    @foreach ($company_profile as  $key =>  $profile)

                    <div class="styled_vehicle_card_2 px-0">
                        <div class="carousel_wrapper">
                            <div id="demo{{$key}}" class="carousel slide" data-bs-ride="carousel">

                                <div class="favorite flex_center ">

                                @if (Auth::check())
                                    @php
                                        $wishlistProduct = Auth::user()
                                            ->wishlist()
                                            ->where('product_id', $profile->id)
                                            ->first();
                                    @endphp
                                    @if ($wishlistProduct)
                                        <button class="styled_button rounded_sm wishlist-button"
                                            data-product-id="{{ $profile->id }}">
                                            <i class="fa fa-heart red_heart"></i>
                                        </button>
                                    @else
                                        <button class="styled_button rounded_sm wishlist-button"
                                            data-product-id="{{ $profile->id }}">
                                            <i class="fa fa-heart"></i>
                                        </button>
                                    @endif
                                @else
                                    <button class="styled_button rounded_sm wishlist-button"
                                        data-product-id="{{ $profile->id }}">
                                        <i class="fa fa-heart"></i>
                                    </button>
                                @endif
                                </div>


                                <div class="carousel-indicators">
                                    @if ($profile->get_images)
                                        @foreach ($profile->get_images as $image_key => $image_value)
                                            <button type="button" data-bs-target="#demo{{ $key }}"
                                                data-bs-slide-to="{{ $image_key }}"
                                                class="active"></button>
                                        @endforeach
                                    @endif
                                </div>


                                <a
                                href="{{ route('car-details', ['id' => $profile->id, 'slug' => $profile->slug]) }}">

                                <div class="carousel-inner">
                                    @if ($profile->get_images)
                                        @foreach ($profile->get_images as $image_key => $image_value)
                                            @if ($image_key == 0)
                                                <div class="carousel-item active">
                                                    <img src='{{ asset("images/$image_value->images") }}'
                                                        alt="{{ $image_value->images }}" class="d-block"
                                                        style="width: 100%; object-fit: cover;"
                                                        height="280px" />
                                                </div>
                                            @else
                                                <div class="carousel-item">
                                                    <img src='{{ asset("images/$image_value->images") }}'
                                                        alt="{{ $image_value->images }}" class="d-block"
                                                        style="width: 100%; object-fit: cover;"
                                                        height="280px" />
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif

                                </div>
                            </a>

                            <!-- Left and right controls/icons -->
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#demo{{ $key }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#demo{{ $key }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                            </div>
                        </div>



                        <div class="content_wrapper">
                            <a href="{{ route('car-details', ['id' => $profile->id, 'slug' => $profile->slug]) }}">
                                <h2 class="clr_primary mb-2">{{ $profile->get_brand_name->brand_name ?? '' }}
                                    {{ $profile->model_name }}
                                    {{ $profile->make_year }}</h2>
                            </a>
                            <div>
                                <ul class="kylist col-xs-12 sddetail">
                                    <li class="f-12 cartip">{{$profile->category}}</li>
                                    <li class="f-13" title="This vehicle has 4 Doors">{{$profile->car_doors}}
                                        <img alt="Doors" class="svgis"
                                            src="{{asset('icons/door.svg')}}">
                                    </li>
                                    <li title="This vehicle can seat upto 5 Passengers comfortably" class="f-13">
                                        {{$profile->passengers}}<img alt="Passengers" class="svgis passenger"
                                            src="{{asset('icons/seaticon.svg')}}">
                                    </li>
                                    <li title="The boot-space of this vehicle is good for 3 luggage bag(s)"
                                        class="f-13">{{$profile->bags}}<img alt="Large Bags" class="svgis"
                                            src="{{asset('icons/brefcase.svg')}}">
                                    </li>

                                </ul>
                            </div>
                            <div class="content_container ">
                                <div>

                                    @if (!empty($profile->delivery_days))
                                    <p>
                                        <span><i class="fa fa-check"></i></span> Delivery :
                                        {{ $profile->delivery_days }}
                                    </p>
                                @endif
                                @if ($profile->daily_availablity == 'Yes')
                                    <p>
                                        <span><i class="fa fa-check"></i></span> 1 day rental
                                        available
                                    </p>
                                @endif

                                @if ($profile->insurance_per_day)
                                    <p>
                                        <span><i class="fa fa-check"></i></span> Insurance
                                        included
                                    </p>
                                @endif


                                {{-- <p>
                                    <span><i class="fa fa-bitcoin"></i></span>Crypto payment accepted
                                </p> --}}
                                @if (!empty($profile->security_deposit))
                                    <p>
                                        <span><i class="fa fa-info"></i></span>Security Deposit : AED
                                        {{ $profile->security_deposit }}
                                    </p>
                                @endif

                                </div>

                                <div class="price_tag mb-0">
                                    @if (!empty($profile->daily_discount_price))
                                    <del>AED {{ $profile->price_per_day }}</del>
                                @endif
                                <span>
                                    @if (!empty($profile->daily_discount_price))
                                        <h2 class="clr_primary">AED {{ $profile->daily_discount_price }} /
                                            day</h2>
                                    @else
                                        <h2 class="clr_primary">AED {{ $profile->price_per_day }} / day</h2>
                                    @endif
                                </span>
                                <span>
                                    <i class="fa fa-road"></i>
                                    <span>{{ $profile->per_day_mileage }} km</span></span>
                                </div>
                                <div class="price_tag ms-0 ms-md-2">
                                    @if (!empty($profile->weekly_discount_price))
                                                <del>AED {{$profile->weekly_rent}}</del>
                                                @endif
                                                @if(!empty($profile->weekly_discount_price))
                                                <span>
                                                    <h2 class="clr_primary">AED {{ $profile->weekly_discount_price }} / week</h2>
                                                </span>
                                                @else
                                                <span>
                                                    <h2 class="clr_primary">AED {{ $profile->weekly_rent }} / week</h2>
                                                </span>
                                                @endif

                                                <span>
                                                    <i class="fa fa-road"></i>
                                                    <span>{{ $profile->weekly_mileage }} km</span>
                                        </span>
                                </div>

                            </div>

                            <div class="company_tag d-flex justify-content-between mt-2 flex-wrap">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <a class="clr_primary" href="#">
                                            <i class="fa fa-map-marker"></i>
                                            {{ $profile->get_user->city ?? '' }}

                                        </a>
                                    </div>
                                    <div class="ms-5">
                                        <img width="50px" src="{{ asset('company_logo') }}/{{ $profile->get_user->company_logo ?? '' }}"
                                            alt="" />
                                    </div>
                                </div>
                                <div>
                                    <div class="mt-3 d-flex justify-content-end">
                                        <div>
                                            <a href="javascript:void(0);" class="phonelead" id="phoneshare">
                                                <button class="yellow_btn d-flex my_wp">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <svg class="mr-auto d-block"
                                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                                fill="#fff" width="25" class="p-2"
                                                                 height="25">
                                                                <path
                                                                    d="M511.2 387l-23.25 100.8c-3.266 14.25-15.79 24.22-30.46 24.22C205.2 512 0 306.8 0 54.5c0-14.66 9.969-27.2 24.22-30.45l100.8-23.25C139.7-2.602 154.7 5.018 160.8 18.92l46.52 108.5c5.438 12.78 1.77 27.67-8.98 36.45L144.5 207.1c33.98 69.22 90.26 125.5 159.5 159.5l44.08-53.8c8.688-10.78 23.69-14.51 36.47-8.975l108.5 46.51C506.1 357.2 514.6 372.4 511.2 387z">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <span class="d-none numm text-light my_wp_num"
                                                                style="overflow: hidden">
                                                                &nbsp; {{$profile->get_user->contact ?? ''}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </a>
                                        </div>
                                        <a href="javascript:void(0);" class="socialShareLink">
                                            <div class="ms-1 ">
                                                <button class="wp_btn d-flex my_wp1">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 450 512"
                                                                fill="#fff" width="26" height="26">
                                                                <path
                                                                    d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <span class="d-none numm1 text-light my_wp_num1"
                                                                style="overflow: hidden">
                                                                &nbsp; {{$profile->get_user->whatsapp_number ?? ''}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </div>
                                        </a>

                                        <div class="ms-1">
                                            <button class="tel_btn d-flex ">
                                                <div class="d-flex align-items-center">
                                                    <div class="ml_1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                            fill="#fff" width="20" height="20">
                                                            <path
                                                                d="M511.6 36.86l-64 415.1c-1.5 9.734-7.375 18.22-15.97 23.05c-4.844 2.719-10.27 4.097-15.68 4.097c-4.188 0-8.319-.8154-12.29-2.472l-122.6-51.1l-50.86 76.29C226.3 508.5 219.8 512 212.8 512C201.3 512 192 502.7 192 491.2v-96.18c0-7.115 2.372-14.03 6.742-19.64L416 96l-293.7 264.3L19.69 317.5C8.438 312.8 .8125 302.2 .0625 289.1s5.469-23.72 16.06-29.77l448-255.1c10.69-6.109 23.88-5.547 34 1.406S513.5 24.72 511.6 36.86z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>

            <nav aria-label="Page navigation">
                <ul class="pagination d-flex flex-wrap">
                    <li class="page-item">
                        <a class="page-link" href="#">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
        </div>
    </section>

    <section class="bg_lime ">
        <div class="content_wrap">
            <p>
                The demand for comfort on trips is more of a compulsion. The integrity
                and exclusiveness of BMW does not require any mention and certainly
                fits you for any trip. Get easy BMW car rental in Dubai with
                OneClickDrive, the hub for luxury car rentals. We have a wide range of
                BMW models to choose from in accordance with your needs.
            </p>
            <h2>BMW Car Advantages:</h2>
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
            <h2>Best BMW Car Models to Rent In Dubai:</h2>
            <p>
                Rent a BMW in Dubai with the help of WheelsOnClick very easily by
                choosing from your favorite model. Amongst numerous models that we
                provide for hire, BMW 4 Series Convertible, BMW X6 SUV and BMW 730-li
                are no doubt the best and are widely popular. There are various other
                model options available directly on the website and mobile app.
            </p>
            <h2>Best BMW Car Rental Deals and Offers:</h2>
            <p>
                WheelsOnClick gives you the convenience to choose from various rent
                options. We have amazing offers for daily, weekly and monthly basis.
                Book BMW cars for rent starting from AED 299/day.
            </p>
            <h2>Why WheelsOnClick?</h2>
            <p>
                Booking a car for a trip to some unknown country is always a risky
                task. It is more challenging to find an authentic car rental company
                that would provide you with trustworthy and dedicated service. Well,
                your hassle of searching for a loyal car rental service for your next
                trip to Dubai comes to an end. Besides travelers, residents of UAE can
                directly book by comparing the rates from over 100+ car rental
                suppliers and finalize the best deal. WheelsOnClick ensures quality
                car rental service all over Dubai and you can rent your favorite car
                model at the most competitive rates. BMW car hire in Dubai is now
                easier and hassle free as you can rent your car in just one click.
                Nearly all models are available and you get them at unbelievable
                rental rates.
            </p>
        </div>
    </section>


    <section>
        <div class="content_wrap">
            <h2>Frequently Asked Questions</h2>
            <div class="collapse_wrap">
                <div class="collapse_items">
                    <div id="faq-one" class="custom_collapse">
                        <button onclick="onOpenCollapse('faq-one')">
                            <span> Why is driving a BMW recommended in Dubai? </span>
                            <i id="faq-one-arrow" class="fa fa-angle-down"></i>
                        </button>
                        <div id="faq-one-content" class="collapse_content">
                            <p>
                                Among the popular car choices, BMW is definitely a favorite.
                                In Dubai, more so, as itâ€™s perfect for Sheikh Zayed Road as
                                well as on the highways stretching across the Emirates. Being
                                one of the most scenic places for those seeking a luxurious
                                adventure on wheels, BMWs are the most-in-demand cars in
                                Dubai. Youâ€™ll be driving alongside exotic cars such as
                                Porsche, Mercedes Benz, Audi, not to mention a range of sports
                                cars.Many tourists and residents in Dubai rent a BMW to soak
                                the pleasure of driving a luxurious sedan. The spacious cabin,
                                extra legroom, advanced driving and safety features are what
                                BMW vehicles are most known for.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="collapse_items">
                    <div id="faq-two" class="custom_collapse">
                        <button onclick="onOpenCollapse('faq-two')">
                            <span>
                                Can I take the BMW rental car to Abu Dhabi from Dubai?
                            </span>
                            <i id="faq-two-arrow" class="fa fa-angle-down"></i>
                        </button>
                        <div id="faq-two-content" class="collapse_content">
                            <p>
                                Yes, you can! Most customers rent a luxury sedan in Dubai to
                                visit Abu Dhabi and other emirates. Itâ€™s definitely the best
                                way to explore the UAE. Car rental companies allow their
                                vehicles to be driven anywhere in the UAE, barring a few
                                locations such as Jebel Hafeet, Jebel Jais and desert areas.
                                Be sure to plan your drives in advance to make the most of it.
                                Google Maps is your best friend!If youâ€™re planning a trip to
                                the Grand Mosque, Louvre or Yas Marina, consider renting for 2
                                or more days to offset the additional mileage charge you will
                                incur. As most car rentals, including luxury and sports cars,
                                come with a standard mileage limit of 250-km per day. Dubai to
                                Abu Dhabi is a good 150-km away so youâ€™ll probably be clocking
                                over 300 km on the journey back.Best practice: Consult with
                                the car rental agency regarding your trip plan for
                                suggestions. Additional mileage packages may be available.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="collapse_items">
                    <div id="faq-three" class="custom_collapse">
                        <button onclick="onOpenCollapse('faq-three')">
                            <span>
                                Which type of BMW cars are available for rent in Dubai?
                            </span>
                            <i id="faq-three-arrow" class="fa fa-angle-down"></i>
                        </button>
                        <div id="faq-three-content" class="collapse_content">
                            <p>
                                WheelsOnClick.com works with several car rental companies
                                across the world. In Dubai, we work with quite a few BMW car
                                rental providers. You can choose among cars with a range of
                                engine sizes and additional features, including GPS
                                navigation, safety and performance enhancements. The BMW sedan
                                comes in various 4-door sedan, convertible models with
                                advanced features. Different models including: BMW 2-series,
                                3-series, 550i, 550 mpower, 730li, 750li, X5, X6 and more. If
                                youâ€™re looking for a rare BMW car model, contact our suppliers
                                who have listed a BMW. They might be able to cater to your
                                distinguished needs.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section>
        <div class="container">
            <em>
                <b class="clr_danger">Note:</b> The above listings including the
                prices are updated by the respective car rental company. Incase the
                car is not available at the price mentioned (exclusive of VAT), please
                inform us and weâ€™ll get back to you with the best alternative. Happy
                renting!
            </em>
        </div>
    </section>



    <script>
        $(document).ready(function() {
            $('.wishlist-button').on('click', function() {
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
                    success: function(response) {
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
        </script>
    <script>
       document.addEventListener("DOMContentLoaded", function() {
    const myWpElements = document.querySelectorAll(".my_wp");
    const my_wp_nums = document.querySelectorAll(".my_wp_num");

    myWpElements.forEach((myWpElement, index) => {
        myWpElement.addEventListener("focus", function() {
            my_wp_nums[index].classList.remove("d-none");
            console.log("focus.");
            myWpElement.style.width = "170px";
        });

        myWpElement.addEventListener("blur", function() {
            my_wp_nums[index].classList.add("d-none");
            console.log("blur");
            myWpElement.style.width = "47px";
        });
    });

    const myWpElements1 = document.querySelectorAll(".my_wp1");
    const my_wp_nums1 = document.querySelectorAll(".my_wp_num1");

    myWpElements1.forEach((myWpElement1, index) => {
        myWpElement1.addEventListener("focus", function() {
            my_wp_nums1[index].classList.remove("d-none");
            console.log("focus.");
            myWpElement1.style.width = "170px";
        });

        myWpElement1.addEventListener("blur", function() {
            my_wp_nums1[index].classList.add("d-none");
            console.log("blur");
            myWpElement1.style.width = "47px";
        });
    });
});



        // dropdown work



        function openDropdown() {
            var openTime = document.getElementsByClassName('open-time')[0];
            if (openTime.style.display === "block") {
                openTime.style.display = "none";
            } else {
                openTime.style.display = "block";
            }
        }
    </script>


<script>
    $("#carmake").on('change',function(){
        var brand = $("#carmake").val();
        var company_id  = $("#company_id").val();
        // alert(company_id);
        $.ajax({
                url: '{{ route('get_company_models') }}',
                type: 'GET',
                data: {
                    brand: brand,company_id:company_id,
                },
                success: function(response) {
                    // Update the heart icon after adding to the wishlist
                    if (response.status == 200) {
                        $('#carmodel2').html('');
                        $('#year2').html();
                        if (response != '') {
                            $.each(response.company_cars, function(value, i) {
                                $('#carmodel2').append(
                                    `<option   value ="${i.model_name}">${i.model_name}</option>`
                                );
                                $('#year2').append(
                                    `<option   value ="${i.make_year}">${i.make_year}</option>`
                                )
                            });
                        }
                    }
                }
            });
    })
</script>
<script>
    $("#carmodel2").on('change',function(){
       var model_name = $(this).val();
       var company_id  = $("#company_id").val();
       $.ajax({
                url: '{{ route('car_make_years') }}',
                type: 'GET',
                data: {
                    model_name: model_name,company_id:company_id,
                },
                success: function(response) {
                    // Update the heart icon after adding to the wishlist
                    if (response.status == 200) {
                        $('#year2').html('');
                        $('#car_features').html('');
                        if (response != '') {
                            $.each(response.make_years, function(value, index) {
                                $('#year2').append(
                                    `<option   value ="${index.make_year}">${index.make_year}</option>`
                                )
                                $.each(index.car_features,function(key,value){
                                    console.log(value);
                                    $('#car_features').append(`
                                <div class="form-check ms-3">
                                <input class="form-check-input" type="checkbox" value="" id="Bluetooth">&nbsp;
                                <label class="form-check-label" for="Bluetooth">

                                    </label>
                                </div>`
                                )
                            })

                            });
                        }
                    }
                }
            });
    })
</script>
@endsection
