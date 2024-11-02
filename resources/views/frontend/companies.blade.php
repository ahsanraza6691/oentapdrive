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
    </style>

    <div class="content_wrap ">
        <nav>
            <ol class="cd-breadcrumb">
                <li><a href="{{route('home')}}" class="fa fa-home"></a></li>
                <li class="current"><span>Car Rental Companies</span></li>
            </ol>
        </nav>
    </div>

    <section>
        <div class="container">
            <h2>Car Rental Companies Directory in Dubai</h2>
            <form>
                <div class="search_div mb-3">
                    <input class="form-control search_input" type="search" name="" id=""
                        placeholder="Search Car Rental Companies">
                    <button class="bg-dark search_btn"><i class="fa-solid fa-magnifying-glass text-light"></i></button>
                </div>
            </form>
            <div class="row mt-4">
                <div class="col-md-8">
                    @foreach ($companies as  $company)
                        
                    
                    <div class="box_shadow py-3 px-4 rounded mt-4">
                        <h2>{{$company->company_name}}</h2>
                        <div class="d-flex gap-3">
                            <div>
                                <img width="14px" src={{ asset('assets/images/category.png') }} alt="">
                            </div>
                            <p class="mb-2">Category: Car Rental</p>
                        </div>
                        <div class="d-flex gap-3">
                            <div>
                                <img width="14px" src={{ asset('assets/images/location-pin.svg') }} alt="">
                            </div>
                            <p class="mb-2">{{$company->address}}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="d-flex gap-3">
                                    <div>
                                        <img width="14px" src={{ asset('assets/images/phone.png') }} alt="">
                                    </div>
                                    <a class="text_theme">{{$company->contact}}</a>
                                </div>
                            </div>
                            @if(!empty($company->slug))
                            <div>
                                <a href="{{ route('company-details', ['slug' => $company->slug]) }}">
                                <button class="styled_button py-1 px-3">More Info &nbsp;<i
                                        class="fa-solid fa-chevron-right fs_12"></i></button></a>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                    {{-- <div class="box_shadow py-3 px-4 rounded mt-4">
                        <h2>Xcar Rental</h2>
                        <div class="d-flex gap-3">
                            <div>
                                <img width="14px" src={{ asset('assets/images/category.png') }} alt="">
                            </div>
                            <p class="mb-2">Category: Car Rental</p>
                        </div>
                        <div class="d-flex gap-3">
                            <div>
                                <img width="14px" src={{ asset('assets/images/location-pin.svg') }} alt="">
                            </div>
                            <p class="mb-2">Marza Plaza North, 24/1, Festival Boulevard</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="d-flex gap-3">
                                    <div>
                                        <img width="14px" src={{ asset('assets/images/phone.png') }} alt="">
                                    </div>
                                    <a class="text_theme">123 123 123</a>
                                </div>
                            </div>
                            <div>
                                <button class="styled_button py-1 px-3">More Info &nbsp;<i
                                        class="fa-solid fa-chevron-right fs_12"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="box_shadow py-3 px-4 rounded mt-4">
                        <h2>Xcar Rental</h2>
                        <div class="d-flex gap-3">
                            <div>
                                <img width="14px" src={{ asset('assets/images/category.png') }} alt="">
                            </div>
                            <p class="mb-2">Category: Car Rental</p>
                        </div>
                        <div class="d-flex gap-3">
                            <div>
                                <img width="14px" src={{ asset('assets/images/location-pin.svg') }} alt="">
                            </div>
                            <p class="mb-2">Marza Plaza North, 24/1, Festival Boulevard</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="d-flex gap-3">
                                    <div>
                                        <img width="14px" src={{ asset('assets/images/phone.png') }} alt="">
                                    </div>
                                    <a class="text_theme">123 123 123</a>
                                </div>
                            </div>
                            <div>
                                <button class="styled_button py-1 px-3">More Info &nbsp;<i
                                        class="fa-solid fa-chevron-right fs_12"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="box_shadow py-3 px-4 rounded mt-4">
                        <h2>Xcar Rental</h2>
                        <div class="d-flex gap-3">
                            <div>
                                <img width="14px" src={{ asset('assets/images/category.png') }} alt="">
                            </div>
                            <p class="mb-2">Category: Car Rental</p>
                        </div>
                        <div class="d-flex gap-3">
                            <div>
                                <img width="14px" src={{ asset('assets/images/location-pin.svg') }} alt="">
                            </div>
                            <p class="mb-2">Marza Plaza North, 24/1, Festival Boulevard</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="d-flex gap-3">
                                    <div>
                                        <img width="14px" src={{ asset('assets/images/phone.png') }} alt="">
                                    </div>
                                    <a class="text_theme">123 123 123</a>
                                </div>
                            </div>
                            <div>
                                <button class="styled_button py-1 px-3">More Info &nbsp;<i
                                        class="fa-solid fa-chevron-right fs_12"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="box_shadow py-3 px-4 rounded mt-4">
                        <h2>Xcar Rental</h2>
                        <div class="d-flex gap-3">
                            <div>
                                <img width="14px" src={{ asset('assets/images/category.png') }} alt="">
                            </div>
                            <p class="mb-2">Category: Car Rental</p>
                        </div>
                        <div class="d-flex gap-3">
                            <div>
                                <img width="14px" src={{ asset('assets/images/location-pin.svg') }} alt="">
                            </div>
                            <p class="mb-2">Marza Plaza North, 24/1, Festival Boulevard</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="d-flex gap-3">
                                    <div>
                                        <img width="14px" src={{ asset('assets/images/phone.png') }} alt="">
                                    </div>
                                    <a class="text_theme">123 123 123</a>
                                </div>
                            </div>
                            <div>
                                <button class="styled_button py-1 px-3">More Info &nbsp;<i
                                        class="fa-solid fa-chevron-right fs_12"></i></button>
                            </div>
                        </div>
                    </div> --}}
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
@endsection
