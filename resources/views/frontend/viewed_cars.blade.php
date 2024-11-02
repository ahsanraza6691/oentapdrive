@extends('frontend.layouts.header')
@section('title', 'Rent a Car Dubai | Home')
@section('content')

    <style>
        .header_viewed_car {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-right: 60px;
        }

        .more_options_share {
            left: -150px;
            width: fit-content;
            top: 70%;
        }
    </style>

<section>
    <div class="content_wrap">
        <div class="row">
            @include('frontend.partials.profile-sidebar')
            <div class="col-md-9">

                <div class="row">
                    @include('frontend.partials.profile header')
                    @foreach ($viewed_cars as $key =>  $view)
                    <hr class="my-4">
                    <span class="date_viewed mb-4">
                        <i class="fa-solid fa-calendar-days"></i>
                        {{ \Carbon\Carbon::parse($view->created_at)->format('d M, Y') }}

                    </span>



                    <div class="styled_vehicle_card_2 px-0">
                        <div class="carousel_wrapper">
                            <div id="demo" class="carousel slide" data-bs-ride="carousel">

                                {{-- <div class="favorite flex_center ">
                                    <button class="styled_button rounded_sm wishlist-button">
                                        <i class="fa fa-heart"></i>
                                    </button>
                                </div> --}}

                                <div class="carousel-indicators">
                                    {{-- <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"
                                        aria-current="true"></button>
                                    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"
                                        class=""></button>
                                    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"
                                        class=""></button> --}}
                                </div>

                                <a href="javascript:void(0);">

                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="{{asset('images/') }}/{{$view->get_product->get_images[0]->images ?? '' }}" alt="Los Angeles"
                                                class="d-block" style="width: 100%; object-fit: cover;" height="280px">
                                        </div>
                                        {{-- <div class="carousel-item">
                                            <img src={{ asset('assets/images/Hyundai_Santa.webp') }} alt="Chicago"
                                                class="d-block" style="width: 100%; object-fit: cover;" height="280px">
                                        </div>
                                        <div class="carousel-item">
                                            <img src={{ asset('assets/images/Hyundai_Santa.webp') }} alt="New York"
                                                class="d-block" style="width: 100%; object-fit: cover;" height="280px">
                                        </div> --}}
                                    </div>
                                </a>


                                {{-- <button class="carousel-control-prev" type="button" data-bs-target="#demo"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#demo"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button> --}}
                            </div>
                        </div>
                        <div class="content_wrapper">
                            <div class="d-flex justify-content-between pe-sm-5 pe-0">

                                <div>
                                    <a href="{{ route('car-details', ['slug' => $view->get_product->slug]) }}">
                                        <h2 class="clr_primary mb-2">{{$view->get_product->get_brand_name->brand_name ?? ''}} {{$view->get_product->model_name ?? ''}} {{$view->get_product->make_year ?? ''}}</h2>
                                </a>
                            </div>
                            <div class="dropdown">
                                <i class="fa-solid fa-ellipsis-vertical" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>

                                <div class="dropdown-menu more_options_share" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">
                                        <i class="fa-solid fa-share-nodes"></i>
                                        Share
                                    </a>
                                    <a class="dropdown-item"  href="">
                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                       Add to wishlist
                                    </a>
                                </div>
                            </div>
                        </div>
                            <div>
                                <ul class="kylist col-xs-12 sddetail">
                                    <li class="f-12 cartip">{{$view->get_product->category ?? ''}}</li>
                                    <li class="f-13" title="This vehicle has 4 Doors">{{$view->get_product->car_doors ?? ''}}
                                        <img alt="Doors" class="svgis"
                                            src="{{asset('icons/door.svg')}}">
                                    </li>
                                    <li title="This vehicle can seat upto 5 Passengers comfortably" class="f-13">{{$view->get_product->passengers ?? ''}}<img
                                            alt="Passengers" class="svgis passenger"
                                            src="{{asset('icons/seaticon.svg')}}">
                                    </li>
                                    <li title="The boot-space of this vehicle is good for 3 luggage bag(s)"
                                        class="f-13">{{$view->get_product->bags ?? ''}}<img alt="Large Bags" class="svgis"
                                            src="{{asset('icons/brefcase.svg')}}">
                                    </li>

                                </ul>
                            </div>
                            <div class="content_container ">
                                <div>
                                    @if(!empty($view->get_product->delivery_days))
                                    <p>
                                        <span><i class="fa fa-check"></i></span> Delivery :
                                        {{$view->get_product->delivery_days ?? '' }}
                                    </p>
                                    @endif
                                    @if(!empty($view->get_product->daily_availablity == 'Yes'))
                                    <p>
                                        <span><i class="fa fa-check"></i></span> 1 day rental
                                        available
                                    </p>
                                    @endif
                                    @if(!empty($view->get_product->insurance_per_day ))
                                    <p>
                                        <span><i class="fa fa-check"></i></span> Insurance
                                        included
                                    </p>
                                    @endif
                                    @if(!empty($view->get_product->security_deposit))

                                    <p>
                                        <span><i class="fa fa-info"></i></span>Security Deposit :
                                        AED {{$view->get_product->security_deposit ?? ''}}
                                    </p>
                                    @endif
                                </div>

                                <div class="price_tag mb-0">
                                    @if(!empty($view->get_product->daily_discount_price))
                                     <del>AED {{$view->get_product->price_per_day ?? ''}}</del>
                                    @endif
                                    @if(!empty($view->get_product->daily_discount_price))
                                    <span>
                                        <h2 class="clr_primary">AED {{$view->get_product->daily_discount_price ?? ''}} / day</h2>
                                    </span>
                                    @else
                                    <span>
                                        <h2 class="clr_primary">AED {{$view->get_product->price_per_day ?? ''}} / day</h2>
                                    </span>
                                    @endif

                                    <span>
                                        <i class="fa fa-road"></i>
                                        <span>{{$view->get_product->per_day_mileage ?? ''}} km</span></span>
                                </div>
                                <div class="price_tag ms-0 ms-md-2">
                                    @if(!empty($view->get_product->weekly_discount_price))
                                        <del>AED {{$view->get_product->weekly_rent ?? ''}}</del>
                                    @endif
                                    @if($view->get_product->weekly_discount_price)
                                    <span>
                                        <h2 class="clr_primary">AED {{$view->get_product->weekly_discount_price ?? ''}} / week</h2>
                                    </span>
                                    @else
                                    <span>
                                        <h2 class="clr_primary">AED {{$view->get_product->weekly_rent ?? ''}} / week</h2>
                                    </span>
                                    @endif

                                    <span>
                                        <i class="fa fa-road"></i>
                                        <span>{{$view->get_product->weekly_mileage ?? ''}} km</span>
                                    </span>
                                </div>

                            </div>

                            <div class="company_tag d-flex justify-content-between mt-2 flex-wrap">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <a class="clr_primary" href="#">
                                            <i class="fa fa-map-marker"></i>
                                            {{$view->get_product->get_user->city ?? ''}}

                                        </a>
                                    </div>
                                    <div class="ms-5">
                                        <img width="50px" src="{{asset('company_logo/'.$view->get_product->get_user->company_logo ?? '')}}"
                                            alt="" />
                                    </div>
                                </div>
                                <div>
                                    <div class="mt-3 d-flex justify-content-end">
                                        <div>
                                            <a href="javascript:void(0);" class="phonelead" id="phoneshare">
                                                <button class="yellow_btn d-flex" id="my_wp">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <svg class="mr-auto d-block"
                                                                xmlns="http://www.w3.org/2000/svg"
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
                                                                &nbsp; {{$view->get_product->get_user->contact ?? ''}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </a>
                                        </div>
                                        <a href="javascript:void(0);" class="socialShareLink">
                                            <div class="ms-1 ">
                                                <button class="wp_btn d-flex" id="my_wp1">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 450 512" fill="#fff" width="26"
                                                                height="26">
                                                                <path
                                                                    d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <span class="d-none numm1 text-light" id="my_wp_num1"
                                                                style="overflow: hidden">
                                                                &nbsp;{{$view->get_product->get_user->contact ?? ''}}
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

                    <p class="text-center">Thatâ€™s the end of your list. Browse new offers to add more.</p>
                    <button class="styled_button animate_width w-auto mx-auto "><a href="{{route('rent-a-car-dubai')}}">Continue Search</a></button>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Phone button
        const myWpElement = document.getElementById("my_wp");
        const my_wp_num = document.getElementById("my_wp_num");

        myWpElement.addEventListener("focus", function() {
            my_wp_num.classList.remove("d-none");
            console.log("focus.");
            myWpElement.style.width = "170px";
        });

        myWpElement.addEventListener("blur", function() {
            my_wp_num.classList.add("d-none");
            console.log("blur");
            myWpElement.style.width = "47px";
        });

        // WhatsApp button
        const myWpElement1 = document.getElementById("my_wp1");
        const my_wp_num1 = document.getElementById("my_wp_num1");

        myWpElement1.addEventListener("focus", function() {
            my_wp_num1.classList.remove("d-none");
            console.log("focus.");
            myWpElement1.style.width = "170px";
        });

        myWpElement1.addEventListener("blur", function() {
            my_wp_num1.classList.add("d-none");
            console.log("blur");
            myWpElement1.style.width = "47px";
        });
    });
    
    
    
</script>


@endsection
