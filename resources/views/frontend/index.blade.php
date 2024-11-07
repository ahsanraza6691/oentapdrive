@extends('frontend.layouts.new_header')
@section('title', 'One Tap Drive  | Cheap Rent a Car Marketplace In UAE ')
@section('description', 'Find the best deals on car rentals in Dubai! Compare prices across top brands for daily, weekly, and monthly rentals in the UAE. Affordable, easy, and reliable!')
@section('content')

<section class="heroSec">
    <img loading="lazy" src="{{asset("web-assets/images/hero_bg.jpg")}}" alt="OneTapDrive bg">
    <div class="content">
        <div class="container-lg">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <h1>
                        Rent a Car in UAE
                        <span>
                                by One Tap Drive
                            </span>
                    </h1>
                    <p>
                        Discover Unforgettable Traveling and Rent a Car
                    </p>
                    <p>
                        for an Unmatched Experience.
                    </p>
                    <a href="{{route('rent-a-car-dubai')}}" class="themeBtn">
                        Book Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{--
<form class="searchBar desktop" action="{{route('rent-a-car-dubai')}}">--}}
    {{--
    <div class="inputCont">--}}
        {{-- <input type="search" id="search_input" placeholder="Search" type="text" name="search_input">--}}
        {{--
        <button class="themeBtn" type="submit">Search</button>
        --}}
        {{--
    </div>
    --}}
    {{--
    <div class="suggestions"></div>
    --}}
    {{--
</form>--}}

<section class="categorySec">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <h2 class="secHeading text-left m-0">
                    Choose by categories
                </h2>
            </div>
        </div>
        <div class="row" id="category-container">
            @if(!empty($categoriesWithCounts))
            @php
            $initialCount = 7;
            $totalCategories = count($categoriesWithCounts);
            @endphp

            @foreach ($categoriesWithCounts as $index => $category)
                @if (isset($category->category))
                    <div class="col-lg-3 col-4 category-item"
                        data-two="{{ $category->category }}"
                        @if ($index >= $initialCount) style="display:none;" @endif>
                        <a href="{{ route('car-rentals', ['type' => lcfirst($category->category)]) }}"
                        class="categoryCard">
                            <div class="cardImg">
                                @if ($category->category == 'Coupe') <img
                                    src="{{ asset('category/Coupe.webp') }}" alt/>
                                @elseif($category->category == 'Sedan') <img
                                    src="{{ asset('category/sedan-car2.webp') }}" alt/>
                                @elseif($category->category == 'Suv') <img loading="lazy" src="{{ asset('category/Suv.webp') }}"
                                                                        alt/>
                                @elseif($category->category == '7 Seater') <img
                                    src="{{ asset('category/7-Seater.webp') }}" alt/>
                                @elseif($category->category == 'Compact') <img
                                    src="{{ asset('category/Compact.webp') }}" alt/>
                                @elseif($category->category == 'Crossover') <img
                                    src="{{ asset('category/Crossover.webp') }}" alt/>
                                @elseif($category->category == 'Luxury') <img
                                    src="{{ asset('category/luxury.webp') }}" alt/>
                                @elseif($category->category == 'ELECTRIC') <img
                                    src="{{ asset('category/ELECTRIC.webp') }}" alt/>
                                @elseif($category->category == 'SPORT') <img
                                    src="{{ asset('category/SPORT.webp') }}" alt/>
                                @elseif($category->category == 'MONTHLY') <img
                                    src="{{ asset('category/MONTHLY.webp') }}" alt/>
                                @elseif($category->category == 'LOW PRICE') <img
                                    src="{{ asset('category/LOW-PRICE.webp') }}" alt/>
                                @elseif($category->category == 'Hatchback') <img
                                    src="{{ asset('category/Hatchback.webp') }}" alt/>
                                @elseif($category->category == 'SUPER CAR') <img
                                    src="{{ asset('category/SUPER-CAR.webp') }}" alt/>
                            @elseif($category->category == 'Saloon') <img
                                    src="{{ asset('category/saloon.webp') }}" alt/>
                                @elseif($category->category == 'CarWithDriver') <img
                                    src="{{ asset('category/Car-With-Driver.webp') }}" alt/>
                                @elseif($category->category == 'CONVERTIBLE')
                                    <img loading="lazy" src="{{ asset('category/Ferrari-FF-2023.webp') }}" alt/>
                                @else
                                    <img loading="lazy" src="{{ asset('images/') }}/{{ $category->get_images[0]->images }}"
                                        alt=""/>
                                @endif
                            </div>
                            <div class="cardContent">
                                <h3>{{ $category->category }}</h3>
                                <p>{{ $category->car_count }} Cars</p>
                                {{--                                    <a class="themeBtn"--}}
                                {{--                                       href="{{ route('services', ['category' => [$category->category]]) }}">--}}
                                {{--                                        View All Cars--}}
                                {{--                                    </a>--}}
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach

            <!-- Add Car With Driver Category -->
            <div class="col-lg-3 col-4" data-two="CarWithDriver">
                <a href="{{ route('car-with-driver') }}" class="categoryCard">
                    <div class="cardImg">
                        <img loading="lazy" src="{{ asset('category/Car-With-Driver.webp') }}" alt/>
                    </div>
                    <div class="cardContent">
                        <h3>Car With Driver</h3>
                        <p>{{ $car_with_driver_count }} Cars</p>
                        {{-- <a class="themeBtn" href="{{ route('car-with-driver') }}">--}}
                            {{-- View All Cars--}}
                            {{-- </a>--}}
                    </div>
                </a>
            </div>

            @if($totalCategories > $initialCount)
            <div class="col-12 text-center mt-4">
                <button id="toggle-button" class="themeBtn">Show More</button>
            </div>
            @endif
            @endif
        </div>
    </div>
</section>

<section class="bannerSec">
    <img loading="lazy" src="{{asset('/web-assets/images/mercedes.webp')}}" alt="mercedes">
    <div class="content">
        <div class="container-lg">
            <h2>
                Smart and Affordable Ways to Rent a Car in UAE
            </h2>
            <p>
                Still stuck searching for a <b>‘rent a car near me’?</b> Your perfect match is right here! One Tap Drive
                is one of Dubai's emerging car rental marketplaces, catering to budget-friendly car rental deals from
                the best rental companies. You can access our extensive fleet of over 2,000 vehicles from trusted rental
                companies across the UAE. We are confident that you will find the most affordable options, whether you
                are a tourist in need of a car or a resident looking for long-term rentals, starting from AED 30 per
                day.

            </p>
        </div>
    </div>
</section>

<section class="brandSec">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <h2 class="secHeading text-left m-0">
                    Rent A Car From Top Brands
                </h2>
            </div>
            <div class="col-12">
                <div class="brandSwiper swiper">
                    <div class="swiper-wrapper">
                         @foreach ($brands as $brand)
                                @php
                                    // Get the count of cars associated with the current brand
                                    $car_count = App\Models\BackendModels\Product::where('brand_id', $brand->id)->count();
                                @endphp
                                <div class="swiper-slide">
                                    <a href="{{ route('brand-car-rental', ['brand' => urlencode($brand->slug)]) }}">
                                        <img src="{{ asset('brands/' . $brand->brand_image) }}"
                                             alt="">
                                        <div class="content">
                                            <h3>{{ $brand->brand_name ?? '' }}</h3>
                                            <p>{{ $car_count }} Cars</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="carsSec">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <h2 class="secHeading text-left m-0">
                    Get Car Rental Deals and Discounts At Amazing Rates
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
                                    <img loading="lazy" src="{{ asset('images/') }}/{{ $value->get_images[0]->images }}"
                                         alt="{{ $value->get_brand_name->brand_name ?? 'Car' }} {{ $value->model_name ?? '' }} - {{ $value->make_year ?? '' }}"/>
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
                                                    alt="Company logo"/>
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

<section class="pt-0">
    <div class="container-lg">
        <div class="row">
            <div class="col">
                <div>
                    <img class="rounded" width="100%" src="{{ asset('web-assets/images/addnew.webp') }}"
                         alt="Advertisement">
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
                    <h3 class="secHeading">
                        Top Car Rental Marketplace in Dubai
                    </h3>
                    <p>
                        The valuable experiences shared by our esteemed users have consistently pushed us to raise the
                        bar. The car rental marketplace of One Tap Drive is regularly updated through a process of
                        ‘Gathering Feedback, Understanding Needs, and Making Changes’ to better serve our users.
                    </p>
                </div>
            </div>
            {{--
            <div class="col-md-7">--}}
                {{-- <h2 class="secHeading">--}}
                    {{-- Testimonials--}}
                    {{-- </h2>--}}
                {{--
                <div class="swiper testiSwiper">--}}
                    {{--
                    <div class="swiper-wrapper">--}}
                        {{--
                        <div class="swiper-slide">--}}
                            {{--
                            <div class="testimonialCard">--}}
                                {{--
                                <div class="userInfo">--}}
                                    {{--
                                    <figure>--}}
                                        {{-- <img loading="lazy" src="{{asset('/web-assets/images/user.webp')}}" alt="">--}}
                                        {{--
                                    </figure>
                                    --}}
                                    {{--
                                    <div class="info">--}}
                                        {{-- <h4>John Doe</h4>--}}
                                        {{-- <p>May 25 2023</p>--}}
                                        {{--
                                        <div class="rating">--}}
                                            {{-- <i class="fas fa-star"></i>--}}
                                            {{-- <i class="fas fa-star"></i>--}}
                                            {{-- <i class="fas fa-star"></i>--}}
                                            {{-- <i class="fas fa-star"></i>--}}
                                            {{-- <i class="fas fa-star"></i>--}}
                                            {{--
                                        </div>
                                        --}}
                                        {{--
                                    </div>
                                    --}}
                                    {{--
                                </div>
                                --}}
                                {{-- <p>--}}
                                    {{-- <span>Service Was Excellent</span>--}}
                                    {{-- In publishing and graphic design, Lorem ipsum is a placeholder text--}}
                                    {{-- commonly used to demonstrate the visual form of a document or a typeface--}}
                                    {{-- without relying on meaningful content. Lorem ipsum may be used as a--}}
                                    {{-- placeholder before final copy is available.--}}
                                    {{-- </p>--}}
                                {{--
                                <div class="source">--}}
                                    {{-- <span>Source: </span>--}}
                                    {{-- <img loading="lazy" src="{{asset("/web-assets/images/google-logo.webp")}}"
                                    alt="">--}}
                                    {{--
                                </div>
                                --}}
                                {{--
                            </div>
                            --}}
                            {{--
                        </div>
                        --}}
                        {{--
                    </div>
                    --}}
                    {{--
                </div>
                --}}
                {{--
            </div>
            --}}
        </div>
    </div>
</section>

<section class="carsSec">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <h2 class="secHeading text-left m-0">
                    Car Rental Dubai
                </h2>
            </div>
            <div class="col-12">
                <div class="carFullSwiper swiper">
                    <div class="swiper-wrapper">
                        @if(!empty($cars))
                        @foreach ($cars as $value)
                        <div class="swiper-slide">
                            <div class="carCard fullCard">
                                <a class="imgCont"
                                   href="{{ route('car-details', ['slug' => $value->slug]) }}">
                                    <img loading="lazy" src="{{ asset('images/') }}/{{ $value->get_images[0]->images }}"
                                         alt="{{ $value->get_brand_name->brand_name ?? 'Car' }} {{ $value->model_name ?? '' }} - {{ $value->make_year ?? '' }}"/>
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
                                                    alt="Company logo"/>
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

<section class="carsSec">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <h2 class="secHeading text-left m-0">
                    Luxury & Sports Cars
                </h2>
            </div>
            <div class="col-12">
                <div class="carFullSwiper swiper">
                    <div class="swiper-wrapper">
                        @if(!empty($cars))
                        @foreach ($cars as $value)
                        <div class="swiper-slide">
                            <div class="carCard fullCard">
                                <a class="imgCont"
                                   href="{{ route('car-details', ['slug' => $value->slug]) }}">
                                    <img loading="lazy" src="{{ asset('images/') }}/{{ $value->get_images[0]->images }}"
                                         alt="{{ $value->get_brand_name->brand_name ?? 'Car' }} {{ $value->model_name ?? '' }} - {{ $value->make_year ?? '' }}"/>
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
                                                    alt="Company logo"/>
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

<section class="p-0 addSec">
    <div class="container-lg">
        <div class="row">
            <div class="col">
                <div>
                    <img width="100%" src="{{ asset('web-assets/images/add.webp') }}" alt="Advertisement">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="carsSec">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <h2 class="secHeading text-left m-0">
                    SUVs for rent in Dubai
                </h2>
            </div>
            <div class="col-12">
                <div class="carFullSwiper swiper">
                    <div class="swiper-wrapper">
                        @if(!empty($cars))
                        @foreach ($cars as $value)
                        <div class="swiper-slide">
                            <div class="carCard fullCard">
                                <a class="imgCont"
                                   href="{{ route('car-details', ['slug' => $value->slug]) }}">
                                    <img loading="lazy" src="{{ asset('images/') }}/{{ $value->get_images[0]->images }}"
                                         alt="{{ $value->get_brand_name->brand_name ?? 'Car' }} {{ $value->model_name ?? '' }} - {{ $value->make_year ?? '' }}"/>
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
                                                    alt="Company logo"/>
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

<section class="docSec">
    <div class="container-lg">
        <div class="row align-items-center">
            <div class="col-12">
                <h2 class="secHeading">
                    Documents Required for Car Rental in the UAE
                </h2>
                <p class="docSecSubPara">
                    One particular thing about the UAE is that you will find yourself visiting all the major attractions
                    in the country. Located in the region, the best way to navigate is by car, with landmarks such as
                    the Burj Khalifa and iconic shopping venues such as the Dubai Mall and stunning beaches of Jumeirah
                    waiting to say welcome. You can rent a vehicle across the Emirates if you have the valid documents
                    mentioned below.
                </p>
                <p class="docSecSubPara2">
                    Hence, to enjoy our rental car services in the UAE, ensure you have a valid UAE driving license to
                    rent both luxury and economy cars in Dubai.
                </p>
            </div>
            <div class="col-xl-3 col-md-4">
                <div class="docCard">
                    <div class="cardHeader">
                        <h4>For UAE Residents</h4>
                    </div>
                    <figure>
                        <img loading="lazy" src="{{asset('/web-assets/images/01.webp')}}" alt="Document For Residents">
                    </figure>
                    <ul>
                        <li>
                            <i class="fas fa-caret-right"></i>
                            Driving License
                        </li>
                        <li>
                            <i class="fas fa-caret-right"></i>
                            Emirates ID
                        </li>
                    </ul>
                    <p>
                        (Residential Visa may be acceptable)
                    </p>
                </div>
            </div>
            <div class="col-xl-3 col-md-4">
                <div class="docCard">
                    <div class="cardHeader">
                        <h4>For Tourists visiting the UAE</h4>
                    </div>
                    <figure>
                        <img loading="lazy" src="{{asset('/web-assets/images/02.webp')}}" alt="Document For Tourist">
                    </figure>
                    <ul>
                        <li>
                            <i class="fas fa-caret-right"></i>
                            Passport
                        </li>
                        <li>
                            <i class="fas fa-caret-right"></i>
                            Visit Visa
                        </li>
                        <li>
                            <i class="fas fa-caret-right"></i>
                            Home Country Driving License
                        </li>
                        <li>
                            <i class="fas fa-caret-right"></i>
                            International Driving Permit (IDP)
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-6 col-md-4">
                <figure class="carImg">
                    <img loading="lazy" src="{{asset("/web-assets/images/car2.webp")}}" alt="lamborghini">
                </figure>
            </div>
        </div>
    </div>
</section>

<section class="contentSec">
    <div class="container-lg">
        <div class="row">
            <div class="col-md-5">
                <figure class="contentImg">
                    <img loading="lazy" src="{{asset('/web-assets/images/rent-vector.webp')}}" alt="Find Our Services">
                </figure>
            </div>
            <div class="col-md-7">
                <div class="content">
                    <h3>Find the Best Car Rental and Driver Services in Dubai</h3>
                    <ul>
                        <li>
                            <i class="fas fa-caret-right"></i>
                            <span><a href="https://onetapdrive.com/" target="_blank">OneTapDrive.com</a>
                              is a renowned car rental and leasing marketplace. With over 2,000 verified cars, we feature with more than 200 local car rental companies in Dubai to ensure you get the best rental options.</span>
                        </li>
                        <li>
                            <i class="fas fa-caret-right"></i>
                            Whether for business or personal use, explore the cheapest car rental deals and discounts in
                            your area. We also offer competitive, commission free car rental services in Dubai, Abu
                            Dhabi, Sharjah and Ajman. Additionally we provide chauffeur services.
                        </li>
                        <li>
                            <i class="fas fa-caret-right"></i>
                            We have a fleet of luxury supercars (Ferrari, Lamborghini, and Rolls Royce), premium SUVs
                            (Range Rover and Mercedes Benz) and economy cars (Kia Picanto, Nissan Sunny, and Renault
                            Duster). This wide variety makes our clients happy with a large choice to pick from.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="benefitSec">
    <div class="container-lg">
        <div class="row">
            <div class="col-md-12">
                <h2 class="secHeading">
                    Top Benefits to Rent a Car with Driver in Dubai
                </h2>
            </div>
            <div class="col-md-4">
                <div class="benefitCard">
                    <figure>
                        <img loading="lazy" src="{{asset('/web-assets/images/seat-belt.webp')}}" alt="">
                    </figure>
                    <h4>Enjoy the Ride</h4>
                    <p>
                        While you unwind, let our professional chauffeur take over the driving and handle the vehicle
                        through traffic. With their experience of the city, you can enjoy a comfortable journey tailored
                        to your preferences.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="benefitCard">
                    <figure>
                        <img loading="lazy" src="{{asset('/web-assets/images/price-tag.webp')}}" alt="">
                    </figure>
                    <h4>Pre-Set Pricing</h4>
                    <p>
                        One Tap Drive offers transparent pricing. Our rates for renting a car with a driver in Dubai
                        includes the number of booked hours within the city limits, ensuring your trip is free of
                        surprises and giving you peace of mind.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="benefitCard">
                    <figure>
                        <img loading="lazy" src="{{asset('/web-assets/images/counter.webp')}}" alt="">
                    </figure>
                    <h4>Premium Concierge Service</h4>
                    <p>
                        Get connected with the best car rental company in the UAE as One Tap Drive introduces you to top
                        chauffeur service providers. Don’t worry; we’ll provide you with elite service and reliability,
                        giving you an unforgettable experience.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="expNewSec">
    <div class="container-md">
        <div class="row">
            <div class="col-12">
                <div class="aboutContent contentWrap">

                    <h3 class="secHeading">Experience Perfection with the Best Car Rental Company for Renting Cars in
                        Dubai</h3>
                    <p>
                        When you choose One Tap Drive, it becomes easy to find the best car rental company that ensures
                        you discover cheap car rental options. We have a wide selection of vehicles to suit any budget,
                        allowing you to enjoy your trip. We promise you quality service at an affordable price so you
                        can explore the city with confidence.
                    </p>
                    <h3 class="secHeading">
                        Renting a Car in Dubai: Quick Tips & Tricks for a Smooth Experience
                    </h3>
                    <ul>
                        <li>
                            If a convenient pick-up and drop-off service is what you need, choose a car rental company
                            near you or one that delivers quickly to your location. When booking car rental, always
                            check for the best options available.
                        </li>
                        <li>
                            When picking up the car, carefully check for any dents or scratches. A video walk-around and
                            clear photos of any existing damage are a good idea to share with the rental company for
                            immediate resolution and to avoid any future issues. This applies whether you use online car
                            rental or a physical booking.
                        </li>
                        <li>
                            The best way to provide the security deposit is through a credit card pre-authorization —
                            it’s a hold on the card that will be automatically released within 20–30 days after your
                            rental ends. This is important when renting from the best car rental cars.
                        </li>
                        <li>
                            Always ensure that the name of the company listed on One Tap Drive matches the company name
                            on the rental agreement you sign.
                        </li>
                        <li>
                            If you experience any issues with the selected rental company, contact the One Tap Drive
                            team with proof of booking and other relevant details.
                        </li>
                        <li>
                            Rent a car in Dubai easily at Dubai International Airport, with major rental companies
                            located in all three terminals. For better deals, you can pre-book through online car rental
                            or rent a car upon arrival.
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="accordion_wrapper">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <h2 class="secHeading">
                    Frequently Asked Questions
                </h2>
                <div class="faqCont">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item reveal fade_bottom">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseOne" aria-expanded="false"
                                        aria-controls="flush-collapseOne">
                                    How do I rent a car using One Tap Drive?
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                 aria-labelledby="flush-headingOne"
                                 data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    Renting a car with this application from OneTap Drive is really easy. Just go to our
                                    site, or download the mobile app, pick your location, find the cars you like,
                                    compare prices and book. So renting a car from a rental company with our platform is
                                    a straightforward and convenient way.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item reveal fade_bottom">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                        aria-controls="flush-collapseTwo">
                                    How to get the best car rental offer?
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                 aria-labelledby="flush-headingTwo"
                                 data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    In order to get the best car rental offer, it is suggested to compare the prices and
                                    deals offered by different rental companies. One Tap Drive is full of options, so
                                    you can choose what car you’d like, how much it’s going to cost you, and the rental
                                    term. Booking in advance can also help you reserve better deals.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item reveal fade_bottom">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseThree" aria-expanded="false"
                                        aria-controls="flush-collapseThree">
                                    What are the benefits of renting a car compared to traveling by public transport?
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse"
                                 aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <ul>
                                        <li>
                                            <p class="f-14">
                                                The freedom and flexibility to explore at your own pace.
                                            </p>
                                        </li>
                                        <li>
                                            <p class="f-14">
                                                Especially convenient if you’re traveling with luggage or in groups.
                                            </p>
                                        </li>
                                        <li>
                                            <p class="f-14">
                                                You can skip the wait for public transport and save time.
                                            </p>
                                        </li>
                                        <li>
                                            <p class="f-14">
                                                Enjoy the privacy and comfort of your own vehicle.
                                            </p>
                                        </li>
                                        <li>
                                            <p class="f-14">
                                                Access to remote locations.
                                            </p>
                                        </li>
                                        <li>
                                            <p class="f-14">
                                                The freedom to make your own choices, including the ability to stop
                                                anywhere.
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item reveal fade_bottom">
                            <h2 class="accordion-header" id="flush-headingThree1">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseThree1" aria-expanded="false"
                                        aria-controls="flush-collapseThree1">
                                    What is the most efficient way to get around Dubai?
                                </button>
                            </h2>
                            <div id="flush-collapseThree1" class="accordion-collapse collapse"
                                 aria-labelledby="flush-headingThree1" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <p>
                                        Whether you are visiting the UAE on holiday or living here, renting a car is an
                                        absolute need as it gives you the liberty and convenience required. Their
                                        infrastructure in Dubai is world class and having your own car is the best
                                        option. If you need it at a certain time or a certain destination, you can
                                        choose one and it will be delivered or dropped off at your location when you
                                        need it.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item reveal fade_bottom">
                            <h2 class="accordion-header" id="flush-headingThree2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseThree2" aria-expanded="false"
                                        aria-controls="flush-collapseThree2">
                                    What additional costs should I consider when renting a car?
                                </button>
                            </h2>
                            <div id="flush-collapseThree2" class="accordion-collapse collapse"
                                 aria-labelledby="flush-headingThree2" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <p>
                                        Your additional costs may include toll fees (Salik), fuel, and parking based on
                                        your usage. There may also be extra charges for delivery and pick-up of the
                                        rental car.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bannerSec">
    <img loading="lazy" src="{{asset('/web-assets/images/mercedes.webp')}}" alt="">
    <div class="content">
        <div class="container-lg">
            <h2>
                <a href="">
                    Are you a car rental company? Join us.
                </a>
                <span>
                        List your cars with the UAE's biggest car rental & leasing marketplace today!
                    </span>
            </h2>
        </div>
    </div>
</section>

@section('script')
<script>
    $(function () {
        const autoCompleteTags = <?php echo json_encode($carsFilter); ?>;
        const searchInput = document.getElementById('search_input');
        const suggestionsContainer = document.querySelector('.suggestions');
        let suggestionIndex = -1;

        // Debounce to prevent excessive filtering on fast typing
        function debounce(func, delay) {
            let timeout;
            return function (...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), delay);
            };
        }

        function updateSuggestions(input) {
            const filteredTags = autoCompleteTags.filter(tag => tag.toLowerCase().includes(input));
            const html = filteredTags.map(tag => `<div class="suggestion">${tag}</div>`).join('');
            suggestionsContainer.innerHTML = html;
            suggestionsContainer.style.display = filteredTags.length ? 'block' : 'none';
            suggestionIndex = -1;
        }

        searchInput.addEventListener('input', debounce((e) => {
            const input = e.target.value.trim().toLowerCase();
            if (input.length > 0) {
                updateSuggestions(input);
            } else {
                suggestionsContainer.style.display = 'none';
            }
        }, 300)); // Adjust delay as needed

        // Handle suggestion click and input setting
        suggestionsContainer.addEventListener('click', (e) => {
            if (e.target.classList.contains('suggestion')) {
                searchInput.value = e.target.textContent.trim();
                suggestionsContainer.style.display = 'none';
            }
        });

        // Hide suggestions when clicking outside of input or suggestions
        document.addEventListener('click', (e) => {
            if (!suggestionsContainer.contains(e.target) && e.target !== searchInput) {
                suggestionsContainer.style.display = 'none';
            }
        });

        // Handle keyboard navigation and selection of suggestions
        searchInput.addEventListener('keydown', (e) => {
            const suggestions = document.querySelectorAll('.suggestion');
            if (suggestions.length === 0) return;

            if (e.key === 'ArrowDown') {
                suggestionIndex = (suggestionIndex + 1) % suggestions.length;
                updateHighlightedSuggestion(suggestions);
            } else if (e.key === 'ArrowUp') {
                suggestionIndex = (suggestionIndex - 1 + suggestions.length) % suggestions.length;
                updateHighlightedSuggestion(suggestions);
            } else if (e.key === 'Enter' && suggestionIndex >= 0) {
                searchInput.value = suggestions[suggestionIndex].textContent.trim();
                suggestionsContainer.style.display = 'none';
            }
        });

        function updateHighlightedSuggestion(suggestions) {
            suggestions.forEach(suggestion => suggestion.classList.remove('highlighted'));
            if (suggestionIndex >= 0) {
                suggestions[suggestionIndex].classList.add('highlighted');
            }
        }

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
        document.getElementById('toggle-button').addEventListener('click', function () {
            var categoryItems = document.querySelectorAll('.category-item');
            var isShowingAll = this.getAttribute('data-showing-all') === 'true';

            categoryItems.forEach(function (item, index) {
                if (index >= {{
                    $initialCount
                }
            })
                {
                    item.style.display = isShowingAll ? 'none' : 'block';
                }
            });

            this.innerText = isShowingAll ? 'Show More' : 'Show Less';
            this.setAttribute('data-showing-all', isShowingAll ? 'false' : 'true');
        });

        let search_btn = document.getElementById("search_btn");
        let view_btn = document.getElementById("view_btn");
        let search_input = document.getElementById("search_input");

        search_input.addEventListener('keyup', function (event) {
            if (search_input.value.trim() !== "") {
                search_btn.classList.remove("d-none");
                view_btn.classList.add("d-none");
            } else {
                search_btn.classList.add("d-none");
                view_btn.classList.remove("d-none");
            }
        });
    })
</script>
@endsection
@endsection
