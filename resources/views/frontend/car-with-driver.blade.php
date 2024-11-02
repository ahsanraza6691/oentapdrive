@extends('frontend.layouts.new_header')
@section('title', 'Car with Driver | OneTapDrive')
@section('content')

    <section class="linkingSec">
        <div class="container-lg">
            <div class="row">
                <div class="col-md-12">
                    <div class="filterBtnRow">
                        <ul class="linkingCont">
                            <li><a href="/" class="fa fa-home"></a></li>
                            <li><a href="#0">Dubai</a></li>
                            <li><a href="#0">car brand</a></li>
                            <li class="current"><span>By brand / by Vehicle type</span></li>
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
            <div class="row adsRow">
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
                        <form method="GET" action="{{ route('car-with-driver') }}">
                            <div id="filters" class="filters">
                                <h2 class="flex_between font_semi_bold">
                                    Filters
                                </h2>

                                <div class="collapse_wrap">
                                    <div class="collapse_items">
                                        <!-- Location -->
                                        <div id="location" class="custom_collapse">
                                            <button type="button" onclick="onOpenCollapse('location')">
                                                <span> Location </span>
                                                <i id="location-arrow" class="fa fa-angle-down"></i>
                                            </button>
                                            <div id="location-content" class="collapse_content">
                                                <select class="form-control" name="city">
                                                    <option value>Select City</option>
                                                    @foreach ($cities as $city)
                                                        <option value="{{ $city }}" name="city" selected="selected">
                                                            {{ $city }} </option>
                                                    @endforeach
                                                </select>
                                                <button class="updateBtn">update</button>
                                            </div>
                                        </div>

                                        <!-- Car Brand / Model -->
                                        <div id="vehicleType" class="custom_collapse">
                                            <button type="button" onclick="onOpenCollapse('vehicleType')">
                                                <span>Vehicle Type</span>
                                                <i id="vehicleType-arrow" class="fa fa-angle-down"></i>
                                            </button>
                                            <div id="vehicleType-content" class="collapse_content">
                                                @foreach ($vehical_type as $type)
                                                    <div class="form-check">
                                                        <div class="checkboxInput">
                                                            <input class="" type="checkbox"
                                                                   name="category[]"
                                                                   value="{{ $type }}" id="{{ $type }}"
                                                                {{ $checked }}>
                                                            <i class="fas fa-check"></i>
                                                        </div>
                                                        <label class="form-check-label" for="{{ $type }}">
                                                            {{ $type }}
                                                        </label>
                                                        <button class="updateBtn">update</button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>


                                        <!-- Model Year -->
                                        <div id="seats" class="custom_collapse">
                                            <button type="button" onclick="onOpenCollapse('seats')">
                                                <span> No. of Passengers </span>
                                                <i id="seats-arrow" class="fa fa-angle-down"></i>
                                            </button>
                                            <div id="seats-content" class="collapse_content">
                                                <div class="form-check">
                                                    <div class="checkboxInput">
                                                        <input type="checkbox" name="passengers[]" value="4,5">
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                    <label for="">4-5 Seats</label>
                                                    <button class="updateBtn">update</button>
                                                </div>

                                                <div class="form-check">
                                                    <div class="checkboxInput">
                                                        <input type="checkbox" name="passengers[]" value="6,7">
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                    <label for="">6-7 Seats</label>
                                                    <button class="updateBtn">update</button>
                                                </div>

                                                <div class="form-check">
                                                    <div class="checkboxInput">
                                                        <input type="checkbox" name="passengers[]" value="8,12">
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                    <label for="">8-12 Seats</label>
                                                    <button class="updateBtn">update</button>
                                                </div>

                                                <div class="form-check">
                                                    <div class="checkboxInput">
                                                        <input type="checkbox" name="passengers[]" value="13+">
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                    <label for="">13+ Seats</label>
                                                    <button class="updateBtn">update</button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- No. of Seats -->
                                        <div id="carBrands" class="custom_collapse">
                                            <button type="button" onclick="onOpenCollapse('carBrands')">
                                                <span> Car Brands </span>
                                                <i id="carBrands-arrow" class="fa fa-angle-down"></i>
                                            </button>
                                            <div id="carBrands-content" class="collapse_content">
                                                <select name="brand" class="form-control">
                                                    <option value>Select Brand</option>
                                                    @foreach ($car_brands as $brand)
                                                        <option value="{{ $brand }}">{{ $brand }}</option>
                                                    @endforeach
                                                </select>
                                                <button class="updateBtn">update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="d-flex align-items-center justify-content-between w-100 btnCont">
                                    @php
                                        $currenturl = url()->full();
                                    @endphp
                                    @if ($currenturl != 'https://onetapdrive.com/car-with-driver')
                                        <a href="{{ route('clear-filters') }}" class="themeBtn">
                                            Clear Filters
                                        </a>
                                    @endif
                                    <button class="themeBtn">Show Result</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="filterCont">
                        <div class="collapse_wrap">
                            <div class="collapse_items">
                                <div id="collapse1" class="custom_collapse">
                                    <button type="button" onclick="onOpenCollapse('collapse1')">
                                        <span> The OneTapDrive Edge </span>
                                        <i id="collapse1-arrow" class="fa fa-angle-down"></i>
                                    </button>
                                    <div id="collapse1-content" class="collapse_content">
                                        <ul>
                                            <li>
                                                All-inclusive rates with a professional chauffeur, fuel and salik (toll)
                                                charges
                                            </li>
                                            <li>
                                                Service rendered by one of the region's best limousine service companies
                                            </li>
                                            <li>
                                                Free upgrade if class of car booked isn't available
                                            </li>
                                            <li>
                                                Free cancellation upto 48 hours from pick-up time
                                            </li>
                                            <li>
                                                Trips starting at the airport include free meet and greet service
                                            </li>
                                            <li>
                                                Complimentary 90 minutes waiting time at the airport
                                            </li>
                                            <li>
                                                A brilliant experience – guaranteed!
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="collapse2" class="custom_collapse">
                                    <button type="button" onclick="onOpenCollapse('collapse2')">
                                        <span>Our Cars</span>
                                        <i id="collapse2-arrow" class="fa fa-angle-down"></i>
                                    </button>
                                    <div id="collapse2-content" class="collapse_content">
                                        <ul>
                                            <li>
                                                Our fleet includes only the latest, top-end model cars from world-class
                                                auto brands
                                            </li>
                                            <li>
                                                Every car comes equipped with GPS, USB charging points, leather seats,
                                                Bluetooth,
                                                bottled water, hand sanitizer and dry / wet tissues
                                            </li>
                                            <li>
                                                Before every service, our cars are professionally washed, cleaned and
                                                disinfected
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="collapse3" class="custom_collapse">
                                    <button type="button" onclick="onOpenCollapse('collapse3')">
                                        <span>Our Chauffeurs </span>
                                        <i id="collapse3-arrow" class="fa fa-angle-down"></i>
                                    </button>
                                    <div id="collapse3-content" class="collapse_content">
                                        <ul>
                                            <li>
                                                Our team of drivers are well-trained, uniformed to deliver best-in-class
                                                service at
                                                all times
                                            </li>
                                            <li>
                                                They are always punctual and generally arrive before time at the pick-up
                                                location
                                            </li>
                                            <li>
                                                They come with RTA-approved driving license, health &amp; life
                                                insurance, and valid
                                                UAE visa
                                            </li>
                                            <li>
                                                All of them are vaccinated and regularly test for Covid-19
                                            </li>
                                            <li>
                                                They follow all safety measures including wearing of face mask and
                                                gloves at all
                                                times
                                            </li>
                                            <li>
                                                Feel free to request a driver who can speak in your preferred language
                                                among Arabic,
                                                English, Hindi and Urdu
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="collapse4" class="custom_collapse">
                                    <button type="button" onclick="onOpenCollapse('collapse4')">
                                        <span> Why book through us </span>
                                        <i id="collapse4-arrow" class="fa fa-angle-down"></i>
                                    </button>
                                    <div id="collapse4-content" class="collapse_content">
                                        <div class="pnlp text-center">
                                            <div class="booking_th">
                                                <div class="m-b-20">
                                                    <p>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                             viewBox="0 0 25.644 25.742">
                                                            <path id="Icon_material-cancel"
                                                                  data-name="Icon material-cancel"
                                                                  d="M15.822,3A12.871,12.871,0,1,0,28.644,15.871,12.835,12.835,0,0,0,15.822,3Zm6.411,17.492-1.808,1.815-4.6-4.621-4.6,4.621L9.411,20.492l4.6-4.621-4.6-4.621,1.808-1.815,4.6,4.621,4.6-4.621,1.808,1.815-4.6,4.621Z"
                                                                  transform="translate(-3 -3)" fill="#ffba00"></path>
                                                        </svg>
                                                    </p>
                                                    <p>
                                                        Free cancellation upto 48 hours from pick-up time </p>
                                                </div>
                                                <div class="m-b-20">
                                                    <p>
                                                        <svg id="Component_1_1" data-name="Component 1 - 1"
                                                             xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                             viewBox="0 0 21.684 20.6">
                                                            <g id="Group_11" data-name="Group 11">
                                                                <path id="Path_22" data-name="Path 22"
                                                                      d="M20.61,135.934a18.173,18.173,0,0,0-5.3-2.025l.16-.22a.36.36,0,0,0,.058-.3l-.335-1.342a7.721,7.721,0,0,0,1.431-4.353v-2.229l0,0a2,2,0,0,0,.623-.934l-.37-.1-1.9-.333a22.99,22.99,0,0,0-8.287,0l-1.93.341-.34.085a2,2,0,0,0,.625.942l0,0v2.228a7.724,7.724,0,0,0,1.43,4.353l-.335,1.342a.361.361,0,0,0,.058.3l.16.22a18.177,18.177,0,0,0-5.3,2.025A2.006,2.006,0,0,0,0,137.714v1.545a.361.361,0,0,0,.361.361H21.322a.362.362,0,0,0,.361-.361v-1.545A2.006,2.006,0,0,0,20.61,135.934Zm-11.289.8L6.9,133.4l.162-.648,0,0a5.311,5.311,0,0,0,3.235,1.77h0Zm-1.413-4.159c-.091-.085-.182-.167-.269-.26l0,0q-.2-.211-.385-.45a.3.3,0,0,0-.04-.034,6.645,6.645,0,0,1-1.427-4.134v-1.842l.027.006c.033.009.067.016.1.024s.078.018.118.025.072.008.108.012.075.009.113.011.094,0,.141,0c.027,0,.055,0,.082,0A1.955,1.955,0,0,0,6.7,125.9a22.99,22.99,0,0,1,8.287,0,2.041,2.041,0,0,0,.317.028l.035,0,.033,0a1.99,1.99,0,0,0,.531-.078v1.842a6.645,6.645,0,0,1-1.428,4.134.326.326,0,0,0-.04.034q-.186.238-.385.449l0,0c-.087.093-.179.175-.269.259a4.508,4.508,0,0,1-2.935,1.264A4.507,4.507,0,0,1,7.907,132.574Zm4.456,4.159-.98-2.207h0a5.31,5.31,0,0,0,3.235-1.77l0,0,.163.648Z"
                                                                      transform="translate(0 -119.021)"
                                                                      fill="#ffba00"></path>
                                                                <path id="Path_23" data-name="Path 23"
                                                                      d="M104.77,17.162a23.709,23.709,0,0,1,8.542,0l1.926.34.3.082a4.9,4.9,0,0,0-4.9-4.784h-3.207a4.9,4.9,0,0,0-4.9,4.777l.276-.069Zm3.186-2.917a.361.361,0,0,1,.361-.361h1.446a.361.361,0,0,1,.361.361v1.807a.361.361,0,0,1-.361.361h-1.446a.361.361,0,0,1-.361-.361Z"
                                                                      transform="translate(-98.199 -12.8)"
                                                                      fill="#ffba00"></path>
                                                                <rect id="Rectangle_37" data-name="Rectangle 37"
                                                                      width="0.723"
                                                                      height="1.084" transform="translate(10.48 1.807)"
                                                                      fill="#ffba00">
                                                                </rect>
                                                            </g>
                                                        </svg>
                                                    </p>
                                                    <p>
                                                        Licensed, well-trained and uniformed chauffeurs </p>
                                                </div>
                                                <div class="m-b-20">
                                                    <p>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                             viewBox="0 0 23.997 20.703">
                                                            <path id="Icon_material-shopping-basket"
                                                                  data-name="Icon material-shopping-basket"
                                                                  d="M19.182,10.644,14.4,3.488A1.083,1.083,0,0,0,13.5,3.03a1.066,1.066,0,0,0-.905.469L7.816,10.644H2.591A1.094,1.094,0,0,0,1.5,11.735a.919.919,0,0,0,.044.295L4.314,22.141a2.169,2.169,0,0,0,2.094,1.593h14.18a2.192,2.192,0,0,0,2.105-1.593l2.771-10.112.033-.295a1.094,1.094,0,0,0-1.091-1.091Zm-8.955,0,3.272-4.8,3.272,4.8ZM13.5,19.37a2.182,2.182,0,1,1,2.182-2.182A2.188,2.188,0,0,1,13.5,19.37Z"
                                                                  transform="translate(-1.5 -3.03)"
                                                                  fill="#ffba00"></path>
                                                        </svg>
                                                    </p>
                                                    <p>
                                                        Drinking water and dry tissue included in every car </p>
                                                </div>
                                                <div class="m-b-20">
                                                    <p>
                                                        <svg id="noun-car-seat-17915" xmlns="http://www.w3.org/2000/svg"
                                                             width="20" height="20" viewBox="0 0 24.363 19.958">
                                                            <path id="Path_24" data-name="Path 24"
                                                                  d="M356.823,107.086a2.847,2.847,0,0,0,2.036.724l2.658-3.493a2.8,2.8,0,0,0-.854-1.5,2.87,2.87,0,0,0-3.84,4.267Z"
                                                                  transform="translate(-343.458 -102.082)"
                                                                  fill="#ffba00"></path>
                                                            <path id="Path_25" data-name="Path 25"
                                                                  d="M79.092,388.238l-4.721-1.494a2.534,2.534,0,0,0-3.175,1.589,5.819,5.819,0,0,0,1.847,5.849l7.919-.011Z"
                                                                  transform="translate(-71.004 -374.224)"
                                                                  fill="#ffba00"></path>
                                                            <path id="Path_26" data-name="Path 26"
                                                                  d="M433.521,116.658l.688-.9a2.479,2.479,0,0,0-3.943-3.006l-4.448,5.834Z"
                                                                  transform="translate(-410.354 -111.351)"
                                                                  fill="#ffba00"></path>
                                                            <path id="Path_27" data-name="Path 27"
                                                                  d="M301.842,271.05l-4.077,5.348,1.66,5.268a2.474,2.474,0,0,0,1.208-.852l8.912-11.689Z"
                                                                  transform="translate(-287.882 -261.845)"
                                                                  fill="#ffba00"></path>
                                                            <path id="Path_28" data-name="Path 28"
                                                                  d="M269.956,112.1l2.521,1.658.987-1.3a1.1,1.1,0,0,0-.161-.454,4.553,4.553,0,0,0-1.836-1.317l-.007.007a4.21,4.21,0,0,1-1.217-1.447,2.679,2.679,0,0,1,.141-2.4,1.023,1.023,0,0,0-1.7-1.142,4.758,4.758,0,0,0-.318,4.364,5.945,5.945,0,0,0,1.587,2.029Z"
                                                                  transform="translate(-259.392 -105.117)"
                                                                  fill="#ffba00"></path>
                                                            <path id="Path_29" data-name="Path 29"
                                                                  d="M140.462,257.966c-.333.359-.669.723-.913.994-.089-.341-.176-.683-.264-1.025a1.155,1.155,0,0,0-.826-.921,1.491,1.491,0,0,0-.751.076c-1.223.395-2.622.9-3.846,1.3a.965.965,0,1,0,.613,1.83c.824-.264,1.882-.633,2.706-.9.206.794.419,1.707.623,2.5a2.7,2.7,0,0,0,.708,1.426,2.025,2.025,0,0,0,1.32.513l3.149-4.138Z"
                                                                  transform="translate(-130.461 -250.241)"
                                                                  fill="#ffba00"></path>
                                                            <path id="Path_30" data-name="Path 30"
                                                                  d="M149.918,344.6l-3.409-1.181,2.711-1.162Z"
                                                                  transform="translate(-143.218 -331.793)"
                                                                  fill="#ffba00"></path>
                                                        </svg>
                                                    </p>
                                                    <p>
                                                        24x7 customer support </p>
                                                </div>
                                                <div class="m-b-20">
                                                    <p>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                             viewBox="0 0 27.65 24.167">
                                                            <path id="customer-care-icon"
                                                                  d="M18.4,12.3l-.119.369-.018.032-.016.02a1.627,1.627,0,0,1-.45.052,2.889,2.889,0,0,0,.137-1.267h0a.344.344,0,0,1,.137-.3,1.535,1.535,0,0,0,.536-.763l.074-.587a1.109,1.109,0,0,0-.043-.236.172.172,0,0,0-.025-.065h-.059a.344.344,0,0,1-.324-.342,5.8,5.8,0,0,0-.308-2.279,3.237,3.237,0,0,0-1.5-1.186c-.11-.047-.225-.1-.338-.158-2.054,2.147-3.756-.614-6.193,3.544H9.8c-.032.072-.065.144-.1.225l-.018.036a.344.344,0,0,1-.47.126q-.083-.047-.095-.041c-.014,0-.029.036-.05.083A1.058,1.058,0,0,0,9,9.9a2.051,2.051,0,0,0,.45,1.433.34.34,0,0,1,.106.239,3.274,3.274,0,0,0,1.5,2.743l.338.293a3.774,3.774,0,0,0,2.475,1.085,3.378,3.378,0,0,0,2.365-1.067h1.01l-.182.173-.333.315a4.1,4.1,0,0,1-2.844,1.271,4.484,4.484,0,0,1-2.941-1.26l-.329-.288a3.913,3.913,0,0,1-1.67-2.522L7.858,12.4a.806.806,0,0,1-.911-.659L6.526,8.417a.8.8,0,0,1,.722-.88L7.6,7.508a.4.4,0,0,1-.036-.146C7.354,3.907,8.843,1.736,10.857.694a6.7,6.7,0,0,1,6.55.34,5.919,5.919,0,0,1,2.5,6.373.551.551,0,0,1-.041.122l.538.061a.857.857,0,0,1,.763.961l-.416,3.164a.884.884,0,0,1-.988.74h0a6.355,6.355,0,0,1-.225.7,1.575,1.575,0,0,1-.338.524c-.45.464-1.9.464-2.419.464h-1.35a1.575,1.575,0,0,1-1.181.45c-.747,0-1.35-.4-1.35-.884s.6-.884,1.35-.884a1.589,1.589,0,0,1,1.139.448h1.384a4.838,4.838,0,0,0,1.814-.209.675.675,0,0,0,.144-.225l.153-.477-.491-.056ZM8.551,6.113a5.834,5.834,0,0,1,8.875-3.528,4.208,4.208,0,0,1,.961.756,4.752,4.752,0,0,0-1.535-1.575A5.589,5.589,0,0,0,14.136.9a5.488,5.488,0,0,0-2.795.569A5.319,5.319,0,0,0,8.551,6.113Zm1.526,10.313,2.075,5.443L13.2,18.9l-.511-.558c-.385-.563-.252-1.2.45-1.314a5.143,5.143,0,0,1,.772-.016,4.071,4.071,0,0,1,.848.034c.662.144.731.785.4,1.3l-.5.558,1.042,2.97,1.879-5.445c1.35,1.22,6.123,1.465,7.615,2.3,2.066,1.157,2.009,3.375,2.462,5.445H0c.45-2.05.4-4.307,2.462-5.445C4.3,17.7,8.575,17.775,10.076,16.425Z"
                                                                  transform="translate(0 0.002)" fill="#ffba00"></path>
                                                        </svg>
                                                    </p>
                                                    <p>
                                                        Child seat available free of cost </p>
                                                </div>
                                                <div class="m-b-20">
                                                    <p>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                             viewBox="0 0 22.521 22.521">
                                                            <path id="Icon_awesome-clock" data-name="Icon awesome-clock"
                                                                  d="M11.823.563A11.261,11.261,0,1,0,23.084,11.823,11.259,11.259,0,0,0,11.823.563Zm2.593,15.9-4-2.911a.548.548,0,0,1-.222-.44V5.466a.546.546,0,0,1,.545-.545h2.179a.546.546,0,0,1,.545.545v6.252l2.883,2.1a.545.545,0,0,1,.118.763l-1.28,1.762A.549.549,0,0,1,14.416,16.459Z"
                                                                  transform="translate(-0.563 -0.563)"
                                                                  fill="#ffba00"></path>
                                                        </svg>
                                                    </p>
                                                    <p>
                                                        Complimentary wait time included in price </p>
                                                </div>
                                                <div class="m-b-20">
                                                    <p>
                                                        <svg id="noun-shield-tick-620741"
                                                             xmlns="http://www.w3.org/2000/svg"
                                                             width="20" height="20" viewBox="0 0 20.681 25.759">
                                                            <path id="Path_31" data-name="Path 31"
                                                                  d="M176.787,62.358l8.051,2v6.465a10.59,10.59,0,0,1-3.589,7.945l-4.462,3.935-4.462-3.935a10.59,10.59,0,0,1-3.589-7.945V64.365l8.051-2m0-2.361-10.341,2.576v8.251a12.88,12.88,0,0,0,4.365,9.662l5.976,5.269,5.976-5.269a12.88,12.88,0,0,0,4.365-9.662V62.576Z"
                                                                  transform="translate(-166.446 -60)"
                                                                  fill="#ffba00"></path>
                                                            <path id="Path_32" data-name="Path 32"
                                                                  d="M342.879,373.545l-7.977,7.977-4.9-4.9,1.783-1.783,3.12,3.12,6.194-6.194Z"
                                                                  transform="translate(-326.099 -364.326)"
                                                                  fill="#ffba00"></path>
                                                            <path id="Path_33" data-name="Path 33"
                                                                  d="M342.879,373.545l-7.977,7.977-4.9-4.9,1.783-1.783,3.12,3.12,6.194-6.194Z"
                                                                  transform="translate(-326.099 -364.326)"
                                                                  fill="#ffba00"></path>
                                                        </svg>
                                                    </p>
                                                    <p>
                                                        All-inclusive, transparent prices </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="container-fluid">
                        <div class="contentArea">
                            <div class="row carRow">
                                <div class="col-12">
                                    <h2 class="secHeading">CAR WITH DRIVER IN DUBAI, UAE</h2>
                                    <p>
                                        Hire cars directly from local car rental companies at the best rate
                                    </p>
                                </div>
                                <div class="col-md-9">
                                    <div class="filterTags">
                                        <button class="filterTag all">
                                            Clear all filters
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <button class="filterTag">
                                            Sedan
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <button class="filterTag">
                                            4 - 5 Seaters
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="inputCont sort">
                                        <select autocomplete="off">
                                            <option selected="selected" value="">
                                                Sort: Featured
                                            </option>
                                            <option value="">
                                                Daily (low to high)
                                            </option>
                                            <option value="">
                                                Daily (high to low)
                                            </option>
                                            <option value="">
                                                Weekly (low to high)
                                            </option>
                                            <option value="">
                                                Monthly (low to high)
                                            </option>
                                            <option value="">
                                                Passengers (low to high)
                                            </option>
                                            <option value="">
                                                Passengers (high to low)
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                @if (count($cars) > 0)
                                    @foreach ($cars as $key => $value)
                                        <div class="col-lg-12 col-sm-6">
                                            <div class="carCard fullCard serviceCard cwdCard">
                                                <a class="imgCont"
                                                   href="{{ $value->service_type == 'Chauffeur Service' ? route('chauffeur-service', ['slug' => $value->slug]) : route('dubai-car-with-driver', ['slug' => $value->slug]) }}">

                                                    @if ($value->images)
                                                        @php
                                                            $imageNames = json_decode($value->images);
                                                        @endphp
                                                        @if ($imageNames && count($imageNames) > 0)
                                                            <img src="{{ asset("images/" . $imageNames[0]) }}"
                                                                 alt="{{ $imageNames[0] }}"/>
                                                        @endif
                                                    @endif
                                                </a>

                                                <a href="{{ $value->service_type == 'Chauffeur Service' ? route('chauffeur-service', ['slug' => $value->slug]) : route('dubai-car-with-driver', ['slug' => $value->slug]) }}"
                                                   class="contentWrap">
                                                    <div class="content">
                                                        <h2 class="title">
                                                            <span>{{ $value->category_type }} {{ $value->vehicle_type }}</span>
                                                            {{ $value->brand_name ?? '' }} {{ $value->model_name ?? '' }} {{ $value->make_year ?? '' }}
                                                        </h2>
                                                        <div class="rent_details">
                                                            {{--                                                        @dd($value)--}}
                                                            @if ($value->service_type == 'Chauffeur Service')
                                                                {{-- <p>AED 1700</p> --}}
                                                                <p class="price">
                                                                <span class="colored">
                                                                {{$value->minimunm_hours_booking_charges}} AED
                                                                </span>
                                                                    / For {{$value->minimunm_hours_booking}} minimum
                                                                    hours
                                                                    service in {{$value->city}}
                                                                </p>
                                                                <p class="price">
                                                                <span class="colored">
                                                                {{$value->maximunm_hours_booking_charges}} AED
                                                                </span>
                                                                    / For {{$value->maximunm_hours_booking}} maximum
                                                                    hours
                                                                    service in {{$value->city}}
                                                                </p>
                                                                <p class="price">
                                                                <span class="colored">
                                                                    {{$value -> additional_hour_minimum_charges}}AED
                                                                </span>
                                                                    /hour Additional charges
                                                                </p>
                                                            @else
                                                                <p class="price">
                                                                <span class="colored">
                                                                    AED {{ $value->transfer_city_charges }}
                                                                </span>
                                                                    For transfer within {{ $value->transfer_city_name }}
                                                                </p>
                                                                <p class="price">
                                                                <span class="colored">
                                                                    AED {{ $value->from_city_to_city_charges }}
                                                                </span>
                                                                    For {{ $value->from_city }} to {{ $value->to_city }}
                                                                </p>
                                                            @endif
                                                        </div>
                                                        <div class="tags">
                                                            @if ($value->service_type == 'Chauffeur Service')
                                                                <span
                                                                    class="properties_border">
                                                            {{ $value->category_type ?? '' }}
                                                            <i class="fas fa-car"></i>
                                                        </span>
                                                            @endif

                                                            @if($value->passengers)
                                                                <span class="properties_border"
                                                                      title="This vehicle can seat upto 5 Passengers comfortably">
                                                                {{ $value->passengers ?? '' }}
                                                                <svg
                                                                    stroke="currentColor"
                                                                    fill="currentColor"
                                                                    stroke-width="0"
                                                                    viewBox="0 0 24 24"
                                                                    height="1em"
                                                                    width="1em"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        fill="none"
                                                                        d="M0 0h24v24H0V0z"></path>
                                                                    <path
                                                                        d="M15 5v7H9V5h6m0-2H9c-1.1 0-2 .9-2 2v9h10V5c0-1.1-.9-2-2-2zm7 7h-3v3h3v-3zM5 10H2v3h3v-3zm15 5H4v6h2v-4h12v4h2v-6z">
                                                                    </path>
                                                                </svg>
                                                            </span>
                                                            @endif

                                                            @if($value->luggage)
                                                                <span class="properties_border"
                                                                      title="The boot-space of this vehicle is good for 3 luggage bag(s)">
                                                                {{ $value->luggage ?? '' }}
                                                                <svg
                                                                    stroke="currentColor"
                                                                    fill="currentColor"
                                                                    stroke-width="0"
                                                                    viewBox="0 0 24 24"
                                                                    height="1em"
                                                                    width="1em"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        fill="none"
                                                                        d="M0 0h24v24H0z"></path>
                                                                    <path
                                                                        d="M17 6h-2V3c0-.55-.45-1-1-1h-4c-.55 0-1 .45-1 1v3H7c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2 0 .55.45 1 1 1s1-.45 1-1h6c0 .55.45 1 1 1s1-.45 1-1c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zM9.5 18H8V9h1.5v9zm3.25 0h-1.5V9h1.5v9zm.75-12h-3V3.5h3V6zM16 18h-1.5V9H16v9z">
                                                                    </path>
                                                                </svg>
                                                            </span>
                                                            @endif
                                                        </div>

                                                        <div class="other_details">
                                                            <div class="right_details_area">
                                                                <p>
                                                                    <span><i class="fa fa-check"></i></span>
                                                                    Pinnacle of excellence:
                                                                    Unmatched luxury and innovation
                                                                </p>
                                                                <p>
                                                                    <span><i class="fa fa-check"></i></span>
                                                                    Meticulously crafted:
                                                                    Attention to detail throughout
                                                                </p>
                                                                <p>
                                                                    <span><i class="fa fa-check"></i></span>
                                                                    Intelligent technology:
                                                                    Cutting-edge features redefine driving
                                                                </p>
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
                                    <h2 style="text-align: center">Cars Data Not found</h2>
                                @endif
                                <div class="col-12">
                                    <div class="text-center ">
                                        Showing {{ $cars->firstItem() }} to {{ $cars->lastItem() }}
                                        of total {{ $cars->total() }} Cars
                                    </div>
                                    <div class="paginationCont">
                                        {{ $cars->links() }}
                                    </div>
                                    <div class="btnCont d-flex align-items-center justify-content-center my-2">
                                        <a href="" class="themeBtn">
                                            Switch To Airport Transfer
                                        </a>
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
                        <h2 class="secHeading">Professional Chauffeur Service Dubai</h2>
                        <p>
                            Get the best on-ground transportation 24x7 across the emirates. Our
                            experienced drivers and range of premium cars are available 24x7.
                            OneTapDrive offers the most dependable chauffeured car services in
                            the UAE: Be it a limo pick-up for your VIP guests at the airport or a
                            family day out. Make a hassle-free booking today!
                        </p>
                        <p>
                            We offer the most affordable yet perfect car and driver service across
                            the UAE including hourly chauffeur service, airport transfer service,
                            limousine service, event transportation and so on. For custom / bulk
                            bookings, feel free to get in touch with us.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="testiSec">
        <div class="container-lg">
            <div class="row">
                <div class="col-md-5">
                    <div class="headingCont">
                        <h3>
                            Our Community
                        </h3>
                        <p>
                            The experiences shared by our distinguished users have always helped us up our game. The
                            OneClickDrive Marketplace is often re engineered as we follow a "Listen Understand Improve"
                            cycle
                        </p>
                    </div>
                </div>
                {{--                <div class="col-md-7">--}}
                {{--                    <h2 class="secHeading">--}}
                {{--                        Testimonials--}}
                {{--                    </h2>--}}
                {{--                    <div class="swiper testiSwiper">--}}
                {{--                        <div class="swiper-wrapper">--}}
                {{--                            <div class="swiper-slide">--}}
                {{--                                <div class="testimonialCard">--}}
                {{--                                    <div class="userInfo">--}}
                {{--                                        <figure>--}}
                {{--                                            <img loading="lazy" src="{{asset('/web-assets/images/user.webp')}}" alt="">--}}
                {{--                                        </figure>--}}
                {{--                                        <div class="info">--}}
                {{--                                            <h4>John Doe</h4>--}}
                {{--                                            <p>May 25 2023</p>--}}
                {{--                                            <div class="rating">--}}
                {{--                                                <i class="fas fa-star"></i>--}}
                {{--                                                <i class="fas fa-star"></i>--}}
                {{--                                                <i class="fas fa-star"></i>--}}
                {{--                                                <i class="fas fa-star"></i>--}}
                {{--                                                <i class="fas fa-star"></i>--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                    <p>--}}
                {{--                                        <span>Service Was Excellent</span>--}}
                {{--                                        In publishing and graphic design, Lorem ipsum is a placeholder text--}}
                {{--                                        commonly used to demonstrate the visual form of a document or a typeface--}}
                {{--                                        without relying on meaningful content. Lorem ipsum may be used as a--}}
                {{--                                        placeholder before final copy is available.--}}
                {{--                                    </p>--}}
                {{--                                    <div class="source">--}}
                {{--                                        <span>Source: </span>--}}
                {{--                                        <img loading="lazy" src="{{asset("/web-assets/images/google-logo.webp")}}" alt="">--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
        </div>
    </section>

    <section class="apartSec">
        <div class="container-lg">
            <div class="row gap-md-0 gap-5">
                <div class="col-12">
                    <h2 class="secHeading">
                        Affordable Chauffeur Services in Dubai
                    </h2>
                    <p>
                        Sit back and relax while we drive you across Dubai, Abu Dhabi, Sharjah and other emirates in a
                        range of sedans, SUVs and vans.
                    </p>
                </div>
                <div class="col-md-4">
                    <div class="apartBox">
                        <figure>
                            <i class="fa fa-quote-left"></i>
                        </figure>
                        <div class="content">
                            <h4>All-inclusive rates</h4>
                            <p>
                                Our unbeatable rates include fuel, salik (toll), taxes and all
                                other charges. Pay in advance and have your guests chauffeured
                                with ease.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="apartBox">
                        <figure>
                            <i class="fa fa-quote-left"></i>
                        </figure>
                        <div class="content">
                            <h4>All-inclusive rates</h4>
                            <p>
                                Our unbeatable rates include fuel, salik (toll), taxes and all
                                other charges. Pay in advance and have your guests chauffeured
                                with ease.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="apartBox">
                        <figure>
                            <i class="fa fa-quote-left"></i>
                        </figure>
                        <div class="content">
                            <h4>All-inclusive rates</h4>
                            <p>
                                Our unbeatable rates include fuel, salik (toll), taxes and all
                                other charges. Pay in advance and have your guests chauffeured
                                with ease.
                            </p>
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
                        <h2 class="secHeading">What is Chauffeur Service in Dubai?</h2>

                        <p>
                            Dubai Chauffeur service is excellent for renting a car with a
                            <strong>professional driver. Car rental Dubai with driver </strong>
                            offers a fantastic collection of luxury cars with drivers to explore
                            the <strong>famous city</strong> in UAE. Often these companies provide
                            tailor-made tours for visitors and residents. The rental
                            <strong>company transport</strong> is savior if you need an executive
                            car with a driver to pick you up from the airport or for business
                            meetings.
                        </p>
                        <p>
                            This <strong>excellent service</strong> is available around UAE, and
                            now you can have it in Abu Dhabi.
                        </p>
                        <h2 class="secHeading">How do I book Car Rentals with a driver in Dubai?</h2>

                        <p>
                            Car rental with a driver in Dubai is hassle-free and easy. You can
                            easily browse through various car with driver websites to overview the
                            offers made by different companies.
                        </p>
                        <p>
                            From here, you can quickly narrow down what you want. Companies like
                            OneTapDrive offer <strong>Executive chauffeur services</strong> with
                            cars at affordable prices and rent a car with drivers monthly, weekly
                            or even hourly <strong>for cheap chauffeur service.</strong>
                        </p>
                        <h2 class="secHeading">Luxury Car Rental Dubai with Driver</h2>
                        <p>
                            Dubai is one of the most incredible travel destinations in the world,
                            with a vast number of visitors from around the globe!
                        </p>
                        <p>
                            <strong>Rental cars in Dubai</strong> with drivers allow you to take
                            in the city in all its glory. Whether it’s a luxury car, SUV car or
                            luxury bus to choose from or comfortable 4x4s, we’ve got you covered!
                        </p>

                        <h2 class="secHeading">Valid Reasons to Rent a Car with a Driver in Dubai</h2>
                        <p>
                            Are you someone who tires easily when traveling to far-off places in a
                            car, or are you a tourist or local in Dubai who doesn’t enjoy driving?
                        </p>
                        <p>
                            You can take a seat, unwind and enjoy the journey by hiring a car with
                            a driver in Dubai with <strong>chauffeur service online.</strong>
                        </p>
                        <p>
                            Then opt for a car with
                            <strong>chauffeur services in Dubai</strong> that offer experienced
                            drivers for you to travel around the UAE without worry!
                        </p>
                        <p>
                            You won’t have to worry about where to park when you get
                            <strong>professional chauffeur services</strong> because the driver
                            will be in charge of all of that.
                        </p>
                        <p>
                            Car rental in Dubai with a driver also helps you save money, as the
                            exorbitant cab fare can eat up your budget; undoubtedly, it’s a
                            <strong>reliable service</strong> you can depend on around the clock.
                        </p>
                        <p>
                            The One Click Drive’s extensive fleet of vehicles provides all the
                            ease you are looking for in a busy city like Dubai. Enjoy
                            <strong>Abu Dhabi City tours</strong> in style and make an impression
                            on onlookers.
                        </p>
                        <p>
                            So if you are considering taking a trip, we advise you to rent a
                            <strong>luxury car with a driver in Dubai</strong> from local
                            suppliers listed on our platform, whether it is
                            <strong>luxury buses</strong>, <strong>luxury cars</strong> or
                            <strong> luxury vans</strong>. You can rely on
                            <strong>breathtaking luxury</strong> with closed eyes to ensure your
                            rental experience is as convenient as possible.
                        </p>

                        <h2 class="secHeading">Chauffeur Car with Driver Service for Every Need</h2>
                        <p><strong>A to B Transfer Service</strong></p>
                        <p>
                            Whether you’re in Dubai for a <strong>business meeting</strong> or
                            want to explore its stunning beaches and architectural beauty, Dubai
                            suppliers at OneTapDrive have you covered!
                        </p>
                        <p>
                            From point-to-point transportation with professional drivers to
                            airport transfers, you can
                            <strong>hire a car in Dubai with driver</strong> at your convenience!
                        </p>
                        <p>
                            With this reliable transportation service, the biggest marketplace for
                            all <strong>multinational companies</strong>, you can go to your
                            meetings on time and be free of the hassle of
                            <strong>city transfer.</strong>
                        </p>
                        <h2 class="secHeading">Corporate Events</h2>
                        <p>
                            When it comes to corporate events, everything needs to be planned
                            carefully. Our platform has a reliable full-day
                            <strong>rent a car with driver Dubai</strong> that ensures that
                            transportation to the event venue is the last concern on your mind.
                            You can rent some of the most luxurious cars, such as Mercedes,
                            Lamborghini, Audi, Rolls Royce and more, without the hassle of monthly
                            car installments!
                        </p>
                        <h2 class="secHeading">
                            Special Occasions like Weddings, Birthday or Anniversary Parties
                        </h2>
                        <p>
                            If you want to provide your guests with exceptional treatment, why not
                            go for a <strong>luxury car rental Dubai with driver?</strong>
                        </p>

                        <p>
                            This ensures they can be picked up and dropped off at the venue of the
                            wedding, birthday or anniversary party.
                        </p>
                        <p>
                            With <strong>luxury chauffeur service in Dubai,</strong> you can enjoy
                            <strong>luxurious rides</strong> around the city with comfort and
                            ease.
                        </p>

                        <h2 class="secHeading">Why Car Rental with Driver in Dubai with OneTapDrive?</h2>
                        <p>
                            <strong>Car Renting Made Easy:</strong> We connect you to an extensive
                            network of rent-a-car with driver companies in Dubai that offer
                            excellent deals and cars catered to your needs.
                        </p>
                        <p>
                            <strong>Flexibility:</strong> You can choose daily, weekly or monthly
                            rental options, or you can even customise depending on your
                            requirement.
                        </p>
                        <p>
                            <strong>Wide Array of Options:</strong> Select from many executive and
                            luxury cars driven by professional chauffeurs, and travel freely at
                            your own pace.
                        </p>
                        <p>
                            <strong>Budget-friendly Choices:</strong> We work with many car
                            rentals with driver suppliers in Dubai who offer the lowest and most
                            competitive rates across the UAE.
                        </p>
                        <h2 class="secHeading">Car Hire with Driver in Dubai For Personal Usage</h2>
                        <p>
                            If you’re looking for a way to do a Dubai city tour without worrying
                            about public transportation, rent a car with a driver in Dubai. With
                            this service, you can simply contact a trained driver with a car and
                            let them know where you want to go. The driver will then take care of
                            everything from driving you to your destination to taking care of
                            parking rules.
                        </p>

                        <p>
                            This is an excellent option if you’re busy and don’t have time to wait
                            for buses, metro or taxi drivers. Plus, it’s much safer than driving
                            yourself.
                        </p>
                        <p>
                            You can go shopping and have a combined shopping trip with your
                            friends and family if you are new to the city You can also enjoy a
                            city tour with your friends and family.
                        </p>
                        <h2 class="secHeading">Car Rental Dubai with Driver for Business Travel</h2>
                        <p>
                            Getting the most out of your business trip is vital if you’re
                            traveling for work. With
                            <strong>Dubai luxury car rental with a driver,</strong> you can have
                            someone take care of your driving. With plenty of time, you can relax
                            and focus on what’s important: getting your work done.
                        </p>
                        <p>
                            The chauffeur will also be able to help you find the best tourist
                            attractions in your destination.
                        </p>

                        <p>
                            Renting a car with a driver in Dubai is perfect for busy
                            <strong>business associates</strong> who dont want to worry about
                            driving. Plus, it’s a great way to get around town without worrying
                            about parking, traffic, or navigation.
                        </p>
                        <h2 class="secHeading">Economical car rental in Dubai with a driver</h2>
                        <p>
                            If you’re looking for a <strong>cheap rental car</strong> with a
                            driver in Dubai, look no further than the OneTapDrive marketplace.
                            With so many local suppliers, you can find one that fits your budget
                            and needs. Our suppliers also offer various service options, including
                            pickups from the airport and drop-offs at your hotel or destination.
                        </p>
                        <h2 class="secHeading">OneTapDrive- Unlock Extraordinary Adventures</h2>
                        <p>
                            At OneTapDrive, we cater to your every adventure-seeking desire.
                            Whether you’re looking to explore the scenic beauty of the city in
                            chauffeur driven cars, sail the pristine waters on a
                            <a href="" class="clr_primary">luxurious yacht,</a> rent
                            high-performance <a href="" class="clr_primary">sports cars</a> for an
                            exhilarating drive, or embark on an unforgettable
                            <a href="{{route('desert-safari')}}" class="clr_primary">desert safari,</a> we
                            have it all covered. Immerse yourself in the lap of luxury and
                            experience the thrill of our diverse offerings.
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

    <script>
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
@endsection
