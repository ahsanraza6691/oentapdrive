@extends('frontend.layouts.header')
@section('title', 'Car With Driver')
@section('content')



    <style>

    </style>


    <div class="car_details_wrapper">
        {{-- <div class="content_wrap">
            <nav>
                <ol class="cd-breadcrumb">
                    <li><a href="/" class="fa fa-home"></a></li>
                    <li><a href="#0">Dubai</a></li>
                    <li><a href="#0">car brand</a></li>
                    <li class="current"><span>By brand / by Vehicle type</span></li>
                </ol>
            </nav>
        </div> --}}
        <section>
            <div class="content_wrap">
                <h1 class="mb-5">Rent {{ $details->get_brand_name->brand_name ?? '' }} {{ $details->model_name ?? '' }}
                    {{ $details->make_year ?? '' }} in {{ $details->get_user->city ?? '' }}</h1>
                <div class="row">
                    <div class="col-lg-9 detail_area">
                        <div class="car_details_header">
                            <div>
                                <div class="styled_badge sm success"></div> <span>Minimum {{ $details->days ?? '' }} day(s)
                                    rental</span>
                            </div>
                            @if (!empty($details->delivery_days))
                                <div>
                                    <div class="styled_badge sm success"></div> <span>
                                        Delivery : {{ $details->delivery_days ?? '' }}</span>
                                </div>
                            @endif
                            <div>
                                <div class="styled_badge sm success"></div> <span>Insurance included</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 car_details_carousel">
                                <div class="favorite flex_center w-100">
                                    {{-- <button class="styled_button rounded_sm wishlist-button">
                                    <i class="fa fa-heart red_heart"></i>
                                </button> --}}

                                <div class=" me-auto ms-4">
                                    @if (!empty($details->registration_card))
                                    <button class=" px-2 py-1 rounded fs_13">
                                        <i class="fa fa-check fs_13"></i> Verified
                                    </button>
                                    @endif
                                    @if ($details->is_featured == 1)
                                    <button class="ms-1 px-2 py-1 rounded bg-dark text-light fs_13">
                                        <i class="fa fa-star fs_13 mb-1 text-light"></i> Premium
                                    </button>
                                    @endif
                                </div>

                                    @if (Auth::check())
                                        @php
                                            $wishlistProduct = Auth::user()
                                                ->wishlist()
                                                ->where('product_id', $details->id)
                                                ->first();
                                        @endphp
                                        @if ($wishlistProduct)
                                            <button class="styled_button rounded_sm wishlist-button"
                                                data-product-id="{{ $details->id }}">
                                                <i class="fa fa-heart red_heart"></i>
                                            </button>
                                        @else
                                            <button class="styled_button rounded_sm wishlist-button"
                                                data-product-id="{{ $details->id }}">
                                                <i class="fa fa-heart"></i>
                                            </button>
                                        @endif
                                    @else
                                        <button class="styled_button rounded_sm wishlist-button"
                                            data-product-id="{{ $details->id }}">
                                            <i class="fa fa-heart"></i>
                                        </button>
                                    @endif
                                </div>
                                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                                    class="swiper mySwiper2">
                                    <div class="swiper-wrapper">
                                        {{-- <div class="swiper-slide">
                                            <img
                                                src="https://www.oneclickdrive.com/car-for-rent/slider-desktop/Peugeot_3008_2022-1%20(3)_small.jpg?vers=7.6" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img
                                                src="https://www.oneclickdrive.com/car-for-rent/slider-desktop/Peugeot_3008_2022-1%20(3)_small.jpg?vers=7.6" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img
                                                src="https://www.oneclickdrive.com/car-for-rent/slider-desktop/Peugeot_3008_2022-1%20(3)_small.jpg?vers=7.6" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img
                                                src="https://www.oneclickdrive.com/car-for-rent/slider-desktop/Peugeot_3008_2022-1%20(3)_small.jpg?vers=7.6" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img
                                                src="https://www.oneclickdrive.com/car-for-rent/slider-desktop/Peugeot_3008_2022-1%20(3)_small.jpg?vers=7.6" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img
                                                src="https://www.oneclickdrive.com/car-for-rent/slider-desktop/Peugeot_3008_2022-1%20(3)_small.jpg?vers=7.6" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img
                                                src="https://www.oneclickdrive.com/car-for-rent/slider-desktop/Peugeot_3008_2022-1%20(3)_small.jpg?vers=7.6" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img
                                                src="https://www.oneclickdrive.com/car-for-rent/slider-desktop/Peugeot_3008_2022-1%20(3)_small.jpg?vers=7.6" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img
                                                src="https://www.oneclickdrive.com/car-for-rent/slider-desktop/Peugeot_3008_2022-1%20(3)_small.jpg?vers=7.6" />
                                        </div> --}}
                                        @foreach (json_decode($details->get_images) as $key => $prouct_image)
                                            <div class="swiper-slide">
                                                <img src="{{ asset('images/') }}/{{ $prouct_image->images }}" />
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                                <div thumbsSlider="" class="swiper mySwiper">
                                    <div class="swiper-wrapper">
                                        {{-- <div class="swiper-slide">
                                            <img
                                                src="https://www.oneclickdrive.com/car-for-rent/slider-desktop/Peugeot_3008_2022-1%20(3)_small.jpg?vers=7.6" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img
                                                src="https://www.oneclickdrive.com/car-for-rent/slider-desktop/Peugeot_3008_2022-1%20(3)_small.jpg?vers=7.6" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img
                                                src="https://www.oneclickdrive.com/car-for-rent/slider-desktop/Peugeot_3008_2022-1%20(3)_small.jpg?vers=7.6" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img
                                                src="https://www.oneclickdrive.com/car-for-rent/slider-desktop/Peugeot_3008_2022-1%20(3)_small.jpg?vers=7.6" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img
                                                src="https://www.oneclickdrive.com/car-for-rent/slider-desktop/Peugeot_3008_2022-1%20(3)_small.jpg?vers=7.6" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img
                                                src="https://www.oneclickdrive.com/car-for-rent/slider-desktop/Peugeot_3008_2022-1%20(3)_small.jpg?vers=7.6" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img
                                                src="https://www.oneclickdrive.com/car-for-rent/slider-desktop/Peugeot_3008_2022-1%20(3)_small.jpg?vers=7.6" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img
                                                src="https://www.oneclickdrive.com/car-for-rent/slider-desktop/Peugeot_3008_2022-1%20(3)_small.jpg?vers=7.6" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img
                                                src="https://www.oneclickdrive.com/car-for-rent/slider-desktop/Peugeot_3008_2022-1%20(3)_small.jpg?vers=7.6" />
                                        </div> --}}
                                        @foreach (json_decode($details->get_images) as $key => $prouct_image)
                                            <div class="swiper-slide">
                                                <img src="{{ asset('images/') }}/{{ $prouct_image->images }}" />
                                            </div>
                                        @endforeach
                                        {{-- <div class="swiper-slide">
                                            <img
                                                src="https://www.oneclickdrive.com/car-for-rent/slider-desktop/Peugeot_3008_2022-1%20(3)_small.jpg?vers=7.6" />
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 p-md-4 p-0">
                                <div class="car_details_box p-3">
                                    <div class="mb-4">
                                        <h3 class="text-light">Pricing</h3>
                                        <div class="styled_divider dashed"></div>
                                        <div class="styled_table">
                                            <div class="t_row">
                                                <div class="t_cols">Rental Period</div>
                                                <div class="t_cols">Mileage Limit</div>
                                                <div class="t_cols">Rental Cost</div>
                                            </div>
                                            <div class="t_row">
                                                <div class="t_cols">Day-basis</div>
                                                <div class="t_cols">{{ $details->per_day_mileage ?? '' }} km</div>
                                                <div class="t_cols">AED {{ $details->price_per_day ?? '' }}</div>
                                            </div>
                                            <div class="t_row">
                                                <div class="t_cols">Weekly</div>
                                                <div class="t_cols">{{ $details->weekly_mileage ?? '' }} km</div>
                                                <div class="t_cols">AED {{ $details->weekly_rent ?? '' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    @if (!empty($details->get_mileage))
                                        @if (count($details->get_mileage) > 0)
                                            <h3 class="text-light">Monthly Pricing</h3>
                                            <div class="styled_divider dashed"></div>

                                            <div class="styled_table">
                                                <div class="t_row">
                                                    <div class="t_cols">
                                                        <select
                                                            class="fomcntrl monthselect m-l-10 price_select mileagesdata"
                                                            id="mileageslt">
                                                            <option value="">Mileage</option>
                                                            @foreach ($details->get_mileage as $mileage)
                                                                @if (
                                                                    !is_null($mileage->one_month) ||
                                                                        !is_null($mileage->three_months) ||
                                                                        !is_null($mileage->nine_months) ||
                                                                        !is_null($mileage->twelve_months))
                                                                    <option value="{{ $mileage->id }}">
                                                                        {{ $mileage->mileage }} km</option>
                                                                @endif
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    <div class="t_cols">
                                                        <select class="monthselect" id="months">
                                                            <option class="">Months</option>
                                                        </select>
                                                    </div>
                                                    <div class="t_cols" id="price">

                                                        <select class="monthselect" id="pricemonth">
                                                            <option class="">AED</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <h3 class="mt-2 text-light">Monthly Pricing</h3>
                                            <div class="styled_table mt-1">
                                                <div class="t_row">
                                                    <div class="t_cols">N/A.</div>
                                                    <div class="t_cols">N/A.</div>
                                                    <div class="t_cols">N/A.</div>
                                                </div>

                                            </div>
                                        @endif
                                </div>
                                @endif
                            </div>

                            {{-- @foreach ($details->get_mileage as $mileage)
                        <div class="t_row">
                            <div class="t_cols">
                                <select class="fomcntrl monthselect m-l-10" id="mileageslt">
                                    <option value="{{ $mileage->mileage }}">{{ $mileage->mileage }} km</option>
                                </select>
                            </div>
                            <div class="t_cols">{{ $mileage->mileage }} km</div>
                            <div class="t_cols">
                                <del>AED {{ $mileage->one_month }}</del> /
                                AED {{ $mileage->three_months }}
                            </div>
                        </div>
                    @endforeach --}}
                            <div class="row mt-5">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4 class="fw-bold">Car Specs</h4>
                                            <div class="styled_divider solid">

                                            </div>
                                            <div class="car_details_specs row">
                                                <div class="specs col-md-6">

                                                    <img src="{{ asset('icons/car-doors.svg') }}" alt="">
                                                    <span>{{ $details->car_doors }} Doors</span>
                                                </div>
                                                <div class="specs col-md-6">
                                                    <img src="{{ asset('icons/seat.svg') }}" alt=""> <span>Fits
                                                        {{ $details->passengers }} Passengers
                                                    </span>
                                                </div>
                                                <div class="specs col-md-6">
                                                    <img src="{{ asset('icons/Bag.svg') }}" alt=""> <span>Fits
                                                        {{ $details->bags }} Bag(s) </span>
                                                </div>
                                                <div class="specs col-md-6">
                                                    <img src="{{ asset('icons/gcc-specs.svg') }}" alt=""> <span>
                                                        Specs : {{ $details->specs }} </span>
                                                </div>
                                                <div class="specs col-md-6">
                                                    <img src="{{ asset('icons/fuel-petrol.svg') }}" alt="">
                                                    <span>
                                                        Fuel Type : {{ $details->fuel_type }} </span>
                                                </div>
                                                <div class="specs col-md-6">
                                                    <img src="{{ asset('icons/car-doors.svg') }}" alt=""> <span>
                                                        {{ $details->transmission }} Transmission
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-lg-12">
                                            <h4 class="fw-bold mt-5">Car Features</h4>
                                            <div class="styled_divider solid">

                                            </div>
                                            @php
                                                $carFeatures = explode(',', $details->car_features);
                                            @endphp
                                            <div class="row">
                                                {{-- @foreach ($carFeatures as $features) --}}

                                                {{-- <img src="https://www.oneclickdrive.com/application/views/images/feature-icons/Bag.svg?vers=7.6"
                                        alt=""> <span>{{ $features }}</span> --}}
                                                @foreach ($carFeatures as $index => $features)
                                                    @if ($index >= 8)
                                                    @break
                                                @endif

                                                <div class="specs col-md-6">
                                                    <div>
                                                        @if ($features == '3D Surround Camera')
                                                            <img width="22px" src="{{ asset('icons/arrows.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Memory Front Seats')
                                                            <img width="22px" src="{{ asset('icons/save.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Parking Assist')
                                                            <img width="22px"
                                                                src="{{ asset('icons/plus-square-o.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Temperature Controlled Seats')
                                                            <img width="22px"
                                                                src="{{ asset('icons/cooling-seats.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Built-in-GPS')
                                                            <img width="22px"
                                                                src="{{ asset('icons/location-arrow.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Parking Sensors')
                                                            <img width="22px"
                                                                src="{{ asset('icons/parking-sensors.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Steering Assist')
                                                            <img width="22px"
                                                                src="{{ asset('icons/caret-square-o-up.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Day-time Runing Lights')
                                                            <img width="22px" src="{{ asset('icons/sun-o.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'LCD Screens')
                                                            <img width="22px"
                                                                src="{{ asset('icons/lcd-screens.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'SRS Airbags')
                                                            <img width="22px"
                                                                src="{{ asset('icons/srs-airbags.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Front Air Bags')
                                                            <img width="22px"
                                                                src="{{ asset('icons/air-bags.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'USB')
                                                            <img width="22px" src="{{ asset('icons/usb.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Apple CarPlay')
                                                            <img width="22px" src="{{ asset('icons/apple.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'FM-Radio')
                                                            <img width="22px"
                                                                src="{{ asset('icons/podcast.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Power Seats')
                                                            <img width="22px"
                                                                src="{{ asset('icons/power-seats.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Power Mirrors')
                                                            <img width="22px"
                                                                src="{{ asset('icons/power-mirrors.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Touchscreen LCD')
                                                            <img width="22px"
                                                                src="{{ asset('icons/hand-o-up.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Seat Belt Reminder')
                                                            <img width="22px"
                                                                src="{{ asset('icons/warning.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Power Door Locks')
                                                            <img width="22px"
                                                                src="{{ asset('icons/door-locks.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Power Windows')
                                                            <img width="22px"
                                                                src="{{ asset('icons/power-windows.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Rear AC')
                                                            <img width="22px"
                                                                src="{{ asset('icons/rear-ac.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Premium Audio')
                                                            <img width="22px"
                                                                src="{{ asset('icons/bullseye.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Fabric Seats')
                                                            <img width="22px"
                                                                src="{{ asset('icons/fabric-seats.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Bluetooth')
                                                            <img width="22px"
                                                                src="{{ asset('icons/bluetooth.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Fog-Lights')
                                                            <img width="22px"
                                                                src="{{ asset('icons/fog-lights.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Adaptive Cruise Control')
                                                            <img width="22px"
                                                                src="{{ asset('icons/lease-find-cars.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Massaging Seats')
                                                            <img width="22px"
                                                                src="{{ asset('icons/align-center.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Sliding Doors')
                                                            <img width="22px"
                                                                src="{{ asset('icons/sliding-doors.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Foldable Armrest')
                                                            <img width="22px"
                                                                src="{{ asset('icons/columns.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Android Auto')
                                                            <img width="22px"
                                                                src="{{ asset('icons/android.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Detachable Roof')
                                                            <img width="22px" src="{{ asset('icons/ticket.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Butterfly Doors')
                                                            <img width="22px"
                                                                src="{{ asset('icons/butterfly-doors.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Stereo MP3 / Cd')
                                                            <img width="22px" src="{{ asset('icons/music.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Paddle Shift(Triptronic)')
                                                            <img width="22px"
                                                                src="{{ asset('icons/hand-lizard-o.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Push Button Ignition')
                                                            <img width="22px"
                                                                src="{{ asset('icons/push-button-start.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Powered Tailgate')
                                                            <img width="22px"
                                                                src="{{ asset('icons/toggle-up.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Chiller Freezer')
                                                            <img width="22px"
                                                                src="{{ asset('icons/spinner.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Air Suspension')
                                                            <img width="22px"
                                                                src="{{ asset('icons/navicon.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Sunroof/Moonroof')
                                                            <img width="22px"
                                                                src="{{ asset('icons/sunroof-car-moon-roof.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Reverse Camera')
                                                            <img width="22px"
                                                                src="{{ asset('icons/rear-camera-parking.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Digital HUD')
                                                            <img width="22px"
                                                                src="{{ asset('icons/digital-display.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Alloy Wheels')
                                                            <img width="22px"
                                                                src="{{ asset('icons/alloy-wheels.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Blind Spot Warning')
                                                            <img width="22px"
                                                                src="{{ asset('icons/blind-spot-mirror.svg') }}"
                                                                alt="">
                                                        @endif
                                                        @if ($features == 'Climate Control')
                                                            <img width="22px"
                                                                src="{{ asset('icons/climate-control.svg') }}"
                                                                alt="">
                                                        @endif
                                                        {{-- @if ($features == 'Climate Control')
                                                    <img width="22px" src="{{asset('icons/climate-control.svg')}}" alt="">
                                                    @endif --}}
                                                        @if ($features == 'Tail Lift')
                                                            <img width="22px"
                                                                src="{{ asset('icons/toggle-up.svg') }}"
                                                                alt="">
                                                        @endif{{ $features }}
                                                    </div>
                                                </div>
                                            @endforeach
                                            {{-- <div class="specs col-md-6">
                                                <div>
                                                    <img src="https://www.oneclickdrive.com/application/views/images/feature-icons/Bag.svg?vers=7.6"
                                                        alt="">Digital HUD
                                                </div>
                                            </div>
                                            <div class="specs col-md-6">
                                                <div>
                                                    <img src="https://www.oneclickdrive.com/application/views/images/feature-icons/Bag.svg?vers=7.6"
                                                        alt="">Digital HUD
                                                </div>
                                            </div>
                                            <div class="specs col-md-6">
                                                <div>
                                                    <img src="https://www.oneclickdrive.com/application/views/images/feature-icons/Bag.svg?vers=7.6"
                                                        alt="">Digital HUD
                                                </div>
                                            </div>
                                            <div class="specs col-md-6">
                                                <div>
                                                    <img src="https://www.oneclickdrive.com/application/views/images/feature-icons/Bag.svg?vers=7.6"
                                                        alt="">Digital HUD
                                                </div>
                                            </div>
                                            <div class="specs col-md-6">
                                                <div>
                                                    <img src="https://www.oneclickdrive.com/application/views/images/feature-icons/Bag.svg?vers=7.6"
                                                        alt="">Digital HUD
                                                </div>
                                            </div>
                                            <div class="specs col-md-6">
                                                <div>
                                                    <img src="https://www.oneclickdrive.com/application/views/images/feature-icons/Bag.svg?vers=7.6"
                                                        alt="">Digital HUD
                                                </div>
                                            </div>
                                            <div class="specs col-md-6">
                                                <div>
                                                    <img src="https://www.oneclickdrive.com/application/views/images/feature-icons/Bag.svg?vers=7.6"
                                                        alt="">Digital HUD
                                                </div>
                                            </div> --}}
                                            <button class="styled_button animate_width w-auto mt-3 morefeatures"
                                                data-bs-toggle="modal" data-bs-target="#features">View More <i
                                                    class="fa-solid fa-angle-right"></i></button>
                                            {{-- @endforeach --}}
                                        </div>
                                        {{-- <div class="specs">
                                            <img src="https://www.oneclickdrive.com/application/views/images/feature-icons/Bag.svg?vers=7.6"
                                                alt=""> <span>SUV</span>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h3>Rental Include</h3>
                                    <div class="styled_divider solid"></div>
                                    <div class="rental_details">
                                        <div>
                                            <p>Insurance</p>
                                        </div>
                                        <div>
                                            <p>Basic Comprehensive</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <h3>Extras</h3>
                                    <div class="styled_divider solid"></div>
                                    <div class="rental_details">
                                        <div>
                                            <p>Car Color</p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <p>Interior Color : </p>

                                            @php
                                                $interiorColors = explode(',', $details->interior_color);
                                            @endphp

                                            @foreach ($interiorColors as $colorData)
                                                @php
                                                    // Split the color data into name and code
                                                    [$colorName, $colorCode] = explode(':', $colorData);
                                                @endphp

                                                <div class="color_box" style="background-color: {{ $colorCode }}">
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <p>Exterior Color : </p>

                                            @php
                                                $exteriorColors = explode(',', $details->exterior_color);
                                            @endphp

                                            @foreach ($exteriorColors as $extcolorData)
                                                @php
                                                    // Split the color data into name and code
                                                    [$colorName, $colorCode] = explode(':', $extcolorData);
                                                @endphp

                                                <div class="color_box" style="background-color: {{ $colorCode }}">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="rental_details">
                                        <div>
                                            <p>CDW Insurance</p>
                                        </div>
                                        <div>
                                            <p>AED {{ $details->insurance_per_day ?? '' }} / month
                                            </p>
                                        </div>
                                    </div>
                                    <div class="rental_details">
                                        <div>
                                            <p>Additional mileage charge
                                            </p>
                                        </div>
                                        <div>
                                            <p>AED {{ $details->monthly_extra }} / km</p>
                                        </div>
                                    </div>
                                    <div class="rental_details">
                                        <div>
                                            <p> Salik / Toll Charges</p>
                                        </div>
                                        <div>
                                            <p>AED 5</p>
                                        </div>
                                    </div>
                                    <div class="rental_details">
                                        <div>
                                            <p>Excess Claim</p>
                                        </div>
                                        <div>
                                            <p>AED 1500 </p>
                                        </div>
                                    </div>
                                    <div class="rental_details">
                                        <div>
                                            <p>Additional driver insurance</p>
                                        </div>
                                        <div>
                                            <p>AED 100</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <h3>Requirements</h3>
                                    <div class="styled_divider solid"></div>
                                    <div class="rental_details">
                                        <div>
                                            <p>
                                                Minimum Driverâ€™s Age
                                            </p>
                                        </div>
                                        <div>
                                            <p>22 years
                                            </p>
                                        </div>
                                    </div>
                                    <div class="rental_details">
                                        <div>
                                            <p>
                                                Security Deposit

                                            </p>
                                        </div>
                                        <div>
                                            <p>AED {{ $details->security_deposit ?? '' }}</p>
                                        </div>
                                    </div>
                                    <div class="rental_details">
                                        <div>
                                            <p>Refunded in</p>
                                        </div>
                                        <div>
                                            <p>30 days</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex_center">
                                    <button class="styled_button animate_width">

                                        Documents required
                                    </button>
                                </div>

                            </div>
                            <div class="col-lg-12 mt-5">
                                <h2> 2022 Peugeot 3008 Rental in Dubai</h2>
                                <p>
                                    Rent and drive this Peugeot 3008 2022-model in Dubai, UAE for AED 170/day & AED
                                    3000/month. Rental cost includes basic comprehensive insurance and standard mileage
                                    limit of 250 km/day (AED 0.3 per additional km applicable). Security deposit of AED
                                    1000
                                    is required. Contact Al Emad Rent a Car directly for bookings and inquiries...

                                </p>
                                <h2>Why hire the Peugeot 3008?
                                </h2>
                                <p>
                                    The Peugeot 3008 SUV is listed by Al Emad Rent a Car. This 5-door SUV fits 5
                                    passengers
                                    and 2 medium-sized bag(s).

                                </p>
                                <p>
                                    Features include Parking Assist, Reverse Camera, Parking Sensors, Push Button
                                    Ignition
                                    and more.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="listed_by mb-4">
                        <h3 class="clr_primary text-center">
                            Listed by
                        </h3>
                        @php
                            $currenturl = URL::current();
                        @endphp


                        <a href="{{ route('company-profile', ['slug' => $details->get_user->slug]) }}"><img src="{{ asset('company_logo/' . $details->get_user->company_logo) }}" alt=""></a>
                        <div class="mt-3 d-flex">
                            <div>
                            @if (Auth::user())

                                <a href="tel:+{{ $details->get_user->contact ?? '' }}" class="phonelead" id="phoneshare"
                                    data-id="{{ $details->id }}" company-id="{{ $details->get_user->id }}">
                                    <button class="yellow_btn d-flex" id="my_wp">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <svg class="mr-auto d-block" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 512 512" fill="#fff" width="25"
                                                    class="p-2" height="25">
                                                    <path
                                                        d="M511.2 387l-23.25 100.8c-3.266 14.25-15.79 24.22-30.46 24.22C205.2 512 0 306.8 0 54.5c0-14.66 9.969-27.2 24.22-30.45l100.8-23.25C139.7-2.602 154.7 5.018 160.8 18.92l46.52 108.5c5.438 12.78 1.77 27.67-8.98 36.45L144.5 207.1c33.98 69.22 90.26 125.5 159.5 159.5l44.08-53.8c8.688-10.78 23.69-14.51 36.47-8.975l108.5 46.51C506.1 357.2 514.6 372.4 511.2 387z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div>
                                                <span class="d-none numm text-light" id="my_wp_num"
                                                    style="overflow: hidden">
                                                    &nbsp; {{ $details->get_user->contact ?? '' }}
                                                </span>
                                            </div>
                                        </div>
                                    </button>
                                </a>

                                @else

                                
                                <a href="javascript:void(0)" class="phonelead"   data-bs-toggle="modal" data-bs-target="#login">
                                    <button class="yellow_btn d-flex" id="my_wp">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <svg class="mr-auto d-block" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 512 512" fill="#fff" width="25"
                                                    class="p-2" height="25">
                                                    <path
                                                        d="M511.2 387l-23.25 100.8c-3.266 14.25-15.79 24.22-30.46 24.22C205.2 512 0 306.8 0 54.5c0-14.66 9.969-27.2 24.22-30.45l100.8-23.25C139.7-2.602 154.7 5.018 160.8 18.92l46.52 108.5c5.438 12.78 1.77 27.67-8.98 36.45L144.5 207.1c33.98 69.22 90.26 125.5 159.5 159.5l44.08-53.8c8.688-10.78 23.69-14.51 36.47-8.975l108.5 46.51C506.1 357.2 514.6 372.4 511.2 387z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div>
                                                <span class="d-none numm text-light" id="my_wp_num"
                                                    style="overflow: hidden">
                                                    &nbsp; 00000000
                                                </span>
                                            </div>
                                        </div>
                                    </button>
                                </a>

                                @endif
                            </div>
                            {{-- <a href="{{$details->get_user->whatsapp_number ?? ''}}"><span><i class="fab fa-whatsapp"></i></span></a> --}}
                            @if (Auth::user())

                            <a id="getValueButton" href="https://api.whatsapp.com/send?text=<?php echo $currenturl; ?>"
                                class="socialShareLink" target="_blank" data-action="share/whatsapp/share">
                                <input type="hidden" id="myHiddenInput" value="My Hidden Value">

                                <div class="ms-1">
                                    <button class="wp_btn d-flex" id="my_wp1">
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
                                                <span class="d-none numm1 text-light" id="my_wp_num1"
                                                    style="overflow: hidden">
                                                    &nbsp; {{ $details->get_user->contact }}
                                                </span>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </a>
                            
                            @else

                            <a id="getValueButton"   href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#login"
                                class="socialShareLink" target="_blank" data-action="share/whatsapp/share">
                                <input type="hidden" id="myHiddenInput" value="My Hidden Value">

                                <div class="ms-1">
                                    <button class="wp_btn d-flex" id="my_wp1">
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
                                                <span class="d-none numm1 text-light" id="my_wp_num1"
                                                    style="overflow: hidden">
                                                    &nbsp; 000000
                                                </span>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </a>

                            @endif
                            
                            {{-- <input type="text" value="<?php echo $currenturl; ?>" id="myProductUrl"
                                class="socialShareLink" style="display:none;"> --}}
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
                    <div class="pickup_service_card">
                        <h3>Delivery & Pick-Up Services</h3>

                        <div class="row mt-3">
                            <div class="col-md-12 m-t-10 opntimbx">
                                <div class="roww align-items-center m-0 opntimbtn" id="open_drop"
                                    onclick="openDropdown()">
                                    <div class="d-flex align-items-center justify-content-around">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                                fill="#FF581B" class="bi bi-clock-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z">
                                                </path>
                                            </svg>
                                        </div>
                                        {{-- <div>
                                            <span class="openc m-l-10"
                                                title="Friends Car Rental is currently open"></span>
                                        </div> --}}
                                    @php
                                        $currentDay = ucfirst(date('l'));
                                        $currentTime = date('H:i:s');
                                    @endphp


                                    @if(!empty($shop_timings))
                                    @foreach ($shop_timings as $time)
                                    @if($time['day_of_week'] == $currentDay)
                                    @if($time['opening_time'] == $time['closing_time'])
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
                                    @else
                                    <span title="See shop timings" > Shop Timings not updated
                                    </span>
                                    @endif
                                        <div>
                                            <i class="opntimaro" id="dwn-aro-web" title="See shop timings">
                                                <svg width="20" height="20" viewBox="0 0 20 20"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M7.06408 15.872L12.9359 10.0002L7.06408 4.12842"
                                                        stroke="#FF581B" stroke-width="1.5"></path>
                                                </svg>
                                            </i>
                                        </div>
                                    </div>
                                </div>
                                <div class="open-time" style="display:none;">
                                    <table class="time_details">
                                        @php
                                             $currentDay = ucfirst(date('l'));
                                        @endphp
                                        <tbody>
                                            @foreach ($shop_timings as $time)
                                         @if($time['day_of_week'] == $currentDay)

                                        <tr style="font-weight:bold;">
                                            <td>{{$time['day_of_week']}}</td>
                                            <td>@if ($time['opening_time'] == $time['closing_time'])
                                                Open 24 Hours
                                            @else
                                                {{ date('g:i A', strtotime($time['opening_time'])) }}
                                                &mdash;
                                                {{ date('g:i A', strtotime($time['closing_time'])) }}
                                            @endif</td>
                                        </tr>
                                        @else
                                            <tr>
                                                <td>{{ $time['day_of_week'] }}</td>
                                                <td>
                                                    @if ($time['opening_time'] == $time['closing_time'])
                                                        Open 24 Hours
                                                    @else
                                                        {{ date('g:i A', strtotime($time['opening_time'])) }}
                                                        &mdash;
                                                        {{ date('g:i A', strtotime($time['closing_time'])) }}
                                                    @endif
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="styled_divider solid"></div>
                        <div class="services">
                            <div class="services_items">
                                <img src="https://www.oneclickdrive.com/assets/img/branch-o.svg?v1" alt="">
                                <span>Branch Pick-up</span>
                            </div>
                            <div class="services_items">
                                <img src="https://www.oneclickdrive.com/assets/img/delivery-o.svg?v1" alt="">
                                <span>Delivery to You</span>
                            </div>
                            <div class="services_items">
                                <img src="https://www.oneclickdrive.com/assets/img/airport-o.svg?v1" alt="">
                                <span>Airport Delivery</span>
                            </div>
                        </div>
                        <div class="styled_divider solid"></div>
                        <h3>Address</h3>
                        <iframe src="{{ $details->get_user->google_map ?? '' }}" width="100%" height="200px"
                            frameborder="0" style="border: 0" allowfullscreen></iframe>
                        <h3 class="py-3">
                            <i class="fa fa-map-marker"></i> {{ $details->get_user->address ?? '' }}
                        </h3>
                    </div>
                    <div class="py-5 flex_center">
                        <button class="styled_button animate_width">
                            About {{ $details->get_user->company_name ?? '' }} Rent a Car
                        </button>
                    </div>
                    <div class="styled_tag_box mb-4">
                        <div class="tag_wrap">
                            <h3>Branch Location(s)</h3>
                            <div class="styled_divider solid"></div>
                            <div class="tags">
                                <div class="">
                                    <div class="cotnt">
                                        <a class="bttn bttn-default bttn-normal text-dark" href="javascript:void(0);"
                                            title="Find cars to rent in Downtown Dubai">
                                           {{$details->get_user->city ?? ''}}</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tag_wrap">
                            <h3>Fast Delivery Location(s)</h3>
                            <div class="styled_divider solid"></div>
                            <div class="tags">
                                @php
                                    $locations = explode(',', $details->get_user->fast_delivery_locations); // Split locations by commas into an array
                                @endphp
                                    <div class="cotnt">
                                        @foreach ($locations as $location)

                                        <a class="bttn bttn-default bttn-normal text-dark" href="javascript:void(0);"
                                            title="Find cars to rent in Downtown Dubai">
                                            {{$location}}</a>
                                        @endforeach
                                    </div>
                            </div>

                        </div>
                        <div class="tag_wrap">
                            <h3>Payment Modes</h3>
                            <div class="styled_divider solid"></div>
                            <div class="tags">
                                @php
                                    $payments = explode(',', $details->get_user->payment_modes); // Split locations by commas into an array
                                @endphp
                                    <div class="cotnt">
                                        @foreach ($payments as $payment)
                                        <a class="bttn bttn-default bttn-normal text-dark" href="javascript:void(0);"
                                            title="Find cars to rent in Downtown Dubai">
                                            {{$payment}}</a>
                                        @endforeach

                                    </div>
                            </div>

                        </div>
                    </div>
                    {{-- <div class="styled_listed_in mb-4">
                        <h3>Listed in</h3>
                        <div class="styled_divider solid"></div>
                        <div class="listed_item">
                            <span>SUV Car Rentals in Dubai</span>
                        </div>
                    </div>
                    <div class="styled_rating_card">
                        <div class="rating_wrap">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>

                        <p> 5 of 5 Author Rating</p>
                        <p>Based on 412 reviews</p>
                        <p>for Peugeot 3008 2022</p>


                    </div> --}}

                </div>

            </div>
    </section>
    <section>
        <div class="content_wrap">
            <div class="section_heading">
                <h1 class="reveal fade_bottom">Similar Car Rental Options</h1>
                <a href="{{route('services')}}"><button class="styled_button animate_width">View All</button></a>
            </div>
            <div class="space_y">
                <p class="reveal fade_bottom">
                    Drive in style! Make your first car rental a great experience with
                    luxury rental vehicles from top brands such as Rolls Royce, BMW,
                    Land Rover, among others.
                </p>
            </div>
            <div class="reveal fade_bottom">

                <div class="owl-carousel owl_four_items owl-theme">
                    @foreach ($related_products as $related)

                    <div class="item">
                        <div class="styled_vehicle_card m_10 pointer ">
                            <a href="{{ route('car-details', ['id' => $related->id, 'slug' => $related->slug]) }}">

                            <img class="vehicle_image mb_10"
                                src="{{asset('images')}}/{{$related->get_images[0]->images}}"
                                alt="" />
                            </a>
                            <div class="favorite flex_center">
                                @if (Auth::check())
                                @php
                                    $wishlistProduct = Auth::user()
                                        ->wishlist()
                                        ->where('product_id', $related->id)
                                        ->first();
                                @endphp
                                @if ($wishlistProduct)
                                    <button class="styled_button rounded_sm wishlist-button"
                                        data-product-id="{{ $related->id }}">
                                        <i class="fa fa-heart red_heart"></i>
                                    </button>
                                @else
                                    <button class="styled_button rounded_sm wishlist-button"
                                        data-product-id="{{ $related->id }}">
                                        <i class="fa fa-heart"></i>
                                    </button>
                                @endif
                            @else
                                <button class="styled_button rounded_sm wishlist-button"
                                    data-product-id="{{ $related->id }}">
                                    <i class="fa fa-heart"></i>
                                </button>
                            @endif
                            </div>
                            <a href="{{ route('car-details', ['id' => $related->id, 'slug' => $related->slug]) }}">

                            <div class="content_section">
                                <h2 class="title clr_secondary"> {{ $related->get_brand_name->brand_name ?? '' }} {{ $related->model_name ?? '' }}
                                    {{ $related->make_year ?? '' }}</h2>
                                    <div class="car_rental_details">
                                        <p class="reveal fade_bottom">
                                            <span class="font_semi_bold clr_secondary">AED
                                                {{ $related->price_per_day ?? '' }}</span>/
                                            <span class="font_semi_bold">Day</span>
                                            <span>{{ $related->per_day_mileage }} km</span>
                                        </p>

                                        @php
                                        $minMileage = null;
                                    @endphp
                                    @foreach ($related->get_mileage as $mileage)
                                        @php
                                            $mileageValues = [$mileage->one_month, $mileage->three_months, $mileage->six_months, $mileage->nine_months, $mileage->twelve_months];
                                            $nonNullMileageValues = array_filter($mileageValues, fn($v) => !is_null($v));

                                            if (!empty($nonNullMileageValues)) {
                                                $currentMinMileage = min($nonNullMileageValues);
                                                if ($minMileage === null || $currentMinMileage < $minMileage) {
                                                    $minMileage = $currentMinMileage;
                                                }
                                            }
                                        @endphp
                                    @endforeach
                                    @if ($minMileage !== null)

                                        <p class="reveal fade_bottom">
                                            <span class="font_semi_bold clr_secondary">AED {{ $minMileage }}</span> /
                                            <span class="font_semi_bold">Month</span>
                                            <span>250km</span>

                                        </p>
                                        @else
                                        <p class="reveal fade_bottom">
                                            <span class="font_semi_bold clr_secondary">AED {{ $related->weekly_rent }}</span> /
                                            <span class="font_semi_bold">Week</span>
                                            <span>{{ $related->weekly_mileage }} km</span>

                                        </p>
                                        @endif

                                    </div>
                                    <div class="other_details">
                                        <div class="right_details_area">
                                            <p class="">{{ $related->days }} day rental available</p>
                                            <p class="">Deposit: AED {{ $related->security_deposit ?? '' }}</p>
                                            @if (!empty($related->insurance_per_day))
                                                <p class="">Insurance Included</p>
                                            @endif
                                        </div>
                                    </div>
                                <div class="tags">
                                    <span>{{$related->category}}</span><span>{{ $related->car_doors ?? '' }}
                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                            viewBox="0 0 512 512" height="1em" width="1em"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M149.6 41L42.88 254.4c23.8 24.3 53.54 58.8 78.42 97.4 24.5 38.1 44.1 79.7 47.1 119.2h270.3L423.3 41H149.6zM164 64h230l8 192H74l90-192zm86.8 17.99l-141 154.81L339.3 81.99h-88.5zM336 279h64v18h-64v-18z">
                                            </path>
                                        </svg>
                                    </span>
                                    <span>{{ $related->passengers ?? '' }}
                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                            viewBox="0 0 24 24" height="1em" width="1em"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill="none" d="M0 0h24v24H0V0z"></path>
                                            <path
                                                d="M15 5v7H9V5h6m0-2H9c-1.1 0-2 .9-2 2v9h10V5c0-1.1-.9-2-2-2zm7 7h-3v3h3v-3zM5 10H2v3h3v-3zm15 5H4v6h2v-4h12v4h2v-6z">
                                            </path>
                                        </svg>
                                    </span>
                                    <span>{{ $related->bags ?? '' }}
                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                            viewBox="0 0 24 24" height="1em" width="1em"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill="none" d="M0 0h24v24H0z"></path>
                                            <path
                                                d="M17 6h-2V3c0-.55-.45-1-1-1h-4c-.55 0-1 .45-1 1v3H7c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2 0 .55.45 1 1 1s1-.45 1-1h6c0 .55.45 1 1 1s1-.45 1-1c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zM9.5 18H8V9h1.5v9zm3.25 0h-1.5V9h1.5v9zm.75-12h-3V3.5h3V6zM16 18h-1.5V9H16v9z">
                                            </path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="left_details_area">
                                    <div class="styled_badge xsm success mr_5"></div>
                                    <img src="{{asset('company_logo')}}/{{$related->get_user->company_logo ?? ''}}"
                                        alt="" />
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                    @endforeach

                </div>

            </div>
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
                                well as on the highways stretching across the Emirates.
                                Being one of the most scenic places for those seeking a
                                luxurious adventure on wheels, BMWs are the most-in-demand
                                cars in Dubai. Youâ€™ll be driving alongside exotic cars such
                                as Porsche, Mercedes Benz, Audi, not to mention a range of
                                sports cars.Many tourists and residents in Dubai rent a BMW
                                to soak the pleasure of driving a luxurious sedan. The
                                spacious cabin, extra legroom, advanced driving and safety
                                features are what BMW vehicles are most known for.
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
                                Be sure to plan your drives in advance to make the most of
                                it. Google Maps is your best friend!If youâ€™re planning a
                                trip to the Grand Mosque, Louvre or Yas Marina, consider
                                renting for 2 or more days to offset the additional mileage
                                charge you will incur. As most car rentals, including luxury
                                and sports cars, come with a standard mileage limit of
                                250-km per day. Dubai to Abu Dhabi is a good 150-km away so
                                youâ€™ll probably be clocking over 300 km on the journey
                                back.Best practice: Consult with the car rental agency
                                regarding your trip plan for suggestions. Additional mileage
                                packages may be available.
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
                                navigation, safety and performance enhancements. The BMW
                                sedan comes in various 4-door sedan, convertible models with
                                advanced features. Different models including: BMW 2-series,
                                3-series, 550i, 550 mpower, 730li, 750li, X5, X6 and more.
                                If youâ€™re looking for a rare BMW car model, contact our
                                suppliers who have listed a BMW. They might be able to cater
                                to your distinguished needs.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <p>
                Don't miss out on the unforgettable Desert Safari experience.
                Reserve your spot now and let the adventure begin!
            </p>
        </div>
    </section>
    <div class="content_wrap">
        <p><strong class="clr_primary">Note: </strong>The listing above (including It's pricing, features and other
            details) is advertised by Al Emad Rent a Car. Please contact the supplier directly on the listed phone
            number, WhatsApp no. or send an inquiry to rent this car...</p>
    </div>

</div>

<!-- Features Modal -->

<div class="modal fade" id="features" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content features_modal_content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel text-center mx-auto"><i class="fa-solid fa-car"></i>
                    Car Features</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 features_modal_body">
                @php
                    $carFeatures = explode(',', $details->car_features);
                @endphp
                <div class="row">

                    @foreach ($carFeatures as $index => $features)
                        <div class="specs col-md-4 d-flex mt-3">
                            <div class="d-flex">
                                @if ($features == '3D Surround Camera')
                                    <img width="22px" src="{{ asset('icons/arrows.svg') }}" alt="">
                                @endif
                                @if ($features == 'Memory Front Seats')
                                    <img width="22px" src="{{ asset('icons/save.svg') }}" alt="">
                                @endif
                                @if ($features == 'Parking Assist')
                                    <img width="22px" src="{{ asset('icons/plus-square-o.svg') }}" alt="">
                                @endif
                                @if ($features == 'Temperature Controlled Seats')
                                    <img width="22px" src="{{ asset('icons/cooling-seats.svg') }}" alt="">
                                @endif
                                @if ($features == 'Built-in-GPS')
                                    <img width="22px" src="{{ asset('icons/location-arrow.svg') }}"
                                        alt="">
                                @endif
                                @if ($features == 'Parking Sensors')
                                    <img width="22px" src="{{ asset('icons/parking-sensors.svg') }}"
                                        alt="">
                                @endif
                                @if ($features == 'Steering Assist')
                                    <img width="22px" src="{{ asset('icons/caret-square-o-up.svg') }}"
                                        alt="">
                                @endif
                                @if ($features == 'Dat-time Runing Lights')
                                    <img width="22px" src="{{ asset('icons/sun-o.svg') }}" alt="">
                                @endif
                                @if ($features == 'LCD Screens')
                                    <img width="22px" src="{{ asset('icons/lcd-screens.svg') }}" alt="">
                                @endif
                                @if ($features == 'SRS Airbags')
                                    <img width="22px" src="{{ asset('icons/srs-airbags.svg') }}" alt="">
                                @endif
                                @if ($features == 'Front Air Bags')
                                    <img width="22px" src="{{ asset('icons/air-bags.svg') }}" alt="">
                                @endif
                                @if ($features == 'USB')
                                    <img width="22px" src="{{ asset('icons/usb.svg') }}" alt="">
                                @endif
                                @if ($features == 'Apple CarPlay')
                                    <img width="22px" src="{{ asset('icons/apple.svg') }}" alt="">
                                @endif
                                @if ($features == 'FM-Radio')
                                    <img width="22px" src="{{ asset('icons/podcast.svg') }}" alt="">
                                @endif
                                @if ($features == 'Power Seats')
                                    <img width="22px" src="{{ asset('icons/power-seats.svg') }}" alt="">
                                @endif
                                @if ($features == 'Power Mirrors')
                                    <img width="22px" src="{{ asset('icons/power-mirrors.svg') }}"
                                        alt="">
                                @endif
                                @if ($features == 'Touchscreen LCD')
                                    <img width="22px" src="{{ asset('icons/hand-o-up.svg') }}" alt="">
                                @endif
                                @if ($features == 'Seat Belt Reminder')
                                    <img width="22px" src="{{ asset('icons/warning.svg') }}" alt="">
                                @endif
                                @if ($features == 'Power Door Locks')
                                    <img width="22px" src="{{ asset('icons/door-locks.svg') }}" alt="">
                                @endif
                                @if ($features == 'Power Windows')
                                    <img width="22px" src="{{ asset('icons/power-windows.svg') }}"
                                        alt="">
                                @endif
                                @if ($features == 'Rear AC')
                                    <img width="22px" src="{{ asset('icons/rear-ac.svg') }}" alt="">
                                @endif
                                @if ($features == 'Premium Audio')
                                    <img width="22px" src="{{ asset('icons/bullseye.svg') }}" alt="">
                                @endif
                                @if ($features == 'Fabric Seats')
                                    <img width="22px" src="{{ asset('icons/fabric-seats.svg') }}" alt="">
                                @endif
                                @if ($features == 'Bluetooth')
                                    <img width="22px" src="{{ asset('icons/bluetooth.svg') }}" alt="">
                                @endif
                                @if ($features == 'Fog-Lights')
                                    <img width="22px" src="{{ asset('icons/fog-lights.svg') }}" alt="">
                                @endif
                                @if ($features == 'Adaptive Cruise Control')
                                    <img width="22px" src="{{ asset('icons/lease-find-cars.svg') }}"
                                        alt="">
                                @endif
                                @if ($features == 'Massaging Seats')
                                    <img width="22px" src="{{ asset('icons/align-center.svg') }}" alt="">
                                @endif
                                @if ($features == 'Sliding Doors')
                                    <img width="22px" src="{{ asset('icons/sliding-doors.svg') }}"
                                        alt="">
                                @endif
                                @if ($features == 'Foldable Armrest')
                                    <img width="22px" src="{{ asset('icons/columns.svg') }}" alt="">
                                @endif
                                @if ($features == 'Android Auto')
                                    <img width="22px" src="{{ asset('icons/android.svg') }}" alt="">
                                @endif
                                @if ($features == 'Detachable Roof')
                                    <img width="22px" src="{{ asset('icons/ticket.svg') }}" alt="">
                                @endif
                                @if ($features == 'Butterfly Doors')
                                    <img width="22px" src="{{ asset('icons/butterfly-doors.svg') }}"
                                        alt="">
                                @endif
                                @if ($features == 'Stereo MP3 / Cd')
                                    <img width="22px" src="{{ asset('icons/music.svg') }}" alt="">
                                @endif
                                @if ($features == 'Paddle Shift(Triptronic)')
                                    <img width="22px" src="{{ asset('icons/hand-lizard-o.svg') }}"
                                        alt="">
                                @endif
                                @if ($features == 'Push Button Ignition')
                                    <img width="22px" src="{{ asset('icons/push-button-start.svg') }}"
                                        alt="">
                                @endif
                                @if ($features == 'Powered Tailgate')
                                    <img width="22px" src="{{ asset('icons/toggle-up.svg') }}" alt="">
                                @endif
                                @if ($features == 'Chiller Freezer')
                                    <img width="22px" src="{{ asset('icons/spinner.svg') }}" alt="">
                                @endif
                                @if ($features == 'Air Suspension')
                                    <img width="22px" src="{{ asset('icons/navicon.svg') }}" alt="">
                                @endif
                                @if ($features == 'Sunroof/Moonroof')
                                    <img width="22px" src="{{ asset('icons/sunroof-car-moon-roof.svg') }}"
                                        alt="">
                                @endif
                                @if ($features == 'Reverse Camera')
                                    <img width="22px" src="{{ asset('icons/rear-camera-parking.svg') }}"
                                        alt="">
                                @endif
                                @if ($features == 'Digital HUD')
                                    <img width="22px" src="{{ asset('icons/digital-display.svg') }}"
                                        alt="">
                                @endif
                                @if ($features == 'Alloy Wheels')
                                    <img width="22px" src="{{ asset('icons/alloy-wheels.svg') }}" alt="">
                                @endif
                                @if ($features == 'Blind Spot Warning')
                                    <img width="22px" src="{{ asset('icons/blind-spot-mirror.svg') }}"
                                        alt="">
                                @endif
                                @if ($features == 'Climate Control')
                                    <img width="22px" src="{{ asset('icons/climate-control.svg') }}"
                                        alt="">
                                @endif
                                {{-- @if ($features == 'Climate Control')
                                <img width="22px" src="{{asset('icons/climate-control.svg')}}" alt="">
                                @endif --}}
                                @if ($features == 'Tail Lift')
                                    <img width="22px" src="{{ asset('icons/toggle-up.svg') }}" alt="">
                                @endif



                                <div>
                                    <span class="mt-1 fs_15">&nbsp; {{ $features }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
            {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
        </div>
    </div>
</div>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- include the JavaScript file for Owl Carousel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
    var swiper = new Swiper(".mySwiper", {
        loop: true,
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,

    });
    var swiper2 = new Swiper(".mySwiper2", {
        loop: true,
        grabCursor: true,
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        thumbs: {
            swiper: swiper,
        },

        effect: "creative",
        creativeEffect: {
            prev: {
                shadow: true,
                translate: ["-40%", 0, -1],
            },
            next: {
                translate: ["100%", 0, 0],
            },
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        speed: 500,
    });

    $(document).ready(function() {
        // Initialize the Owl Carousel with autoplayTimeout
        var owl = $(".owl_four_items").owlCarousel({
            items: 4,
            loop: true,
            autoplay: true,
            autoplayHoverPause: true,
            autoplayTimeout: 2000, // Set autoplay timeout to 2 seconds (2000 milliseconds)
            responsive: {
                // Define different options for different screen sizes
                0: {
                    items: 1 // Display 1 item on small screens (width less than 576px)
                },
                576: {
                    items: 2 // Display 2 items on screens between 576px and 768px
                },
                768: {
                    items: 3 // Display 3 items on screens between 768px and 992px
                },
                992: {
                    items: 4 // Display 4 items on screens 992px and above
                }
            }
        });
    });
</script>
<script>
    $('.phonelead').on('click', function(e) {
        e.preventDefault();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var dataId = $('.phonelead').data("id");
        var companyId = $('.phonelead').attr("company-id");
        $.ajax({
            url: "{{ route('call-leads') }}",
            type: 'GET',
            data: {
                'dataId': dataId,
                'companyId': companyId
            },
            beforeSend: function() {
                $("#preloaderSmall").removeClass('loader-active');
            },
            success: function(response, data) {
                $("#preloaderSmall").addClass('loader-active');
                $.each(response.errors, function(prefix, val) {
                    toastr.error(val[0]);
                });
                if (response.status == 503) {
                    toastr.error(response.message)
                    return false;
                }
                // if(response.status ==  400){

                // }
                if (response.status == 502) {
                    toastr.error('Invalid OTP !');
                }
                if (response.status == 200) {
                    // $('#registerCompany')[0].reset();
                }
            }
        });

    })
</script>
<script>
    $(document).ready(function() {
        $("#getValueButton").on("click", function() {
            var companyId = "{{ $details->get_user->id }}";
            var productId = "{{ $details->id }}";
            $.ajax({
                url: "{{ route('car-leads') }}",
                type: 'GET',
                data: {
                    'companyId': companyId,
                    'productId': productId
                },
                beforeSend: function() {
                    $("#preloaderSmall").removeClass('loader-active');
                },
                success: function(response, data) {
                    $("#preloaderSmall").addClass('loader-active');
                    $.each(response.errors, function(prefix, val) {
                        toastr.error(val[0]);
                    });
                    if (response.status == 503) {
                        toastr.error(response.message)
                        return false;
                    }
                    // if(response.status ==  400){

                    // }
                    if (response.status == 502) {
                        toastr.error('Invalid OTP !');
                    }
                    if (response.status == 200) {
                        // $('#registerCompany')[0].reset();
                    }
                }
            });
        });
    });
</script>



<script>
    // call

    document.addEventListener("DOMContentLoaded", function() {
        const myWpElement = document.getElementById("my_wp");

        myWpElement.addEventListener("focus", function() {
            // Your code to handle the focus event goes here
            const my_wp_num = document.getElementById("my_wp_num");

            my_wp_num.classList.remove("d-none");
            console.log("focus.");
            myWpElement.style.width = "170px"
        });
        myWpElement.addEventListener("blur", function() {
            // Your code to handle the focus event goes here
            my_wp_num.classList.add("d-none");
            console.log("blur");
            myWpElement.style.width = "47px"
        });


    });

    // whatsapp

    document.addEventListener("DOMContentLoaded", function() {
        const myWpElement1 = document.getElementById("my_wp1");

        myWpElement1.addEventListener("focus", function() {
            // Your code to handle the focus event goes here
            const my_wp_num1 = document.getElementById("my_wp_num1");

            my_wp_num1.classList.remove("d-none");
            console.log("focus.");
            myWpElement1.style.width = "170px"
        });
        myWpElement1.addEventListener("blur", function() {
            // Your code to handle the focus event goes here
            my_wp_num1.classList.add("d-none");
            console.log("blur");
            myWpElement1.style.width = "47px"
        });


    });
</script>

<script>
    $('.mileagesdata').on('change', function(e) {
        e.preventDefault();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        var mileageId = $("#mileageslt").val();
        console.log(mileageId);
        $.ajax({
            url: "{{ route('get_mileage_price') }}",
            type: 'GET',
            data: {
                'mileageId': mileageId,
            },
            beforeSend: function() {
                $("#preloaderSmall").removeClass('loader-active');
            },
            success: function(response) {
                $('#months').val('');
                $.each(response.get_months, function(key, value) {
                    console.log(value);
                    if (key !== 'id' && key !== 'product_id' && key !== 'mileage' && key !==
                        'created_at' && key !== 'updated_at') {

                        if (key === 'one_month' && value !== null) {
                            // console.log(key.one_month);
                            $('#months').empty();
                            $("#pricemonth").empty();
                            $('#months').append(
                                `<option value="${key}">One Month</option>`
                            );
                            $('#pricemonth').append(
                                `<option value="${key}">${value} AED</option>`
                            )
                        } else if (key === 'three_months' && value !== null) {
                            $('#months').append(
                                `<option value="${key}">Three Months</option>`
                            );
                            $('#pricemonth').append(
                                `<option value="${key}">${value} AED</option>`
                            )
                        } else if (key === 'nine_months' && value !== null) {

                            $('#months').append(
                                `<option value="${key}">Nine Months</option>`
                            );
                            $('#pricemonth').append(
                                `<option value="${key}">${value} AED</option>`
                            )
                        } else if (key === 'twelve_months' && value !== null) {
                            $('#months').append(
                                `<option value="${key}">Twelve Months</option>`
                            );
                            $('#pricemonth').append(
                                `<option value="${key}">${value} AED</option>`
                            )
                        }
                    }
                });

            }
        });
    })
</script>
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

@endsection
