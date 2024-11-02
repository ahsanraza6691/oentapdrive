@extends('frontend.layouts.new_header')
@section('title', 'Rent ' . $details->get_brand_name->brand_name . " " . $details->model_name . " " . $details->make_year . " | OneTapDrive")
@section('style')
    <style>
        @media (max-width: 991.98px) {
            .mobileMenu {
                display: none;
            }

            .faqSec {
                margin-bottom: 5rem;
            }
        }
    </style>
@endsection
@section('content')

    <section class="linkingSec d-lg-block d-none">
        <div class="container-lg">
            <div class="row">
                <div class="col-md-12">
                    <div class="filterBtnRow">
                        <ul class="linkingCont">
                            <li><a href="{{route('home')}}" class="fa fa-home"></a></li>
                            <li><a href="#0">{{$details->get_user->city ?? ''}}</a></li>
                            <li>
                                <a href="{{route('rent-a-car-dubai',['brand' => $details->brand_id])}}">{{$details->get_brand_name->brand_name ??''}}</a>
                            </li>
                            <li class="current"><span>{{$details->model_name}} {{$details->make_year}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="productDetailSec">
        @php
            $color_entries = explode(',', $details->exterior_color);

            $first_color_entry = trim($color_entries[0]);

            $first_color_name = explode(':', $first_color_entry)[0];
        @endphp
        <div class="container-xl">
            <div class="row">
                <div class="col-lg-8">
                    <div class="aboutContent contentWrap">
                        <h2 class="secHeading">
                        <span class="fw-bold">
                            {{ $details->get_brand_name->brand_name ?? '' }} {{ $details->model_name ?? '' }} {{ $details->make_year }}
                        </span>
                        </h2>
                        <h6>
                            Hire In {{ $details->get_user->city ?? '' }}: Efficient {{ $details->category }}
                            Car, {{ $details->passengers }} Seats, {{ $first_color_name }}, Stylish
                        </h6>
                    </div>
                    <figure class="imgCont">
                        @php
                            $product_images = json_decode($details->get_images);
                            $last_image = end($product_images);
                        @endphp
                        <a href="{{ asset('images/') }}/{{ $last_image->images }}" data-fancybox>
                            <img src="{{ asset('images/') }}/{{ $last_image->images }}"
                                 class="border_right_radius" alt="Image Gallery">
                        </a>
                        <div class="imgTags">
                            <a href="{{ url()->previous() }}" class="backBtn">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <div class="favCont">
                                @if (!empty($details->is_admin_approve == 1))
                                    <button class="">
                                        <i class="fa fa-check fs_13"></i> Verified
                                    </button>
                                @endif
                                @if ($details->is_featured == 1)
                                    <button class="featured">
                                        <i class="fa fa-star fs_13 mb-1 text-light"></i> Featured
                                    </button>
                                @endif
                                @if ($details->is_featured == 2)
                                    <button class="premium">
                                        <i class="fa fa-star fs_13 mb-1 text-light"></i> Premium
                                    </button>
                                @endif
                            </div>
                            <div class="wishlistCont">
                                <button class="themeBtn share-button">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                                {{-- <button class="styled_button rounded_sm wishlist-button">
                                    <i class="fa fa-heart"></i>
                                </button> --}}

                                @if (Auth::check())
                                    @php
                                        $wishlistProduct = Auth::user()
                                            ->wishlist()
                                            ->where('product_id', $details->id)
                                            ->first();
                                    @endphp
                                    @if ($wishlistProduct)
                                        <button class="themeBtn wishlist-button"
                                                data-product-id="{{ $details->id }}">
                                            <i class="fa fa-heart red_heart"></i>
                                        </button>
                                    @else
                                        <button class="themeBtn wishlist-button"
                                                data-product-id="{{ $details->id }}">
                                            <i class="fa fa-heart"></i>
                                        </button>
                                    @endif
                                @else
                                    <button class="themeBtn wishlist-button"
                                            data-product-id="{{ $details->id }}">
                                        <i class="fa fa-heart"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </figure>
                    <div class="prodContent">
                        <h2>
                            Rent {{ $details->get_brand_name->brand_name ?? '' }} {{ $details->model_name ?? '' }} {{ $details->make_year ?? '' }}
                        </h2>
                        <div class="tags">
                            <span>
                                {{ $details->category }}
                            </span>
                            <span>
                                <span>{{ $details->car_doors ?? '' }}</span>
                                <img src="{{ asset('icons/door.svg') }}" alt="">
                            </span>
                            <span>
                                <span>{{ $details->passengers ?? '' }}</span>
                                <img src="{{ asset('icons/seaticon.svg') }}" alt="">
                            </span>
                            <span>
                                <span>{{ $details->bags ?? '' }}</span>
                                <img src="{{ asset('icons/brefcase.svg') }}" alt="">
                            </span>
                        </div>
                        <div class="priceCont">
                            <div class="price">
                                @if (!empty($details->daily_discount_price))
                                    {{--                                    <p>From--}}
                                    {{--                                        <del>AED {{ $details->price_per_day }}</del>--}}
                                    {{--                                    </p>--}}
                                    <h4>AED {{ $details->daily_discount_price }} / Day</h4>
                                @else
                                    <h4>AED {{ $details->price_per_day }} / Day</h4>
                                @endif
                            </div>
                            <div class="details">
                                <p>
                                    <i class="fas fa-info-circle"></i>
                                    Minimum {{ $details->days }} days rental
                                </p>
                                @if (!empty($details->insurance_per_day))
                                    <p>
                                        <i class="fas fa-check"></i>
                                        Insurance included
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="descriptionCont">
                            <h6>
                                Features & Specs
                            </h6>
                            <ul class="fespecbox">
                                <li>
                                    <figure class="fs-icon"><img class="featspecsimg" loading="lazy"
                                                                 width="20" height="20" alt="feature icon"
                                                                 src="{{ asset('icons/Bag.svg') }}">
                                    </figure>
                                    <span> {{ $details->transmission }} Transmission</span>
                                </li>
                                <li>
                                    <figure class="fs-icon"><img class="featspecsimg" loading="lazy"
                                                                 width="20" height="20" alt="feature icon"
                                                                 src="{{ asset('icons/rent-car.svg') }}">
                                    </figure>
                                    <span>{{ $details->category }}</span>
                                </li>
                                <li>
                                    <figure class="fs-icon"><img class="featspecsimg" loading="lazy"
                                                                 width="20" height="20" alt="feature icon"
                                                                 src="{{ asset('icons/car-doors.svg') }}">
                                    </figure>
                                    <span> {{ $details->car_doors }} Doors </span>
                                </li>
                                <li>
                                    <figure class="fs-icon"><img class="featspecsimg" loading="lazy"
                                                                 width="20" height="20" alt="feature icon"
                                                                 src="{{ asset('icons/seat.svg') }}">
                                    </figure>
                                    <span>Fits {{ $details->passengers }} Passengers </span>
                                </li>
                                <li>
                                    <figure class="fs-icon"><img class="featspecsimg" loading="lazy"
                                                                 width="20" height="20" alt="feature icon"
                                                                 src="{{ asset('icons/Bag.svg') }}">
                                    </figure>
                                    <span> Fits {{ $details->bags }} Bag(s)</span>
                                </li>
                                <li>
                                    <figure class="fs-icon"><img class="featspecsimg" loading="lazy"
                                                                 width="20" height="20" alt="feature icon"
                                                                 src="{{ asset('icons/gcc-specs.svg') }}">
                                    </figure>
                                    <span> International Specs: Yes </span>
                                </li>
                                <li data-bs-toggle="modal" data-bs-target="#featureModal">
                                    <figure class="fs-icon"><img class="featspecsimg" loading="lazy"
                                                                 width="20" height="20" alt="feature icon"
                                                                 src="https://www.oneclickdrive.com/application/views/img/three-dots.svg?Lo=7.9">
                                    </figure>
                                    <span class="text-orange">See more </span>
                                </li>
                            </ul>
                        </div>
                        <div class="descriptionCont">
                            <h6>
                                <i class="fas fa-file"></i>
                                Description & Highlights
                            </h6>
                            <div class="descriptionContent">
                                {!! $details->description !!}
                            </div>
                            <ul>
                                <li>
                                    <div class="specCont">
                                        <p data-bs-toggle="tooltip" data-bs-placement="top"
                                           data-bs-title="Car Registration Year">Car Registration Year</p>
                                        <p class="mb-0 text-dark" data-bs-toggle="tooltip" data-bs-placement="top"
                                           data-bs-title="{{ $details->make_year }}">
                                            {{ $details->make_year }}
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="specCont">
                                        <p data-bs-toggle="tooltip" data-bs-placement="top"
                                           data-bs-title="Gearbox">Gearbox</p>
                                        <p class="mb-0 text-dark" data-bs-toggle="tooltip" data-bs-placement="top"
                                           data-bs-title="{{ $details->transmission }}">
                                            {{ $details->transmission }}
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="specCont">
                                        <p data-bs-toggle="tooltip" data-bs-placement="top"
                                           data-bs-title="Salik / Toll Charges">Salik / Toll Charges</p>
                                        <p class="mb-0 text-dark" data-bs-toggle="tooltip" data-bs-placement="top"
                                           data-bs-title="AED 5">
                                            AED 5
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="bookingBox">
                        <div class="bookingHeader">
                            <figure class="logo">
                                <a href="{{ route('company-profile', ['slug' => $details->get_user->slug]) }}">
                                    <img class="d-block mx-auto"
                                         src="{{ asset('company_logo/' . $details->get_user->company_logo) }}" alt="">
                                </a>
                                <figcaption>
                                    BOOK DIRECTLY FROM SUPPLIER
                                </figcaption>
                            </figure>
                            <div class="btnCont">

                                @php
                                    $currenturl = URL::current();
                                @endphp
                                <a href="tel:{{$details->get_user->contact}}" class="themeBtn">
                                    <i class="fas fa-phone"></i>
                                </a>
                                <a id="getValueButton"
                                   href="https://api.whatsapp.com/send?text=<?php echo $currenturl; ?>"
                                   class="themeBtn whatsapp">
                                    <input type="hidden" id="myHiddenInput" value="My Hidden Value">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                                @if(!Auth::check())
                                    <button data-bs-toggle="modal" data-bs-target="#enquiryModal"
                                            class="themeBtn enquiry">
                                        <i class="fas fa-envelope"></i>
                                        {{--                                    <i class="fas fa-paper-plane"></i>--}}
                                    </button>
                                @else
                                    <button data-bs-toggle="modal" data-bs-target="#enquiryModal"
                                            class="themeBtn enquiry">
                                        <i class="fas fa-envelope"></i>
                                        {{--                                    <i class="fas fa-paper-plane"></i>--}}
                                    </button>
                                @endif
                            </div>
                        </div>
                        <ul class="nav nav-tabs price_tabs tab mt-4" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab"
                                        data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button"
                                        role="tab" aria-controls="home-tab-pane" aria-selected="true">
                                    @if (!empty($details->daily_discount_price))
                                        <p>
                                            <del>AED {{ $details->price_per_day }}</del>
                                        </p>
                                        <h6>AED {{ $details->daily_discount_price }}</h6>
                                        <p>/ day</p>
                                    @else
                                        <h6>AED {{ $details->price_per_day }}</h6>
                                        <p>/ day</p>
                                    @endif
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#profile-tab-pane" type="button" role="tab"
                                        aria-controls="profile-tab-pane" aria-selected="false">
                                    @if (!empty($details->weekly_discount_price))
                                        <p>
                                            <del>AED {{ $details->weekly_rent }}</del>
                                        </p>
                                        <h6>AED {{ $details->weekly_discount_price }}</h6>
                                        <p>/ day</p>
                                    @else
                                        <h6>AED {{ $details->weekly_rent }}</h6>
                                        <p>/ week</p>
                                    @endif
                                </button>
                            </li>

                            @php
                                $minMileage = null;
                            @endphp
                            @foreach ($details->get_mileage as $mileage)
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

                            @if (!empty($minMileage))
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="contact-tab"
                                            data-bs-toggle="tab" data-bs-target="#contact-tab-pane"
                                            type="button" role="tab" aria-controls="contact-tab-pane"
                                            aria-selected="false">
                                        {{-- <p><del>AED 70</del></p> --}}
                                        @if ($minMileage !== null)
                                            <h6>AED {{ $minMileage }}</h6>
                                        @endif
                                        <p>/ Month</p>
                                    </button>
                                </li>
                            @endif
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                 aria-labelledby="home-tab" tabindex="0">
                                <div class="infoBox">
                                    <p>Included mileage limit</p>
                                    <p>{{ $details->per_day_mileage }} km</p>
                                </div>
                                <div class="infoBox">
                                    <p>Included mileage limit</p>
                                    <p>250 km</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel"
                                 aria-labelledby="profile-tab" tabindex="0">
                                <div class="infoBox">
                                    <p>Included mileage limit</p>
                                    <p>{{ $details->weekly_mileage }} km</p>
                                </div>
                                <div class="infoBox">
                                    <p>Insurance</p>
                                    <p>Basic Comprehensive</p>
                                </div>
                            </div>

                            @if (!empty($details->get_mileage))
                                @if (count($details->get_mileage) > 0)
                                    @php
                                        // Assuming keys in $details->get_mileage are like 'one_month', 'three_months', etc.
                                        $mileage_data = $details->get_mileage;

                                        // Define the months and their IDs (adjusted to match actual keys in $mileage_data)
                                        $months = [
                                            'one_month' => ['id' => 1, 'name' => 'One month'],
                                            'three_months' => ['id' => 2, 'name' => 'Three months'],
                                            'six_months' => ['id' => 3, 'name' => 'Six months'],
                                            'nine_months' => ['id' => 4, 'name' => 'Nine months'],
                                            'twelve_months' => ['id' => 5, 'name' => 'Twelve months'],
                                        ];

                                        // Initialize variables
                                        $non_null_months = 0;
                                        $non_null_month_data = [];

                                        // Iterate through each month and check for non-null values
                                        foreach ($months as $key => $month) {
                                            // Check if the key exists in $mileage_data and is not null
                                            if (
                                                $mileage_data->has($key) &&
                                                !is_null($mileage_data->{$key})
                                            ) {
                                                $non_null_months++;
                                                $non_null_month_data[] = [
                                                    'id' => $month['id'],
                                                    'name' => $month['name'],
                                                ];
                                            }
                                        }
                                    @endphp
                                    {{-- {{dd($months)}} --}}

                                    <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel"
                                         aria-labelledby="contact-tab" tabindex="0">
                                        <div class="infoBox">
                                            <p>Monthly</p>
                                            <div class="row">
                                                <div class="col">

                                                    @php
                                                        $minMileage = null;
                                                    @endphp
                                                    @foreach ($details->get_mileage as $mileage)
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
                                                                $currentMinMileage = min(
                                                                    $nonNullMileageValues,
                                                                );
                                                                if (
                                                                    $minMileage === null ||
                                                                    $currentMinMileage < $minMileage
                                                                ) {
                                                                    $minMileage = $currentMinMileage;
                                                                }
                                                            }
                                                        @endphp
                                                    @endforeach



                                                    @php
                                                        $nonNullMonths = [];

                                                        // Loop through each mileage entry and gather non-null months
                                                        foreach ($details->get_mileage as $mileage) {
                                                            if (!is_null($mileage->one_month)) {
                                                                $nonNullMonths['one_month'] = '1 Month';
                                                            }
                                                            if (!is_null($mileage->three_months)) {
                                                                $nonNullMonths['three_months'] =
                                                                    '3 Months';
                                                            }
                                                            if (!is_null($mileage->six_months)) {
                                                                $nonNullMonths['six_months'] =
                                                                    '6 Months';
                                                            }
                                                            if (!is_null($mileage->nine_months)) {
                                                                $nonNullMonths['nine_months'] =
                                                                    '9 Months';
                                                            }
                                                            if (!is_null($mileage->twelve_months)) {
                                                                $nonNullMonths['twelve_months'] =
                                                                    '12 Months';
                                                            }
                                                        }
                                                    @endphp
                                                    <select id="get_month">

                                                        @foreach ($nonNullMonths as $key => $month)
                                                            {{-- {{   dd($nonNullMonths['id'])}} --}}
                                                            <option value="{{ $key }}">
                                                                {{ $month }}</option>
                                                        @endforeach
                                                    </select>
                                                    </select>

                                                </div>
                                            </div>

                                            @php
                                                $uniqueMileages = [];

                                                // Loop through each mileage entry and gather non-null months
                                                foreach ($details->get_mileage as $mileage) {
                                                    if (
                                                        !is_null($mileage->one_month) ||
                                                        !is_null($mileage->three_months) ||
                                                        !is_null($mileage->six_months) ||
                                                        !is_null($mileage->nine_months) ||
                                                        !is_null($mileage->twelve_months)
                                                    ) {
                                                        // Use mileage as key to ensure uniqueness
                                                        $uniqueMileages[$mileage->id] =
                                                            $mileage->mileage;
                                                    }
                                                }
                                            @endphp

                                            {{-- <p">1 {{ $month}}</p> --}}

                                        </div>
                                        <div class="infoBox">
                                            <p>Included mileage limit</p>
                                            <select
                                                    class="mileagesdata"
                                                    id="mileageslt">
                                                @foreach ($uniqueMileages as $id => $mileage)
                                                    <option value="{{ $id }}">
                                                        {{ $mileage }} km
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="infoBox">
                                            <p>Additional mileage charge</p>
                                            <p>AED {{$details->monthly_extra}} / km</p>
                                        </div>
                                    </div>
                                @endif

                            @endif
                        </div>
                        <button class="note" data-bs-toggle="modal" data-bs-target="#noteModal">
                            Supplier Note: + 5% VAT applicable. {{$details->get_user->company_name ?? ''}} ...
                        </button>
                    </div>
                    <div class="timingCont">
                        <div class="timingBox"
                             onclick="tableShow()">
                            @php
                                $currentDay = ucfirst(date('l'));
                                $currentTime = date('H:i:s');
                            @endphp
                            @if (!empty($shop_timings))
                                @foreach ($shop_timings as $time)
                                    @if ($time['day_of_week'] == $currentDay)
                                        @if ($time['opening_time'] == $time['closing_time'])
                                            <p>
                                                Open 24 Hours
                                                <i class="fas fa-clock"></i>
                                            </p>
                                        @endif
                                    @else
                                        @if ($time['day_of_week'] == $currentDay || $time['closing_time'] == $currentTime)
                                            <p>
                                                {{ date('g:i A', strtotime($time['opening_time'])) }}-
                                                {{ date('g:i A', strtotime($time['closing_time'])) }}
                                                <i class="fas fa-clock"></i>
                                            </p>
                                        @endif
                                    @endif
                                @endforeach
                            @else
                                <p>
                                    Shop Timings not updated
                                    <i class="fas fa-clock"></i>
                                </p>
                            @endif
                            <p>
                                Shop Timings
                                <i class="fas fa-chevron-right" id="arrow_right"></i>
                            </p>
                        </div>
                        <table class="table table-striped mt-2 d-none" id="open_time" cellspacing="0">

                            @php
                                $currentDay = ucfirst(date('l'));
                            @endphp
                            <tbody>
                            @foreach ($shop_timings as $time)
                                @if ($time['day_of_week'] == $currentDay)
                                    <tr style="font-weight:bold;">
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
                            {{-- <tr style="font-weight:bold;">
                                <td>Saturday</td>
                                <td>9:00am – 9:00pm</td>
                            </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="carsSec">
        <div class="container-lg">
            <div class="row">
                <div class="col-12">
                    <h2 class="secHeading ms-0">
                        Best Car Rental Deals in Dubai
                    </h2>
                </div>
                <div class="col-12">
                    <div class="carsSwiper swiper">
                        <div class="swiper-wrapper">
                            @if(!empty($cars))
                                @foreach ($cars as $value)
                                    <div class="swiper-slide">
                                        <div class="carCard">
                                            <a class="imgCont"
                                               href="{{ route('car-details', ['slug' => $value->slug]) }}">
                                                <img loading="lazy"
                                                     src="{{ asset('images/') }}/{{ $value->get_images[0]->images }}"
                                                     alt=""/>
                                            </a>
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
                                            <a href="{{ route('car-details', ['slug' => $value->slug]) }}">
                                                <div class="content">
                                                    <h2 class="title">{{ $value->get_brand_name->brand_name ?? '' }}
                                                        {{ $value->model_name ?? '' }} {{ $value->make_year ?? '' }}</h2>
                                                    <div class="rent_details">
                                                        <p class="price">
                                                            AED {{ $value->price_per_day ?? '' }} / Day
                                                        </p>
                                                        <p class="price">
                                                            Mileage {{ $value->per_day_mileage ?? '' }}KM / Day
                                                        </p>
                                                    </div>
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
                                                    <div class="other_details">
                                                        <div class="right_details_area">
                                                            <p class=""><i
                                                                        class="fa fa-check-circle text_light_green"
                                                                        aria-hidden="true"></i> &nbsp;
                                                                {{ $value->days }} day rental available</p>
                                                            <p class=""><i class="fa fa-info-circle bg_yellow"
                                                                           aria-hidden="true"></i> &nbsp;
                                                                Deposit: AED {{ $value->security_deposit ?? '' }}
                                                            </p>
                                                            @if (!empty($value->insurance_per_day))
                                                                <p class=""><i
                                                                            class="fa fa-check-circle text_light_green"
                                                                            aria-hidden="true"></i> &nbsp; Insurance
                                                                    Included
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
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-3 faqSec">
        <div class="container-lg">
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

    <!-- Description Modal -->
    <div class="modal fade" id="descriptionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="exampleModalLabel">Description</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="aboutContent contentWrap fullDescription">
                        {!! $details->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Modal -->
    <div class="modal fade" id="featureModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="aboutContent contentWrap fullDescription">
                        <h3>Car Specs</h3>
                        <div class="specs">
                            <figure class="spec_icon">
                                <img width="20px" src="{{ asset('icons/gcc-specs.svg') }}" alt="">
                                <span>
                                    {{ $details->transmission }} Transmission
                                </span>
                            </figure>
                            <figure class="spec_icon">
                                <img width="20px" src="{{ asset('icons/rent-car.svg') }}" alt="">
                                <span>
                                    {{ $details->category }}
                                </span>
                            </figure>
                            <figure class="spec_icon">
                                <img width="20px" src="{{ asset('icons/car-doors.svg') }}" alt="">
                                <span>
                                    {{ $details->doors }} Doors
                                </span>
                            </figure>
                            <figure class="spec_icon">
                                <img width="20px" src="{{ asset('icons/seat.svg') }}" alt="">
                                <span>
                                    Fits {{ $details->passengers }} Passengers
                                </span>
                            </figure>
                            <figure class="spec_icon">
                                <img width="20px" src="{{ asset('icons/Bag.svg') }}" alt="">
                                <span>
                                    Fits {{ $details->bags }} Bag(s)
                                </span>
                            </figure>
                            <figure class="spec_icon">
                                <img width="20px" src="{{ asset('icons/gcc-specs.svg') }}" alt="">
                                <span>
                                    International Specs: Yes
                                </span>
                            </figure>
                            <figure class="spec_icon">
                                <img width="20px" src="{{ asset('icons/fuel-petrol.svg') }}" alt="">
                                <span>
                                    {{ $details->fuel_type }} Vehicle
                                </span>
                            </figure>
                        </div>
                        <h3>Car Color</h3>
                        @php
                            $exteriorColors = explode(',', $details->exterior_color);
                        @endphp
                        <ul>
                            <li>
                                <p>Exterior</p>
                                <div class="colorBox">
                                    @foreach ($exteriorColors as $extcolorData)
                                        @php
                                            [$colorName, $colorCode] = explode(':', $extcolorData);
                                        @endphp
                                        <span class=color
                                              style="background-color: {{ $colorCode }}"></span>
                                        <span class="d-block ms-2">{{ $colorName }}</span>
                                    @endforeach
                                </div>
                            </li>
                            <li>
                                <p>Interior</p>
                                <div class="colorBox">
                                    @php
                                        $interiorColors = explode(',', $details->interior_color);
                                    @endphp
                                    @foreach ($interiorColors as $intcolorData)
                                        @php
                                            [$colorName, $colorCode] = explode(':', $intcolorData);
                                        @endphp
                                        <span class=color
                                              style="background-color:{{ $colorCode }}"></span>
                                        <span class="d-block ms-2">{{ $colorName }}</span>
                                    @endforeach
                                </div>
                            </li>
                        </ul>
                        <h3>Car Features</h3>
                        <div class="specs">

                            @php
                                $carFeatures = explode(',', $details->car_features);
                            @endphp
                            @foreach ($carFeatures as $index => $features)
                                <div class="spec_icon">
                                    @if ($features == '3D Surround Camera')
                                        <img width="20px" src="{{ asset('icons/arrows.svg') }}" alt="">
                                        <span>3D Surround Camera</span>
                                    @endif
                                    @if ($features == 'Memory Front Seats')
                                        <img width="20px" src="{{ asset('icons/save.svg') }}" alt="">
                                        <span>Memory Front Seats</span>
                                    @endif
                                    @if ($features == 'Parking Assist')
                                        <img width="20px" src="{{ asset('icons/plus-square-o.svg') }}"
                                             alt="">
                                        <span>Parking Assist</span>
                                    @endif
                                    @if ($features == 'Temperature Controlled Seats')
                                        <img width="20px" src="{{ asset('icons/cooling-seats.svg') }}"
                                             alt="">
                                        <span>Temperature Controlled Seats</span>
                                    @endif
                                    @if ($features == 'Built-in-GPS')
                                        <img width="20px" src="{{ asset('icons/location-arrow.svg') }}"
                                             alt="">
                                        <span>Built-in-GPS</span>
                                    @endif
                                    @if ($features == 'Parking Sensors')
                                        <img width="20px" src="{{ asset('icons/parking-sensors.svg') }}"
                                             alt="">
                                        <span>Parking Sensors</span>
                                    @endif
                                    @if ($features == 'Steering Assist')
                                        <img width="20px" src="{{ asset('icons/caret-square-o-up.svg') }}"
                                             alt="">
                                        <span>Steering Assist</span>
                                    @endif
                                    @if ($features == 'Day-time Runing Lights')
                                        <img width="20px" src="{{ asset('icons/sun-o.svg') }}" alt="">
                                        <span>Day-time Runing Lights</span>
                                    @endif
                                    @if ($features == 'LCD Screens')
                                        <img width="20px" src="{{ asset('icons/lcd-screens.svg') }}"
                                             alt="">
                                        <span>LCD Screens</span>
                                    @endif
                                    @if ($features == 'SRS Airbags')
                                        <img width="20px" src="{{ asset('icons/srs-airbags.svg') }}"
                                             alt="">
                                        <span>SRS Airbags</span>
                                    @endif
                                    @if ($features == 'Front Air Bags')
                                        <img width="20px" src="{{ asset('icons/air-bags.svg') }}"
                                             alt="">
                                        <span>Front Air Bags</span>
                                    @endif
                                    @if ($features == 'USB')
                                        <img width="20px" src="{{ asset('icons/usb.svg') }}" alt="">
                                        <span>USB</span>
                                    @endif
                                    @if ($features == 'Apple CarPlay')
                                        <img width="20px" src="{{ asset('icons/apple.svg') }}" alt="">
                                        <span>Apple CarPlay</span>
                                    @endif
                                    @if ($features == 'FM-Radio')
                                        <img width="20px" src="{{ asset('icons/podcast.svg') }}"
                                             alt="">
                                        <span>FM-Radio</span>
                                    @endif
                                    @if ($features == 'Power Seats')
                                        <img width="20px" src="{{ asset('icons/power-seats.svg') }}"
                                             alt="">
                                        <span>Power Seats</span>
                                    @endif
                                    @if ($features == 'Power Mirrors')
                                        <img width="20px" src="{{ asset('icons/power-mirrors.svg') }}"
                                             alt="">
                                        <span>Power Mirrors</span>
                                    @endif
                                    @if ($features == 'Touchscreen LCD')
                                        <img width="20px" src="{{ asset('icons/hand-o-up.svg') }}"
                                             alt="">
                                        <span>Touchscreen LCD</span>
                                    @endif
                                    @if ($features == 'Seat Belt Reminder')
                                        <img width="20px" src="{{ asset('icons/warning.svg') }}"
                                             alt="">
                                        <span>Seat Belt Reminder</span>
                                    @endif
                                    @if ($features == 'Power Door Locks')
                                        <img width="20px" src="{{ asset('icons/door-locks.svg') }}"
                                             alt="">
                                        <span>Power Door Locks</span>
                                    @endif
                                    @if ($features == 'Power Windows')
                                        <img width="20px" src="{{ asset('icons/power-windows.svg') }}"
                                             alt="">
                                        <span>Power Windows</span>
                                    @endif
                                    @if ($features == 'Rear AC')
                                        <img width="20px" src="{{ asset('icons/rear-ac.svg') }}"
                                             alt="">
                                        <span>Rear AC</span>
                                    @endif
                                    @if ($features == 'Premium Audio')
                                        <img width="20px" src="{{ asset('icons/bullseye.svg') }}"
                                             alt="">
                                        <span>Premium Audio</span>
                                    @endif
                                    @if ($features == 'Fabric Seats')
                                        <img width="20px" src="{{ asset('icons/fabric-seats.svg') }}"
                                             alt="">
                                        <span>Fabric Seats</span>
                                    @endif
                                    @if ($features == 'Bluetooth')
                                        <img width="20px" src="{{ asset('icons/bluetooth.svg') }}"
                                             alt="">
                                        <span>Bluetooth</span>
                                    @endif
                                    @if ($features == 'Fog-Lights')
                                        <img width="20px" src="{{ asset('icons/fog-lights.svg') }}"
                                             alt="">
                                        <span>Fog-Lights</span>
                                    @endif
                                    @if ($features == 'Adaptive Cruise Control')
                                        <img width="20px" src="{{ asset('icons/lease-find-cars.svg') }}"
                                             alt="">
                                        <span>Adaptive Cruise Control</span>
                                    @endif

                                    @if ($features == 'Massaging Seats')
                                        <img width="20px" src="{{ asset('icons/align-center.svg') }}"
                                             alt="">
                                        <span>Massaging Seats</span>
                                    @endif
                                    @if ($features == 'Sliding Doors')
                                        <img width="20px" src="{{ asset('icons/sliding-doors.svg') }}"
                                             alt="">
                                        <span>Sliding Doors</span>
                                    @endif
                                    @if ($features == 'Foldable Armrest')
                                        <img width="20px" src="{{ asset('icons/columns.svg') }}"
                                             alt="">
                                        <span>Foldable Armrest</span>
                                    @endif
                                    @if ($features == 'Android Auto')
                                        <img width="20px" src="{{ asset('icons/android.svg') }}"
                                             alt="">
                                        <span>Android Auto</span>
                                    @endif
                                    @if ($features == 'Detachable Roof')
                                        <img width="20px" src="{{ asset('icons/ticket.svg') }}" alt="">
                                        <span>Detachable Roof</span>
                                    @endif
                                    @if ($features == 'Butterfly Doors')
                                        <img width="20px" src="{{ asset('icons/butterfly-doors.svg') }}"
                                             alt="">
                                        <span>Butterfly Doors</span>
                                    @endif
                                    @if ($features == 'Stereo MP3 / Cd')
                                        <img width="20px" src="{{ asset('icons/music.svg') }}" alt="">
                                        <span>Stereo MP3 / Cd</span>
                                    @endif
                                    @if ($features == 'Paddle Shift(Triptronic)')
                                        <img width="20px" src="{{ asset('icons/hand-lizard-o.svg') }}"
                                             alt="">
                                        <span>Paddle Shift(Triptronic)</span>
                                    @endif
                                    @if ($features == 'Push Button Ignition')
                                        <img width="20px" src="{{ asset('icons/push-button-start.svg') }}"
                                             alt="">
                                        <span>Push Button Ignition</span>
                                    @endif
                                    @if ($features == 'Powered Tailgate')
                                        <img width="20px" src="{{ asset('icons/toggle-up.svg') }}"
                                             alt="">
                                        <span>Powered Tailgate</span>
                                    @endif
                                    @if ($features == 'Chiller Freezer')
                                        <img width="20px" src="{{ asset('icons/spinner.svg') }}"
                                             alt="">
                                        <span>Chiller Freezer</span>
                                    @endif
                                    @if ($features == 'Air Suspension')
                                        <img width="20px" src="{{ asset('icons/navicon.svg') }}"
                                             alt="">
                                        <span>Air Suspension</span>
                                    @endif
                                    @if ($features == 'Sunroof/Moonroof')
                                        <img width="20px" src="{{ asset('icons/sunroof-car-moon-roof.svg') }}"
                                             alt="">
                                        <span>Sunroof/Moonroof</span>
                                    @endif
                                    @if ($features == 'Reverse Camera')
                                        <img width="20px" src="{{ asset('icons/rear-camera-parking.svg') }}"
                                             alt="">
                                        <span>Reverse Camera</span>
                                    @endif
                                    @if ($features == 'Digital HUD')
                                        <img width="20px" src="{{ asset('icons/digital-display.svg') }}"
                                             alt="">
                                        <span>Digital HUD</span>
                                    @endif
                                    @if ($features == 'Alloy Wheels')
                                        <img width="20px" src="{{ asset('icons/alloy-wheels.svg') }}"
                                             alt="">
                                        <span>Alloy Wheels</span>
                                    @endif
                                    @if ($features == 'Blind Spot Warning')
                                        <img width="20px" src="{{ asset('icons/blind-spot-mirror.svg') }}"
                                             alt="">
                                        <span>Blind Spot Warning</span>
                                    @endif
                                    @if ($features == 'Climate Control')
                                        <img width="20px" src="{{ asset('icons/climate-control.svg') }}"
                                             alt="">
                                        <span>Climate Control</span>
                                    @endif
                                    @if ($features == 'Tail Lift')
                                        <img width="20px" src="{{ asset('icons/toggle-up.svg') }}"
                                             alt="">
                                        <span>Tail Lift</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <h3>Listed in</h3>
                        <ul>
                            <li>
                                <a class="text_theme" href="javascript:void(0);">
                                    <p>Compact Car Rentals in Dubai</p>
                                </a>
                                <p><i class="fas fa-arrow-right"></i></p>
                            </li>
                            <li>
                                <a class="text_theme" href="javascript:void(0);">
                                    <p>Compact Car Rentals in Dubai</p>
                                </a>
                                <p><i class="fas fa-arrow-right"></i></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Note Modal -->
    <div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="exampleModalLabel">Note:</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="aboutContent contentWrap fullDescription note">
                        <p><span>Supplier Note:</span> {{$details->get_user->company_name ?? ''}}</p>
                        <p>
                            {{$details->customer_note}}
                        </p>

                        <p>
                            <span class="text_theme">OneTapDrive Note:</span>
                            The listing above (including It's pricing, features and other details) is advertised
                            by {{$details->get_user->company_name ?? ''}}. Please get in touch with the supplier
                            directly by contacting on the listed phone number, WhatsApp no. or simply Request a Call to
                            rent this car.
                        </p>
                        <p>
                            Incase the car is not available at the price mentioned,
                            <span class="text_theme">please report this listing</span>.
                            Happy renting!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enquiry Modal -->
    <div class="modal fade" id="enquiryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="exampleModalLabel">The supplier
                        "{{$details->get_user->company_name ?? ''}}" will directly connect with you</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="carEnquiry" method="POST">
                        @csrf
                        <input type="hidden" name="car_id" id="car_id" value="{{$details->id}}">
                        <input type="hidden" name="vendor_id" id="vendor_id" value="{{$details->user_id}}">
                        <div class="container-fluid">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="carDetails">
                                        <h2 id="car_title">
                                            {{$details->get_brand_name->brand_name ?? ''}} {{$details->model_name}} {{$details->make_year}}
                                        </h2>
                                        <h4 id="min_booking">
                                            Minimum {{$details->days}} day(s) booking
                                        </h4>
                                        <h4 id="car_company">
                                            {{$details->get_user->company_name ?? ''}} Rent A Car
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <img id="car_image" loading="lazy" class="w-100 rounded"
                                         src="{{asset('images')}}/{{$product_images[0]->images}}"
                                         alt="Supplier logo" title="Supplier Logo">
                                </div>
                                <div class="col-md-12">
                                    <div class="inputCont">
                                        <label for="name">Name</label><br>
                                        <input class="form-control" name="name" type="text"
                                               value="{{Auth::user()->name ?? ''}}"
                                               placeholder="{{Auth::user()->name ?? ''}}" id="name" required>
                                    </div>
                                    <div class="inputCont">
                                        <label for="number">Contact Number</label><br>
                                        <input class="form-control" type="number"
                                               value="{{Auth::user()->contact ?? ''}}"
                                               name="contact" placeholder="{{Auth::user()->contact ?? ''}}"
                                               id="number"
                                               required>
                                    </div>
                                    <div class="inputCont checkbox">
                                        <input name="whatsapp_enabled" type="checkbox" value="1" id="whats_enable">
                                        <label class="form-check-label" for="whats_enable">
                                            WhatsApp Enabled
                                        </label>
                                    </div>
                                    <div class="inputCont">
                                        <label for="email_enq">Email</label><br>
                                        <input class="form-control" name="email"
                                               value="{{Auth::user()->email ?? '' }}"
                                               type="email" placeholder="{{Auth::user()->email ?? ''}}"
                                               id="email_enq"
                                               required>
                                    </div>
                                    <div class="inputCont checkbox">
                                        <input type="checkbox" value="" id="send_suppliers">
                                        <label class="form-check-label" for="send_suppliers">
                                            Send request to multiple suppliers
                                        </label>
                                    </div>
                                    <div class="inputCont">
                                        <button type="submit" class="themeBtn">Send Enquiry</button>
                                        <p class="mt-3 enq_para" id="text_para">
                                            Your inquiry will be sent to {{$details->get_user->company_name ?? ''}} Rent
                                            A Car without any obligation or cost to you. You agree to be contacted by
                                            OneTapDrive and its partners.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("script")
    <script>
        $(document).ready(function () {
            $("#getValueButton").on("click", function () {
                var companyId = "{{ $details->get_user->id }}";
                var productId = "{{ $details->id }}";
                $.ajax({
                    url: "{{ route('car-leads') }}",
                    type: 'GET',
                    data: {
                        'companyId': companyId,
                        'productId': productId
                    },
                    beforeSend: function () {
                        $("#preloaderSmall").removeClass('loader-active');
                    },
                    success: function (response, data) {
                        $("#preloaderSmall").addClass('loader-active');
                        $.each(response.errors, function (prefix, val) {
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
            $('.mileagesdata').on('change', function (e) {
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
                    beforeSend: function () {
                        $("#preloaderSmall").removeClass('loader-active');
                    },
                    success: function (response) {
                        $('#months').val('');
                        $.each(response.get_months, function (key, value) {
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
            $('#mileageslt').on('change', function () {
                fetchMileageMonthData();
            });
            $('#get_month').on('change', function () {
                fetchMileageMonthData();
            });

            function fetchMileageMonthData() {
                var selectedMileageId = $('#mileageslt').val();
                var selectedMonthKey = $('#get_month').val();

                // Ensure both selections are made
                if (selectedMileageId && selectedMonthKey) {
                    // Fetch the data from the server or process it here
                    // Assuming you have an endpoint to fetch data based on mileage ID and month key
                    $.ajax({
                        url: "{{ route('get_mileage_price') }}", // Replace with your endpoint
                        method: 'GET',
                        data: {
                            mileage_id: selectedMileageId,
                            month_key: selectedMonthKey
                        },
                        success: function (response) {
                            // Handle the response and display the data
                            console.log(response);
                            // You can display the data in the desired format
                            // For example:
                            $('#price-display').text(response.price); // Example
                        },
                        error: function (xhr, status, error) {
                            console.error('Error fetching data:', error);
                        }
                    });
                }
            }

            $('.phonelead').on('click', function (e) {
                e.preventDefault();
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var dataId = "{{$details->id}}"
                var companyId = "{{$details->user_id}}"
                $.ajax({
                    url: "{{ route('call-leads') }}",
                    type: 'GET',
                    data: {
                        'dataId': dataId,
                        'companyId': companyId
                    },
                    beforeSend: function () {
                        $("#preloaderSmall").removeClass('loader-active');
                    },
                    success: function (response, data) {
                        $("#preloaderSmall").addClass('loader-active');
                        $.each(response.errors, function (prefix, val) {
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
        });

        function tableShow() {

            const open_time = document.getElementById('open_time')
            const arrow_right = document.getElementById('arrow_right')
            open_time.classList.toggle('d-none')
            if (open_time.classList.contains('d-none')) {
                arrow_right.style.transform = 'rotate(0deg)';
            } else {
                arrow_right.style.transform = 'rotate(84deg)';
            }

        }

        document.addEventListener("DOMContentLoaded", function () {
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
@endsection

