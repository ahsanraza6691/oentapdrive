@extends('frontend.layouts.new_header')
@section('title', 'Book'.' '.$chauffeur_details->brand_name.' '.$chauffeur_details->model_name. ' '.$chauffeur_details->make_year .' '. 'with Driver in'. ' '. $chauffeur_details->city.' '.'|'.'Chauffeur Service UAE')
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
                            <li><a href="/" class="fa fa-home"></a></li>
                            <li><a href="#0">Dubai</a></li>
                            <li><a href="#0">car with Driver</a></li>
                            <li class="current">
                                <span>{{$chauffeur_details->brand_name}} {{$chauffeur_details->model_name}} {{$chauffeur_details->make_year}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="productDetailSec">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="aboutContent contentWrap">
                        <h2 class="secHeading">
                            {{ $chauffeur_details->brand_name }} {{ $chauffeur_details->model_name }} {{ $chauffeur_details->make_year }}
                        </h2>
                    </div>
                </div>
                <div class="col-lg-8">
                    <figure class="imgCont">
                        @php
                            $product_images = json_decode($chauffeur_details->images);
                            $last_image = end($product_images);
                        @endphp
                        <a href="{{ asset('images/') }}/{{ $last_image }}" data-fancybox>
                            <img src="{{ asset('images/') }}/{{ $last_image }}"
                                 class="border_right_radius" alt="Image Gallery">
                        </a>
                        <div class="imgTags">
                            <a href="{{ url()->previous() }}" class="backBtn">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <div class="favCont">
                                @if (!empty($chauffeur_details->delivery_days))
                                    <button class="">
                                        <i class="fa fa-check fs_13"></i> Delivery
                                        : {{ $chauffeur_details->delivery_days ?? '' }}
                                    </button>
                                @endif
                                <button class="">
                                    <i class="fa fa-check fs_13"></i> Insurance included
                                </button>
                                @if (!empty($chauffeur_details->is_admin_approve == 1))
                                    <button class="">
                                        <i class="fa fa-check fs_13"></i> Verified
                                    </button>
                                @endif
                                @if ($chauffeur_details->is_featured == 1)
                                    <button class="featured">
                                        <i class="fa fa-star fs_13 mb-1 text-light"></i> Featured
                                    </button>
                                @endif
                                @if ($chauffeur_details->is_featured == 2)
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
                                            ->where('product_id', $chauffeur_details->id)
                                            ->first();
                                    @endphp
                                    @if ($wishlistProduct)
                                        <button class="themeBtn wishlist-button"
                                                data-product-id="{{ $chauffeur_details->id }}">
                                            <i class="fa fa-heart red_heart"></i>
                                        </button>
                                    @else
                                        <button class="themeBtn wishlist-button"
                                                data-product-id="{{ $chauffeur_details->id }}">
                                            <i class="fa fa-heart"></i>
                                        </button>
                                    @endif
                                @else
                                    <button class="themeBtn wishlist-button"
                                            data-product-id="{{ $chauffeur_details->id }}">
                                        <i class="fa fa-heart"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </figure>
                    <div class="prodContent">
                        {{--                        @dd($chauffeur_details)--}}
                        <h2>
                            Rent {{ $chauffeur_details->brand_name }} {{ $chauffeur_details->model_name }} {{ $chauffeur_details->make_year }}
                        </h2>
                        {{--                        @dd($chauffeur_details)--}}
                        <div class="tags">
                            <span>
                                  Documents required
                            </span>
                            <span>
                                {{ $chauffeur_details->category_type }}
                            </span>
                            <span>
                                <span>{{ $chauffeur_details->doors ?? '' }}</span>
                                <img src="{{ asset('icons/door.svg') }}" alt="">
                            </span>
                            <span>
                                <span>{{ $chauffeur_details->passengers ?? '' }}</span>
                                <img src="{{ asset('icons/seaticon.svg') }}" alt="">
                            </span>
                            <span>
                                <span>{{ $chauffeur_details->luggage ?? '' }}</span>
                                <img src="{{ asset('icons/brefcase.svg') }}" alt="">
                            </span>
                        </div>
                        <div class="priceCont">
                            <div class="price">
                                <h4>AED {{ $chauffeur_details->minimunm_hours_booking_charges }}</h4>
                            </div>
                            <div class="details">
                                <p>
                                    <i class="fas fa-info-circle"></i>
                                    Minimum {{ $chauffeur_details->minimunm_hours_booking }} hours booking
                                </p>
                            </div>
                        </div>
                        <div class="descriptionCont">
                            <h6>
                                Rental Include
                            </h6>
                            <ul>
                                <li>
                                    <p>Insurance</p>
                                </li>
                                <li>
                                    <p>Basic Comprehensive</p>
                                </li>
                            </ul>
                        </div>
                        <div class="descriptionCont">
                            <h6>
                                Extras
                            </h6>
                            <ul>
                                <li>
                                    <div class="specCont">
                                        <p>Salik / Toll Charges</p>
                                        <p>AED 5</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="specCont">
                                        <p>Excess Claim</p>
                                        <p>AED 1500 </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="specCont">
                                        <p>Additional driver insurance</p>
                                        <p>AED 100</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="descriptionCont">
                            <h6>
                                Requirements
                            </h6>
                            <ul>
                                <li>
                                    <div class="specCont">
                                        <p>Minimum Driver's Age</p>
                                        <p>22 years</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="specCont">
                                        <p>Security Deposit</p>
                                        <p>AED {{ $chauffeur_details->security_deposit ?? '' }}</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="specCont">
                                        <p>Refunded in</p>
                                        <p>30 days</p>
                                    </div>
                                </li>
                            </ul>
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
                                    <span> {{ $chauffeur_details->transmission }} Transmission</span>
                                </li>
                                <li>
                                    <figure class="fs-icon"><img class="featspecsimg" loading="lazy"
                                                                 width="20" height="20" alt="feature icon"
                                                                 src="{{ asset('icons/rent-car.svg') }}">
                                    </figure>
                                    <span>{{ $chauffeur_details->category_type }}</span>
                                </li>
                                <li>
                                    <figure class="fs-icon"><img class="featspecsimg" loading="lazy"
                                                                 width="20" height="20" alt="feature icon"
                                                                 src="{{ asset('icons/car-doors.svg') }}">
                                    </figure>
                                    <span> {{ $chauffeur_details->door }} Doors </span>
                                </li>
                                <li>
                                    <figure class="fs-icon"><img class="featspecsimg" loading="lazy"
                                                                 width="20" height="20" alt="feature icon"
                                                                 src="{{ asset('icons/seat.svg') }}">
                                    </figure>
                                    <span>Fits {{ $chauffeur_details->passengers }} Passengers </span>
                                </li>
                                <li>
                                    <figure class="fs-icon"><img class="featspecsimg" loading="lazy"
                                                                 width="20" height="20" alt="feature icon"
                                                                 src="{{ asset('icons/Bag.svg') }}">
                                    </figure>
                                    <span> Fits {{ $chauffeur_details->luggage }} Bag(s)</span>
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
                                {!! $chauffeur_details->description !!}
                            </div>
                            <ul>
                                <li>
                                    <div class="specCont">
                                        <p data-bs-toggle="tooltip" data-bs-placement="top"
                                           data-bs-title="Car Registration Year">Car Registration Year</p>
                                        <p class="mb-0 text-dark" data-bs-toggle="tooltip" data-bs-placement="top"
                                           data-bs-title="{{ $chauffeur_details->make_year }}">
                                            {{ $chauffeur_details->make_year }}
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="specCont">
                                        <p data-bs-toggle="tooltip" data-bs-placement="top"
                                           data-bs-title="Gearbox">Gearbox</p>
                                        <p class="mb-0 text-dark" data-bs-toggle="tooltip" data-bs-placement="top"
                                           data-bs-title="{{ $chauffeur_details->transmission }}">
                                            {{ $chauffeur_details->transmission }}
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
                                <a href="{{ route('company-profile', ['slug' => $chauffeur_details->get_user->slug]) }}">
                                    <img class="d-block mx-auto"
                                         src="{{ asset('company_logo/' . $chauffeur_details->get_user->company_logo) }}"
                                         alt="">
                                </a>
                                <figcaption>
                                    BOOK DIRECTLY FROM SUPPLIER
                                </figcaption>
                            </figure>
                            <div class="btnCont">

                                @php
                                    $currenturl = URL::current();
                                @endphp
                                <a href="tel:{{$chauffeur_details->get_user->contact}}" class="themeBtn">
                                    <i class="fas fa-phone"></i>
                                </a>
                                <a id="getValueButton"
                                   href="https://api.whatsapp.com/send?text=<?php echo $currenturl; ?>"
                                   class="themeBtn whatsapp">
                                    <input type="hidden" id="myHiddenInput" value="My Hidden Value">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                                @if(!Auth::check())
                                    <button data-bs-toggle="modal" data-bs-target="#login" role="button"
                                            aria-controls="mailNote_offcanvas" class="themeBtn enquiry">
                                        <i class="fas fa-envelope"></i>
                                        {{--                                    <i class="fas fa-paper-plane"></i>--}}
                                    </button>
                                @else
                                    <button data-bs-toggle="offcanvas" role="button"
                                            aria-controls="mailNote_offcanvas" class="themeBtn enquiry">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                        {{--                        @dd($chauffeur_details)--}}
                        <div class="priceCard special">
                            <h3>
                                {{$chauffeur_details-> brand_name}} {{$chauffeur_details-> model_name}} {{$chauffeur_details-> model_year}}
                                <span>{{$chauffeur_details->category_type}}</span>
                            </h3>
                            <h6>
                                <span>{{$chauffeur_details->minimunm_hours_booking}} hour(s) service:</span>
                                <span>
                                    {{ $chauffeur_details->minimunm_hours_booking_charges ?? '' }} AED
                                </span>
                            </h6>
                            <h6>
                                <span>
                                    Additional Service hour chargers:
                                </span>
                                <span>
                                    {{$chauffeur_details->additional_hour_minimum_charges}} AED
                                </span>
                            </h6>
                            <h6>
                                <span>
                                    {{$chauffeur_details->maximunm_hours_booking}} hour(s) service:
                                </span>
                                <span>
                                    {{ $chauffeur_details->maximunm_hours_booking_charges ?? '' }} AED
                                </span>
                            </h6>
                        </div>
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
                        <div class="addressBox">
                            {{--                            @dd($chauffeur_details->get_user)--}}
                            <h3>Address</h3>
                            <iframe src="{{ $chauffeur_details->get_user->google_map ?? '' }}" width="100%"
                                    height="200px" frameborder="0" style="border: 0" allowfullscreen></iframe>
                            <a href="$chauffeur_details->get_user->google_map" target="_blank">
                                <i class="fa fa-map-marker"></i> {{ $chauffeur_details->get_user->address ?? '' }}
                            </a>
                        </div>
                        <div class="tagsBox">
                            <div class="tagCont">
                                <h3>Branch Location(s)</h3>
                                <div class="tags">
                                    <a class="tag"
                                       href="{{ route('services', ['city' => $chauffeur_details->get_user->city]) }}"
                                       title="Find cars to rent in Downtown Dubai">
                                        {{ $chauffeur_details->get_user->city ?? '' }}</a>
                                </div>
                            </div>
                            <div class="tagCont">
                                <h3>Fast Delivery Location(s)</h3>
                                <div class="tags">
                                    @php
                                        $locations = explode(',', $chauffeur_details->get_user->fast_delivery_locations); // Split locations by commas into an array
                                    @endphp

                                    @foreach ($locations as $location)
                                        <a class="tag" href="javascript:void(0);"
                                           title="Find cars to rent in Downtown Dubai">
                                            {{ $location }}</a>
                                    @endforeach
                                </div>

                            </div>
                            <div class="tagCont">
                                <h3>Payment Modes</h3>
                                <div class="tags">
                                    @php
                                        $payments = explode(',', $chauffeur_details->get_user->payment_modes); // Split locations by commas into an array
                                    @endphp
                                    @foreach ($payments as $payment)
                                        <a class="tag" href="javascript:void(0);"
                                           title="Find cars to rent in Downtown Dubai">
                                            {{ $payment }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <button class="note" data-bs-toggle="modal" data-bs-target="#noteModal">
                            Supplier Note: + 5% VAT applicable. {{$chauffeur_details->get_user->company_name ?? ''}} ...
                        </button>
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
                        Similar Car Rental Options
                    </h2>
                </div>
                @if(count($cars) > 0)
                    <div class="col-12">
                        <div class="carsSwiper swiper">
                            <div class="swiper-wrapper">
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
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                @else
                    <div class="col-12">
                        <h3 class="disclaimer">
                            No Cars Available
                        </h3>
                    </div>
                @endif
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
                        <p><span>Supplier Note:</span> {{$chauffeur_details->get_user->company_name ?? ''}}</p>
                        <p>
                            {{$chauffeur_details->customer_note}}
                        </p>

                        <p>
                            <span class="text_theme">OneTapDrive Note:</span>
                            The listing above (including It's pricing, features and other details) is advertised
                            by {{$chauffeur_details->get_user->company_name ?? ''}}. Please get in touch with the
                            supplier
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
                                    {{ $chauffeur_details->transmission }} Transmission
                                </span>
                            </figure>
                            <figure class="spec_icon">
                                <img width="20px" src="{{ asset('icons/rent-car.svg') }}" alt="">
                                <span>
                                    {{ $chauffeur_details->category_type }}
                                </span>
                            </figure>
                            <figure class="spec_icon">
                                <img width="20px" src="{{ asset('icons/car-doors.svg') }}" alt="">
                                <span>
                                    {{ $chauffeur_details->doors }} Doors
                                </span>
                            </figure>
                            <figure class="spec_icon">
                                <img width="20px" src="{{ asset('icons/seat.svg') }}" alt="">
                                <span>
                                    Fits {{ $chauffeur_details->passengers }} Passengers
                                </span>
                            </figure>
                            <figure class="spec_icon">
                                <img width="20px" src="{{ asset('icons/Bag.svg') }}" alt="">
                                <span>
                                    Fits {{ $chauffeur_details->luggage }} Bag(s)
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
                                    {{ $chauffeur_details->fuel_type?? "" }} Vehicle
                                </span>
                            </figure>
                        </div>

                        <h3>Car Features</h3>
                        <div class="specs">

                            @php
                                $carFeatures = explode(',', $chauffeur_details->car_features);
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

@endsection

@section('script')


    <script>
        $('.phonelead').on('click', function (e) {
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
    </script>
    <script>
        $(document).ready(function () {
            $("#getValueButton").on("click", function () {
                var companyId = "{{ $chauffeur_details->get_user->id }}";
                var productId = "{{ $chauffeur_details->id }}";
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
        });
    </script>



    <script>
        // call

        document.addEventListener("DOMContentLoaded", function () {
            const myWpElement = document.getElementById("my_wp");

            myWpElement.addEventListener("focus", function () {
                // Your code to handle the focus event goes here
                const my_wp_num = document.getElementById("my_wp_num");

                my_wp_num.classList.remove("d-none");
                console.log("focus.");
                myWpElement.style.width = "170px"
            });
            myWpElement.addEventListener("blur", function () {
                // Your code to handle the focus event goes here
                my_wp_num.classList.add("d-none");
                console.log("blur");
                myWpElement.style.width = "47px"
            });


        });

        // whatsapp

        document.addEventListener("DOMContentLoaded", function () {
            const myWpElement1 = document.getElementById("my_wp1");

            myWpElement1.addEventListener("focus", function () {
                // Your code to handle the focus event goes here
                const my_wp_num1 = document.getElementById("my_wp_num1");

                my_wp_num1.classList.remove("d-none");
                console.log("focus.");
                myWpElement1.style.width = "170px"
            });
            myWpElement1.addEventListener("blur", function () {
                // Your code to handle the focus event goes here
                my_wp_num1.classList.add("d-none");
                console.log("blur");
                myWpElement1.style.width = "47px"
            });


        });
    </script>

    <script>
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
