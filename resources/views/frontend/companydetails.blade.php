@extends('frontend.layouts.header')
@section('content')
    <style>
        .box_shadow {
            box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;
        }

        .text_theme {
            color: #FFBA00 !important;
        }

        .fs_12 {
            font-size: 12px;
        }

        .fs_13 {
            font-size: 13px;
        }

        .search_btn {
            height: 40px;
            width: 48px;
            border-radius: 5px;
            margin-left: 5px;
        }

        .search_input {
            width: 320px;
            border-radius: 5px;
            height: 40px;
        }

        .search_div {
            display: flex;
        }

        .icon_color {
            color: #EE850B;
        }

        .icon_green {
            color: #1ed700;
        }

        .min_width_180 {
            min-width: 180px;
        }

        .open_div {
            background: #d9fdd3;
            border: solid 1px #1ed700;
            align-items: center;
        }

        .open_div:hover {
            cursor: pointer;
        }

        #arrow_right {
            transition: 0.3s;
        }

        .bg_gold {
            background-color: #FFBA00 !important;
        }

        .border_gold {
            border: 1px solid #FFBA00;
        }

        .bg_grey {
            background-color: #4D4D4D;
        }

        .bg_green {
            background-color: #7CC67C;
        }

        .icon {
            height: 50px;
            width: 50px;
        }

        .icon:hover {
            cursor: pointer;
        }

        .styled_button {
            background-color: #FFBA00;
            border: none;
            color: white;
            padding: 5px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        .styled_button:hover {
            background-color: #4D4D4D;
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
            color: #fff;
        }
    </style>

    <div class="content_wrap ">
        <nav>
            <ol class="cd-breadcrumb">
                <li><a href="{{route('home')}}" class="fa fa-home"></a></li>
                <li class="current"><span>Car Rental Companies</span></li>
                <li><a href="#0">{{$company_details->company_name}}</a></li>
            </ol>
        </nav>
    </div>

    <section>
        <div class="container">
            <h2>{{$company_details->company_name}} Rental in {{$company_details->city}}<h2>
                    <p>
                        Find cars for hire by {{$company_details->company_name}} Rental in {{$company_details->city}}. Choose from a range of SUV, Compact, Luxury Car, Sports
                        Car and Cross Over. Branch pick-up and delivery at your location or airport in {{$company_details->city}} provided
                        subject to availability.
                    </p>

                    <h3 class="mt-2">Company Details</h3>

                    <div class="row mt-4">
                        <div class="col-md-8">
                            <div class="py-3 px-4 rounded">
                                <h2>{{$company_details->company_name}} Rental</h2>
                                <div class="d-flex gap-5">
                                    <div class="min_width_180">
                                        <img width="14px" src={{ asset('assets/images/phone.png') }}
                                            alt="">&nbsp;&nbsp;<span>Phone</span>
                                    </div>
                                    <p class="mb-0 text_theme">{{$company_details->contact}}</p>
                                </div>
                                <hr class="my-3">
                                <div class="d-flex gap-5">
                                    <div class="min_width_180">
                                        <i class="fa-solid fa-envelope icon_color"></i> &nbsp;&nbsp;<span>Email</span>
                                    </div>
                                    <p class="mb-0 text_theme">{{$company_details->email}}</p>
                                </div>
                                <hr class="my-3">
                                @if(!empty($company_details->payment_modes))
                                <div class="d-flex gap-5">
                                    <div class="min_width_180">
                                        <i class="fa-solid fa-credit-card icon_color"></i> &nbsp;&nbsp;<span>Payment
                                            mode</span>
                                    </div>
                                    <div class="d-flex gap-2 flex-wrap">
                                        <p class="mb-0 text_theme card px-2">Credit card</p>
                                        <p class="mb-0 text_theme card px-2">Debit card</p>
                                        <p class="mb-0 text_theme card px-2">Cash</p>
                                    </div>
                                </div>
                                @else
                                <div class="d-flex gap-5">
                                    <div class="min_width_180">
                                        <i class="fa-solid fa-credit-card icon_color"></i> &nbsp;&nbsp;<span>Payment
                                            mode</span>
                                    </div>
                                    <div class="d-flex gap-2 flex-wrap">
                                    @if (strpos($company_details->payment_modes, 'Credit Card') !== false)
                                        <p class="mb-0 text_theme card px-2">Credit Card</p>
                                    @endif
                                
                                    @if (strpos($company_details->payment_modes, 'Debit Card') !== false)
                                        <p class="mb-0 text_theme card px-2">Debit Card</p>
                                    @endif
                                
                                    @if (strpos($company_details->payment_modes, 'Bitcoin/Crypto') !== false)
                                        <p class="mb-0 text_theme card px-2">Bitcoin/Crypto</p>
                                    @endif
                                    </div>
                                </div>
                                @endif
                                <hr class="my-3">
                                <div class="d-flex gap-5">
                                    <div class="min_width_180">
                                        <i class="fa-solid fa-car-side icon_color"></i> &nbsp;&nbsp;<span>Car Fleet</span>
                                    </div>
                                    <div class="d-flex gap-2 flex-wrap">
                                        @foreach ( $car_fleet as $category )
                                        <p class="mb-0 text_theme card px-2">{{$category}}</p>
                                        @endforeach
                                    </div>
                                </div>
                                <hr class="my-3">
                                <div class="d-flex gap-5">
                                    <div class="min_width_180">
                                        <i class="fa-solid fa-clock icon_color"></i> &nbsp;&nbsp;<span>Shop Timings</span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="open_div py-2 px-3 rounded d-flex align-items-center justify-content-between"
                                        onclick="tableShow()">

                                        
                                        @php
                                            $currentDay = ucfirst(date('l'));
                                            $currentTime = date('H:i:s');
                                        @endphp
                                           @if (!empty($shop_timings))
                                           @foreach ($shop_timings as $time)
                                               @if ($time['day_of_week'] == $currentDay)
                                                   @if ($time['opening_time'] == $time['closing_time'])
                                                <div>
                                                    <i class="fa-solid fa-clock icon_green"></i>&nbsp;&nbsp;Today   Open 24 Hours
                                                </div>

                                                @endif
                                                @else

                                                @if ($time['day_of_week'] == $currentDay || $time['closing_time'] == $currentTime)
                                        <div>
                                            <i class="fa-solid fa-chevron-right " id="arrow_right">Today {{ date('g:i A', strtotime($time['opening_time'])) }}-
                                                {{ date('g:i A', strtotime($time['closing_time'])) }}</i>
                                        </div>

                                        @endif
                                                @endif
                                            @endforeach
                                        @else
                                        <i class="fa-solid fa-chevron-right " id="arrow_right"> Shop Timings Not updated

                                    @endif
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
                                        </tbody>
                                    </table>
                                </div>
                                <hr class="my-3">
                                <div class="d-flex gap-5">
                                    <div class="min_width_180">
                                        <h3>Location Details</h3>
                                    </div>
                                </div>

                                <div class="d-flex gap-5 mt-3">
                                    <div class="min_width_180">
                                        <i class="fa-solid fa-location-dot icon_color"></i> &nbsp;&nbsp;<span>Address</span>
                                    </div>
                                    <div class="d-flex gap-2 flex-wrap">
                                        {{$company_details->address}}
                                    </div>
                                </div>

                                <div class="mt-4">
                                    {{-- map here --}}

                                    <iframe title="ocd footer" allowfullscreen="" class="footermap ocdfooter-map" height="300" loading="lazy" src="{{$company_details->google_map}}" style="border:0" width="100%"></iframe>
                                </div>


                            </div>

                            
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


                        </div>
                        <div class="col-md-4">
                            <div>
                                <div class="box_shadow px-3 py-4 rounded">
                                    <h3 class="text-center">CONTACT THE COMPANY DIRECTLY</h3>
                                    <div class="d-flex justify-content-center gap-2 mt-4">
                                        <i
                                            class="icon fa-solid fa-phone bg_gold text-light h5 rounded-circle d-flex align-items-center justify-content-center"></i>
                                        <i
                                            class="icon fab fa-whatsapp text-light bg_green h5 rounded-circle d-flex align-items-center justify-content-center"></i>
                                        <i
                                            class="icon fa-solid fa-envelope text-light bg_grey h5 rounded-circle d-flex align-items-center justify-content-center"></i>
                                    </div>
                                </div>
                                <div class="box_shadow px-3 py-4 rounded mt-4">
                                    <div class="text-center">
                                        <span class="text-center h2">OneTap<span
                                                class="text_theme">Drive</span></span><span>.com</span>
                                    </div>
                                    <p class="text-center">Looking for cars in Dubai?</p>
                                    <button class="styled_button d-block mx-auto">Find Offers</button>
                                </div>
                                <div class="box_shadow px-3 py-4 rounded mt-4">
                                    <div>
                                        <p>Similar Businesses</p>
                                        <h3>West Point Rent A Car LLC Luxury car with chauffeur Economy car with chauffeur
                                            Pick
                                            and Drop services</h3>
                                        <p>Danat Al Mamzar Building, 1, 9 Street</p>
                                        <p class="mb-1 fs_13"><img width="14px" src={{ asset('assets/images/phone.png') }}
                                                alt="">&nbsp; +971544353435</p>
                                        <p class="fs_13"><img width="14px" src={{ asset('assets/images/category.png') }}
                                                alt="">&nbsp; Category: Car rental</p>
                                        <button class="styled_button w-100">Contact this Business</button>
                                    </div>
                                    <hr>
                                        <div>
                                            <h3>Patriot Rent A Car company</h3>
                                            <p class="mb-1 fs_12">16, 27a Street</p>
                                            <p class="mb-1 fs_13"><img width="14px" src={{ asset('assets/images/phone.png') }}
                                                    alt="">&nbsp; +971544353435</p>
                                            <p class="fs_13"><img width="14px" src={{ asset('assets/images/category.png') }}
                                                    alt="">&nbsp; Category: Car rental</p>
                                            <button class="styled_button w-100">Contact this Business</button>
                                        </div>
                                    <hr>
                                        <div>
                                            <h3>Patriot Rent A Car company</h3>
                                            <p class="mb-1 fs_12">16, 27a Street</p>
                                            <p class="mb-1 fs_13"><img width="14px" src={{ asset('assets/images/phone.png') }}
                                                    alt="">&nbsp; +971544353435</p>
                                            <p class="fs_13"><img width="14px" src={{ asset('assets/images/category.png') }}
                                                    alt="">&nbsp; Category: Car rental</p>
                                            <button class="styled_button w-100">Contact this Business</button>
                                        </div>
                                        <hr>
                                        <button class="styled_button d-block mx-auto">View All</button>
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
    </script>
@endsection
